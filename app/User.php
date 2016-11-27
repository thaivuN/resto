<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
    
    /**
     *  Gets the reviews written by a user.
     * @return array
     */
    public function reviews(){
        return $this->hasMany('App\Review');
    }
    
    /**
     * Gets the resto records created by a user.
     * @return array
     */
    public function restos(){
        return $this->hasMany('App\Resto');
    }
}
