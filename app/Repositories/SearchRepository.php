<?php

namespace App\Repositories;

use App\Address;

/**
 * Repository class used to handle restaurant searching 
 *
 */
class SearchRepository {

    public function getRestoAddressesNear($latitude, $longitude, $radius = 50) {

        $addresses = Address::selectRaw('( 6371 * acos( cos( radians(?) ) *
          cos( radians( latitude ) )
         * cos( radians( longitude ) - radians(?))
          + sin( radians(?) ) *
          sin( radians(latitude ) ) )
          ) AS distance', [$latitude, $longitude, $latitude])
          ->whereRaw("'distance' < ? ", [$radius])
          ->orderBy('distance')
          ->get();
        
        
        return $addresses;
    }

}
