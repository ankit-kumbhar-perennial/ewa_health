<?php

namespace App\Http\Controllers\API;

use Asahasrabuddhe\LaravelAPI\BaseController;

use App\Doctor;
// use App\Http\Requests\DoctorIndexRequest;
// use App\Http\Requests\DoctorStoreRequest;
// use App\Http\Requests\DoctorShowRequest;
// use App\Http\Requests\DoctorUpdateRequest;
// use App\Http\Requests\DoctorDeleteRequest;
/**
 * Class Doctor.
 */
class DoctorController extends BaseController
{
    /*
     * Fully qualified name of the Model class that this controller represents.
     *
     * @var string
     */
    use \App\Traits\ResponseTrait;
    
    protected $model = Doctor::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the index request.
     *
     * @var string
     */
    // protected $indexRequest = DoctorIndexRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the store request.
     *
     * @var string
     */
    // protected $storeRequest = DoctorStoreRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the show request.
     *
     * @var string
     */
    // protected $showRequest = DoctorShowRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the update request.
     *
     * @var string
     */
    // protected $updateRequest = DoctorUpdateRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the delete request.
     *
     * @var string
     */
    // protected $deleteRequest = DoctorDeleteRequest::class;

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

    /*
     * Modify the response of index
     */
     public function index()
     {        
        $result = parent::index();
        $response = json_decode($result->getContent());
        
        if($result->getStatusCode() == 200) {
            return $this->responseWithSuccessAndPagination($response, null, $result->getStatusCode(), 'doctors');
        }
        return $this->respondWithError(json_decode($response->getContent()), $result->getStatusCode());
     }

    /*
     * Modify the response for show
     */
     public function show(...$args)
     {
        $result = parent::show(...$args);
        $response = json_decode($result->getContent());
        if($result->getStatusCode() == 200) {
            $data = [
                'doctor' => $response->data
            ];
            return $this->respondWithSuccess($data, null, $result->getStatusCode());
        }
        return $this->respondWithError(json_decode($response->getContent()), $result->getStatusCode());
     }
}
