<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{

    protected $fillable = [
        'name', 'nohp', 'address', 'email', 'password', 'role_id', 'token','photo'
    ];
    protected $hidden = [
        'password'
    ];
    public $timestamps = FALSE;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
