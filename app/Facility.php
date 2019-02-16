<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Asahasrabuddhe\LaravelAPI\BaseModel as Model;

class Facility extends Model
{
    protected $fillable = [
        'name', 'hospital_id', 'created_at', 'updated_at'
    ];

    protected $hidden = [

    ];

    protected $default = [
        'name', 'hospital_id', 'created_at', 'updated_at'
    ];
}
