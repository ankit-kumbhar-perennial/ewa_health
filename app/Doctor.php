<?php

namespace App;

use Asahasrabuddhe\LaravelAPI\BaseModel as Model;

//use App\Http\Resources\DoctorResource;
/**
 * Class Doctor.
 */
class Doctor extends Model
{
    /*
     * Fully qualified of the Eloquent API Resource class that this model will be transformed into
     *
     * @var string
     */
    //protected $resource = DoctorResource::class;

    /*
     * Array of fields that will be included in the default representation of this model in JSON.
     * NOTE: The default preoperty will always be overridden by the resource property.
     *
     * @var array
     */
    // protected $default = [ 'id', attribute1', 'attribute2' ];

    /*
     * Array of fields that can be filtered using the API.
     *
     * @var array
     */
    protected $filterable = [
        'name', 'photo', 'education', 'experience', 'ratings', 'comments', 'hospital_id', 'appointment_id', 'gender'
    ];

    protected $hidden = [];

    protected $default = [
        'name', 'photo', 'education', 'experience', 'ratings', 'comments', 'hospital_id', 'appointment_id', 'gender'
    ];


}
