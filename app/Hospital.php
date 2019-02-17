<?php

namespace App;



//use Illuminate\Database\Eloquent\Model;
use Asahasrabuddhe\LaravelAPI\BaseModel as Model;

class Hospital extends Model
{
	public $timestamps = true;

    protected $fillable = [
        'name', 'address', 'logo', 'ratings', 'facility_id', 'doctor_id'
    ];

    protected $hidden = ['pivot'];

    protected $casts = [
    	'created_at' => 'datetime:Y-m-d H:i:s',
    	'updated_at' => 'datetime:Y-m-d H:i:s'

    ];


    protected $default = [
        'name', 'address', 'logo', 'ratings'
    ];


    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }
}
