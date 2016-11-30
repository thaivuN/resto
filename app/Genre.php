<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public $timestamps=false;
    /**
     * Gets all the restos that are under a particular genre.
     * @return array
     */
    public function restos(){
        return $this->belongsToMany('App\Resto');
    }
}
