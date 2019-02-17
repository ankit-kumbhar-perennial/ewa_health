<?php

namespace App\Http\Controllers\API;

use App\Facility;
use Asahasrabuddhe\LaravelAPI\BaseController;

//use App\Facilities;
// use App\Http\Requests\FacilitiesIndexRequest;
// use App\Http\Requests\FacilitiesStoreRequest;
// use App\Http\Requests\FacilitiesShowRequest;
// use App\Http\Requests\FacilitiesUpdateRequest;
// use App\Http\Requests\FacilitiesDeleteRequest;
/**
 * Class Facilities.
 */
class FacilitiesController extends BaseController
{
    /*
     * Fully qualified name of the Model class that this controller represents.
     *
     * @var string
     */
    
    use \App\Traits\ResponseTrait;

     protected $model = Facility::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the index request.
     *
     * @var string
     */
    // protected $indexRequest = FacilitiesIndexRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the store request.
     *
     * @var string
     */
    // protected $storeRequest = FacilitiesStoreRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the show request.
     *
     * @var string
     */
    // protected $showRequest = FacilitiesShowRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the update request.
     *
     * @var string
     */
    // protected $updateRequest = FacilitiesUpdateRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the delete request.
     *
     * @var string
     */
    // protected $deleteRequest = FacilitiesDeleteRequest::class;

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

//    public function getFacilities()
//    {
//        $facilities = Facilities::all();
//        return response()->json($facilities);
//    }

//    public function index() {
////        echo '<pre>'; print_r("Welcome"); die;
//        return parent::index();
//    }

    /*
     * Modify the response of index
     */
     public function index()
     {        
        $result = parent::index();
        $response = json_decode($result->getContent());
        
        if($result->getStatusCode() == 200) {
            return $this->responseWithSuccessAndPagination($response, null, $result->getStatusCode(), 'facilities');
        }
        return $this->respondWithError(json_decode($response->getContent()), $result->getStatusCode());
     }

    /*
     * Modify the response for show
     */
     public function show(...$args)
     {
        try{
            $result = parent::show(...$args);
            $response = json_decode($result->getContent());
            if($result->getStatusCode() == 200) {
                $data = [
                    'facility' => $response->data
                ];
                return $this->respondWithSuccess($data, null, $result->getStatusCode());
            }
            return $this->respondWithError(json_decode($response->getContent()), $result->getStatusCode());
        }
        catch(\Exception $e) {
            return $this->respondWithError($e->getMessage(), 400);
        }
     }
}
