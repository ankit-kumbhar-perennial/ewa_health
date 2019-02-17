<?php

namespace App;

use Asahasrabuddhe\LaravelAPI\BaseModel as Model;

class Appointment extends Model
{
    protected $fillable=[
        'name', 'age', 'gender', 'location', 'contact', 'appointment_date', 'note',
        'facility_id', 'hospital_id', 'payment_mode','key', 'doctor_id', 'status', 'user_id'
    ];


    protected $default=[
        'name', 'age', 'gender', 'location', 'contact', 'appointment_date', 'note',
        'facility_id', 'hospital_id', 'payment_mode','key', 'doctor_id', 'status'
    ];
    
}
