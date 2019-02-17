<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Asahasrabuddhe\LaravelAPI\BaseModel as Model;

class Facility extends Model
{
    protected $fillable = [
        'name', 'created_at', 'updated_at'
    ];

    protected $hidden = [

    ];

    protected $casts = [
    	'created_at' => 'datetime:Y-m-d H:i:s',
    	'updated_at' => 'datetime:Y-m-d H:i:s'

    ];

    protected $default = [
        'name', 'created_at', 'updated_at'
    ]; 

    protected $with = ['hospitals'];

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);
    }
}
