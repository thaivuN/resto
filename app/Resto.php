<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resto extends Model {

    protected $fillable = ['name', 'description', 'price', 'phone#', 'email',
        'civic#', 'street', 'suite', 'city', 'country', 'postal_code', 'user_id', 'genre_id'];

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
    public function genres() {
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

}
