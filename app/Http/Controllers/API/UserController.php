<?php

namespace App\Http\Controllers\API;

use Asahasrabuddhe\LaravelAPI\BaseController;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Services\RegistrationService;
use Illuminate\Support\Facades\Log;
// use App\Http\Requests\UserIndexRequest;
// use App\Http\Requests\UserStoreRequest;
// use App\Http\Requests\UserShowRequest;
// use App\Http\Requests\UserUpdateRequest;
// use App\Http\Requests\UserDeleteRequest;
/**
 * Class User.
 */
class UserController extends BaseController
{
    /*
     * Fully qualified name of the Model class that this controller represents.
     *
     * @var string
     */
    use \App\Traits\ResponseTrait;

    protected $model = User::class;

    private $registrationService;

    public function __construct(RegistrationService $registrationService) {
        parent::__construct();
        $this->registrationService = $registrationService;
    }

    /*
     * Fully qualified name of the Request class that will be used to validate the index request.
     *
     * @var string
     */
    // protected $indexRequest = UserIndexRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the store request.
     *
     * @var string
     */
    // protected $storeRequest = UserStoreRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the show request.
     *
     * @var string
     */
    // protected $showRequest = UserShowRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the update request.
     *
     * @var string
     */
    // protected $updateRequest = UserUpdateRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the delete request.
     *
     * @var string
     */
    // protected $deleteRequest = UserDeleteRequest::class;

    /*
     * Modify the query for index request.
     * @param $query
     * @return mixed
     */
    // protected function modifyIndex($query)
    // {
    //     Modifications like adding joins, inner queries etc can be done here.
    //     return $query->where("status", "active");
    //     return $query;
    // }

    /*
     * Modify the query for show request.
     * @param $query
     * @return mixed
     */
    // protected function modifyShow($query)
    // {
    //     return $query;
    // }

    /*
     * Modify the query for update request.
     * @param $query
     * @return mixed
     */
    // protected function modifyUpdate($query)
    // {
    //     return $query;
    // }

    /*
     * Modify the query for delete request.
     * @param $query
     * @return mixed
     */
    // protected function modifyDelete($query)
    // {
    //     return $query;
    // }

    public function store() {
        try {
            \DB::beginTransaction();

            $validator = \Illuminate\Support\Facades\Validator::make(request()->request->all(), [
                'name' => 'required|string',
                'email' => 'unique:users|required|string|email',
                'contact_no' => 'required|string',
                'age' => 'required|string',
                'gender' => 'required',
                'address' => 'required',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return $this->respondWithError($validator->errors(), 422);
            }

            request()->request->add(['password'=>bcrypt(request()->request->get('password'))]);
            request()->request->add(['otp'=>0]);
            request()->request->add(['otp_expired_at'=>date('Y-m-d H:i:s')]);

            $result = parent::store();

            $response = json_decode($result->getContent());

            if($result->getStatusCode() == 201) {
                \DB::commit();
                return $this->respondWithSuccess(null, "Registration successful", $result->getStatusCode());
            }
        }
        catch(\Exception $e) {
            Log::error($e->getMessage().' on line no = '. $e->getLine().' file = '.$e->getFile());
            \DB::rollBack();
            return $this->respondWithError("Registration failed", 500);
        }

    }

    /**
     * Used to fotgotpassword
     * 
     * @param Request $request
     * @return object
     */
    public function forgetPassword(Request $request) {
    
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ]);

        if ($validator->fails()) {
            return $this->respondWithError($validator->errors(), 422);
        }
            
        $email = $request->get('email');
        $otpDetails = $this->getOTP($email);     
        $otp = $otpDetails['otp'];
        
        if(date('Y-m-d H:i:s') > $otpDetails['otp_expired_at']) {
            $otp = $this->generateNumber(5);
        }
        
        $this->registrationService->sendForgotPasswordOtp($otp, $email);
        
        $currentDate = strtotime(date('Y-m-d H:i:s'));
        $otpExpiryDuration = \Config::get('constants.OTP_EXPIRY_DURATION');
        $otpExpiredTime = date("Y-m-d H:i:s", $currentDate +( 60 * $otpExpiryDuration ));
            
        User::where('email', $email)->update(array('otp' => $otp, 'otp_expired_at' => $otpExpiredTime));
        
        $data['otp'] = $otp;
        return $this->respondWithSuccess($data, null, 200);
    }

    /**
     * Used to get otp details from email
     * 
     * @param type $email
     * @return array
     */
    public function getOTP($email) {
        
        return User::select('contact_no', 'otp', 'otp_expired_at')->where('email', $email)->first();
        
    }

    /**
     * Used to generate otp
     * 
     * @param Request $request
     * @return object
     */
    public function generateToken($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Used to generate otp
     * 
     * @param type $email
     * @return array
     */
    public function generateNumber($digits) {
        return random_int(pow(10, $digits-1), pow(10, $digits)-1);
    }

    /**
     * Used to verify OTP
     * 
     * @param Request $request
     * @return object
     */
    public function verifyOTP(Request $request) {
        try {
            
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
                'otp' => 'required',
            ]);
            
            if ($validator->fails()) {
                return $this->respondWithError($validator->errors(), 422);
            }
            
            $email = $request->get('email');
            $otp = $request->get('otp');

            $otpDetails = $this->getOTP($email);

            if(date('Y-m-d H:i:s') > $otpDetails['otp_expired_at']) {
                return $this->respondWithError('OTP Expired', 400);
            }
            
            if($otp == $otpDetails['otp']) {

                $updateData = array('otp_expired_at' => date('Y-m-d H-:i:s'));

                User::where('email', $email)->update($updateData);
                return $this->respondWithSuccess(null, null, 200);
            }
            
            return $this->respondWithError('Incorrect OTP', 400);
            
        } catch (\Exception $ex) {
            
        }
    }

    /**
     * Used to reset password
     * 
     * @param type $email
     * @return array
     */
    public function resetPassword(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->respondWithError($validator->errors(), 422);
        }
        
        $password = $request->get('password');
        
        \DB::table('users')->update(array('password' => bcrypt($password)));
                
        return $this->respondWithSuccess(null, null, 200);
    }

    public function getDoctor($id) {
        return \DB::table('doctors')->where(['id' => $id])->first();
    }

    public function getFacility($id) {
        return \DB::table('facilities')->where(['id' => $id])->first();
    }

    public function getHospital($id) {
        return \DB::table('hospitals')->where(['id' => $id])->first();
    }

    public function getRelation($id) {
        return \DB::table('relations')->where(['id' => $id])->first();
    }
}
