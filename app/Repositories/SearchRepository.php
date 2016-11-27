<?php

namespace App\Repositories;

use App\Resto;
use App\Address;

/**
 * Repository class used to handle restaurant searching 
 *
 */
class SearchRepository {

    public function getRestosNear($latitude, $longitude, $radius = 50) {

        $addresses = Address::selectRaw('( 6371 * acos( cos( radians(?) ) *
          cos( radians( latitude ) )
         * cos( radians( longitude ) - radians(?))
          + sin( radians(?) ) *
          sin( radians(latitude ) ) )
          ) AS distance', [$latitude, $longitude, $latitude])
          ->whereRaw("'distance' < ? ", [$radius])
          ->orderBy('distance')
          ->get();
        
        //Find a way to join to the restos table
        

        
        return $restos;
    }

}
