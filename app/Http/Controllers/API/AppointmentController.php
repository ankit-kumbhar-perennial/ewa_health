<?php

namespace App\Http\Controllers\API;

use App\Appointment;
use App\Traits\ResponseTrait;
use Asahasrabuddhe\LaravelAPI\BaseController;
use App\Http\Controllers\API\UserController;

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
                'payment_mode' => 'required'
            );

            $validator = Validator::make(request()->request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondWithError($validator->errors(), 422);
            }

            request()->request->add(['key' => random_int(1000000000,9999999999)]);

            if(request()->request->get('hospital_id') != '') {
                $doctor_id = $this->getDoctorByHospital(request()->request->get('hospital_id'), request()->request->get('gender'));

                request()->request->add(['doctor_id' => $doctor_id]);
            }

            $result = parent::store();

            $response = json_decode($result->getContent(), true);

            if ($result->getStatusCode() == 201) {
                DB::commit();
                $data['key'] = request()->request->get('key');
                return $this->respondWithSuccess($data, "Appointment booked successful", $result->getStatusCode());
            }
            DB::rollBack();
            return $this->respondWithError("Appointment store failed", 500);

        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\Log::info($ex->getMessage() . ' == ' . $ex->getLine());
            return $this->respondWithError("Appointment booking failed", 500);
        }
    }

    /*
     * Modify the response of index
     */
    public function index()
    {        
        $result = parent::index();
        $response = json_decode($result->getContent());
        
        if($result->getStatusCode() == 200) {

            if(isset($response->data[0]->doctor_id)) {
                
                $doctor_details = app('App\Http\Controllers\API\UserController')->getDoctor($response->data[0]->doctor_id);
                $response->data['doctor_details'] = $doctor_details;
            }

            if(isset($response->data[0]->facility_id)) {
                
                $facility_details = app('App\Http\Controllers\API\UserController')->getFacility($response->data[0]->facility_id);
                $response->data['facility_details'] = $facility_details;
            }

            if(isset($response->data[0]->hospital_id)) {
                
                $hospital_details = app('App\Http\Controllers\API\UserController')->getHospital($response->data[0]->hospital_id);
                $response->data['hospital_details'] = $hospital_details;
            }

            if(isset($response->data[0]->relation_id)) {
                
                $relation_details = app('App\Http\Controllers\API\UserController')->getRelation($response->data[0]->relation_id);
                $response->data['relation_details'] = $relation_details;
            }

            return $this->responseWithSuccessAndPagination($response, null, $result->getStatusCode(), 'appointments');
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
                'appointment' => $response->data
            ];
            return $this->respondWithSuccess($data, null, $result->getStatusCode());
        }
        return $this->respondWithError(json_decode($response->getContent()), $result->getStatusCode());
    }

    /*
     * Get doctor by hospital id
     */
    public function getDoctorByHospital($hospital_id, $gender) {
        $doctors = \DB::table('doctors')
            ->where(['hospital_id' => $hospital_id, 'gender' => $gender])
            ->get();

        return $doctors->pluck('id')->shuffle()->first();
    }
}
