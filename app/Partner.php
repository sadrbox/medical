<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Partner extends Authenticatable
{
    
    protected $fillable = [
        'network',
        'identity',
        'uid',
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'phone',
        'bdate',
        'photo',
        'verified_partner',
        'sex',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
