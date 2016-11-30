<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['civic#', 'street', 'suite', 'city', 'country', 'postal_code'];
    //Indicates that the model is not timestamped.
    public $timestamps=false;
    
    /**
     * Gets the resto corresponding to a specific address.
     * @return Resto
     */
    public function resto(){
        return $this->belongsTo('App\Resto');
    }
    
}
