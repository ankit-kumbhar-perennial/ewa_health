<?php

namespace App;

use Asahasrabuddhe\LaravelAPI\BaseModel as Model;

class Appointment extends Model
{
    protected $fillable=[
        'name', 'age', 'gender', 'location', 'contact', 'appointment_date', 'appointment_time', 'note',
        'facility_id', 'hospital_id', 'payment_mode','key', 'doctor_id', 'relation_id', 'status'
    ];


    protected $default=[
        'name', 'age', 'gender', 'location', 'contact', 'appointment_date', 'appointment_time', 'note',
        'facility_id', 'hospital_id', 'payment_mode','key', 'doctor_id', 'relation_id'
    ];
}
