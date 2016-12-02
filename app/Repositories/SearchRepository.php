<?php

namespace App\Repositories;

use App\Address;

/**
 * Repository class used to handle restaurant searching 
 *
 */
class SearchRepository {

    public function getRestoAddressesNear($latitude, $longitude, $radius = 50) {

        $distances = Address::select('addresses.*')
                ->selectRaw('( 6371 * acos( cos( radians(?) ) *
            cos( radians( latitude ) )
            * cos( radians( longitude ) - radians(?))
            + sin( radians(?) ) *
            sin( radians(latitude ) ) )
          ) AS distance', [$latitude, $longitude, $latitude]);

        $addresses = DB::table(DB::raw("({$distances->toSql()}) as restodistance"))
                ->mergeBindings($distances->getQuery())
                ->whereRaw("distance < ? ", [$radius])
                ->orderBy('distance')
                ->get();

        return $addresses;
    }

}
