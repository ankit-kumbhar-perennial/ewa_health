<?php

namespace App\Http\Controllers\API;

use App\Appointment;
use App\Traits\ResponseTrait;
use Asahasrabuddhe\LaravelAPI\BaseController;

// use App\Http\Requests\AppointmentIndexRequest;
// use App\Http\Requests\AppointmentStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// use App\Http\Requests\AppointmentShowRequest;
// use App\Http\Requests\AppointmentUpdateRequest;
// use App\Http\Requests\AppointmentDeleteRequest;
/**
 * Class Appointment.
 */
class AppointmentController extends BaseController
{
    /*
     * Fully qualified name of the Model class that this controller represents.
     *
     * @var string
     */
     use ResponseTrait;
     protected $model = Appointment::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the index request.
     *
     * @var string
     */
    // protected $indexRequest = AppointmentIndexRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the store request.
     *
     * @var string
     */
//     protected $storeRequest = AppointmentStoreRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the show request.
     *
     * @var string
     */
    // protected $showRequest = AppointmentShowRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the update request.
     *
     * @var string
     */
    // protected $updateRequest = AppointmentUpdateRequest::class;

    /*
     * Fully qualified name of the Request class that will be used to validate the delete request.
     *
     * @var string
     */
    // protected $deleteRequest = AppointmentDeleteRequest::class;

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

    public function store()
    {
        try {
            DB::beginTransaction();

            $rules = array(
                'name' => 'required',
                'age' => 'required|numeric',
                'gender' => 'required',
                'location' => 'required',
                'contact' => 'required|numeric',
                'appointment_date' => 'required',
                'appointment_time' => 'required',
                'note' => 'required',
                'facility_id' => 'required',
                'relation_id' => 'required',
                'hospital_id' => 'required',
                'doctor_id' => 'required',
                'payment_mode' => 'required'
            );

            $validator = Validator::make(request()->request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondWithError($validator->errors(), 422);
            }

            request()->request->add(['key' => random_int(1000000000,9999999999)]);

            $result = parent::store();

            if ($result->getStatusCode() == 201) {
                DB::commit();
                return $this->respondWithSuccess(null, "Appointment booked successful", $result->getStatusCode());
            }
            DB::rollBack();
            return $this->respondWithError("Appointment store failed", 500);

        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\Log::info($ex->getMessage() . ' == ' . $ex->getLine());
            return $this->respondWithError("Appointment booking failed", 500);
        }
    }
}
