<?php

namespace App\Http\Controllers\API;

use Asahasrabuddhe\LaravelAPI\BaseController;

use App\Hospital;
// use App\Http\Requests\HospitalIndexRequest;
// use App\Http\Requests\HospitalStoreRequest;
// use App\Http\Requests\HospitalShowRequest;
// use App\Http\Requests\HospitalUpdateRequest;
// use App\Http\Requests\HospitalDeleteRequest;
/**
 * Class Hospital.
 */
class HospitalController extends BaseController
{
    /*
     * Fully qualified name of the Model class that this controller represents.
     *
     * @var string
     */
    
    use \App\Traits\ResponseTrait;

    protected $model = Hospital::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the index request.
     *
     * @var string
     */
    // protected $indexRequest = HospitalIndexRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the store request.
     *
     * @var string
     */
    // protected $storeRequest = HospitalStoreRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the show request.
     *
     * @var string
     */
    // protected $showRequest = HospitalShowRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the update request.
     *
     * @var string
     */
    // protected $updateRequest = HospitalUpdateRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the delete request.
     *
     * @var string
     */
    // protected $deleteRequest = HospitalDeleteRequest::class;

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
            return $this->responseWithSuccessAndPagination($response, null, $result->getStatusCode(), 'hospitals');
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
                'hospital' => $response->data
            ];
            return $this->respondWithSuccess($data, null, $result->getStatusCode());
        }
        return $this->respondWithError(json_decode($response->getContent()), $result->getStatusCode());
     }
}
