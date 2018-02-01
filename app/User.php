<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'username', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    
    public function pages()
    {
        return $this->hasMany('App\Page');
    }
}
