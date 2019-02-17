<?php

namespace App;

use Asahasrabuddhe\LaravelAPI\BaseModel as Model;

//use App\Http\Resources\FacilityHospitalResource;
/**
 * Class FacilityHospital.
 */
class FacilityHospital extends Model
{
    /*
     * Fully qualified of the Eloquent API Resource class that this model will be transformed into
     *
     * @var string
     */
    //protected $resource = FacilityHospitalResource::class;
    protected $table = "facility_hospital";

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
    // protected $filterable = [];

    //

    protected $fillable = ['facility_id', 'hospital_id'];
    
    protected $default = [ 'id','facility_id', 'hospital_id'];
     
    public $timestamps=true;
}
