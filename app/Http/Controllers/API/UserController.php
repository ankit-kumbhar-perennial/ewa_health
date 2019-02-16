<?php

namespace App\Http\Controllers\API;

use Asahasrabuddhe\LaravelAPI\BaseController;

use App\User;
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
                'blood_group' => 'required',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return $this->respondWithError($validator->errors(), 422);
            }

            request()->request->add(['password'=>bcrypt(request()->request->get('password'))]);

            $result = parent::store();

            $response = json_decode($result->getContent());

            if($result->getStatusCode() == 201) {
                \DB::commit();
                return $this->respondWithSuccess(null, "Registration successful", $result->getStatusCode());
            }
        }
        catch(\Exception $e) {
            \DB::rollBack();
            return $this->respondWithError("Registration failed", 500);
        }
    }
}
