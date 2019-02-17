<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use \App\Traits\ResponseTrait;
use App\Helpers\HealthAPI;
use Lcobucci\JWT\Parser;

class PassportController extends \Laravel\Passport\Http\Controllers\AccessTokenController
{
    private $health;
    use ResponseTrait;

    public function __construct()
    {
        $this->health = new HealthAPI();
    }

    /**
     * Used to login
     *
     * @param Request $request
     * @return object
     */
    public function login(Request $request)
    {

        if ($request->has('social_type') && $request->get('social_type') != 'normal') {
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
                'social_type' => 'required|string',
                'social_id' => 'required|string',
                'social_token' => 'required|string'
            ]);
        } else {
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
                'password' => 'required|string'
            ]);
        }

        if ($validator->fails()) {
            return $this->respondWithError($validator->errors(), 422);
        }

        if ($request->has('social_type') && $request->get('social_type') != "normal") {
            $user = User::where([
                'email' => request()->request->get('email'),
                'social_type' => request()->request->get('social_type')
            ])->first();

            if (isset($user)) {
                $password = ($request->get('social_id') . '' . $request->get('email'));
                request()->request->add(['password' => bcrypt($password)]);
                $result = $this->health->post('/api/patients', $request->all(), null, false);
            } else {
                return $this->respondWithError('The user credentials were incorrect', 401);
            }

            $user = new User();
            $user = User::where("social_token", $request->get('social_token'))->first();
            if (is_null($user)) {
                return $this->respondWithError('The user credentials were incorrect', 401);
            }

        } else {
            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials))
                return $this->respondWithError('The user credentials were incorrect', 401);

            $user = $request->user();
            $password = $request->get('password');
        }

        $data = [
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => config('constants.PASSPORT_CLIENT_SECRET'),
            'username' => $request->get('email'),
            'password' => $password,
        ];
        $request = Request::create('/oauth/token', 'POST', $data);

        $token = app()->handle($request);

        $user_details = json_decode($token->getContent(), true);

        $user = array();

        array_push($user, json_decode(Auth::user(), true));

        $user_details['user_details'] = $user[0];

        if ($token->getStatusCode() == 200) {
            return $this->respondWithSuccess($user_details, "Successfully logged in", $token->getStatusCode());
        }

        return $this->respondWithError(json_decode($token->getContent()), $token->getStatusCode());
    }

    /**
     * Used to logout user
     *
     * @param Request $request
     * @return object
     */
    public function signout(Request $request)
    {
        try {

            $value = $request->bearerToken();
            $id = (new Parser())->parse($value)->getHeader('jti');
        
            \DB::table('oauth_access_tokens')
                ->where('id', $id)
                ->update([
                    'revoked' => true
            ]);

            return $this->respondWithSuccess(null, "Successfully signed out", 200);
        } catch (\Exception $ex) {
            return $this->respondWithError("Logout failed", 500);
        }
    }

    public function updateDeviceToken(Request $request)
    {
        try {
            \DB::beginTransaction();

            $validator = Validator::make(request()->request->all(), [
                'device_type' => 'required',
                'device_token' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->respondWithError($validator->errors(), 422);
            }

            $_id = Auth::user()->id;
            $result = User::where('id', $_id)->where('role', 'P')->update($request->all());
            if ($result) {
                \DB::commit();
                return $this->respondWithSuccess(null, "Successfully updated Device Token.", 200);
            }
            \DB::rollBack();
            return $this->respondWithError("Device Token update failed", 401);

        } catch (\Exception $ex) {
            \DB::rollBack();
            return $this->respondWithError("Device Token update failed", 500);
        }
    }
}