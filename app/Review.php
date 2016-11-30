<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['title', 'content', 'rating'];
    
    /**
     * Gets the user that wrote the review.
     * @return User
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    /**
     * Gets the resto that the review is targetted to.
     * @return Resto
     */
    public function resto(){
        return $this->belongsTo('App\Resto');
    }
}
