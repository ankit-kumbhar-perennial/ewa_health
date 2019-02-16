<?php

namespace App\Http\Controllers\API;

use App\Facilities;
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
     protected $model = Facilities::class;

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
//        return $facilities;
//    }

    public function show(...$args) {
        echo '<pre>'; print_r("Welcome"); die;
    }
}
