<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Asahasrabuddhe\LaravelAPI\BaseUser as Authenticatable;
use \Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'age', 'gender', 'address', 'contact_no', 'otp', 'otp_expired_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $default = [
        'name', 'email', 'password', 'age', 'gender', 'address', 'contact_no'
    ];
}
