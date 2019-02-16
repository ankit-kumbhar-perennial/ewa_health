<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Asahasrabuddhe\LaravelAPI\BaseModel as Model;

class Facilities extends Model
{
    protected $fillable = [
        'id', 'name'
    ];

    protected $hidden = [

    ];

    protected $default = [
        'id', 'name'
    ];
}
