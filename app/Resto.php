<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resto extends Model
{
    
    protected $fillable = ['name', 'price', 'phone#', 'email'];
    /**
     * Gets all the reviews of the resto.
     * @return array
     */
    public function reviews(){
        return $this->hasMany('App\Review');
    }
    
    /**
     * Gets all the resto's genre.
     * @return array
     */
    public function genres(){
        return $this->belongsToMany('App\Genre');
    }
    
    /**
     * Gets the user that created the resto record.
     * @return User
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    /**
     * Gets all the locations of the resto.
     * @return array
     */
    public function addresses(){
        return $this->hasMany('App\Address');
    }
}
