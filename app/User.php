<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = \Hash::make($value);
    }

    public function Payments(){
        return $this->hasMany(Payment::class);
    }

    public function Carts(){
        return $this->hasMany(Cart::class);
    }
}
