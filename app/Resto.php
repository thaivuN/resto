<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resto extends Model {

    protected $fillable = ['name', 'description', 'price', 'phone', 'email',
        'civic_num', 'street', 'suite', 'city', 'price', 'country', 'postal_code',
        'user_id', 'genre_id', 'longitude', 'latitude','link','province', 'image_link'];

    /**
     * Gets all the reviews of the resto.
     * @return array
     */
    public function reviews() {
        return $this->hasMany('App\Review');
    }

    /**
     * Gets all the resto's genre.
     * @return array
     */
    public function genre() {
        return $this->belongsTo('App\Genre');
    }

    /**
     * Gets the user that created the resto record.
     * @return User
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    

    public function userCanEdit(User $user) {
        return $user->id === $this->user_id;
    }
    
    public function ratings(){
        $count = count($this->reviews);
        if ($count > 0){
            $sum = 0;
            
            foreach ($this->reviews as $review){
                $sum = $sum + $review->rating;
            }
            return ($sum/$count);
        }
        
        //return $count;
    }

}
