<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /**
     * ---------------------------
     * User "hasMany" Transaction
     * ---------------------------
     */
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    /**
     * User hasMany Payment Through Transaction
     * ------------------------------
     * User "hasManyThrough" Payment
     * ------------------------------
     */
    public function payments()
    {
        return $this->hasManyThrough(
            'App\Payment',
            'App\Transaction'
        );
    }
}
