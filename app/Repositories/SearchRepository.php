<?php

namespace App\Repositories;

use DB;
use App\Resto;
use App\Review;

/**
 * Repository class used to handle restaurant searching 
 *
 */
class SearchRepository {

    public function getRestoAddressesNear($latitude, $longitude, $radius = 50) {

        $distances = Resto::select('restos.*')
                ->selectRaw('( 6371 * acos( cos( radians(?) ) *
            cos( radians( latitude ) )
            * cos( radians( longitude ) - radians(?))
            + sin( radians(?) ) *
            sin( radians(latitude ) ) )
          ) AS distance', [$latitude, $longitude, $latitude]);

        $restos = DB::table(DB::raw("({$distances->toSql()}) as restodistance"))
                ->mergeBindings($distances->getQuery())
                ->whereRaw("distance < ? ", [$radius])
                ->orderBy('distance')
                ->get();
        

        return $restos;
    }
    
    
    public function getAverageRating($resto){
        $reviews = Review::where('resto_id', "=" ,$resto->id)->get();
        $count = count($reviews);
        if ($count > 0){
            $sum = 0;
            
            foreach ($reviews as $review){
                $sum += $review->rating;
            }
            return ($sum/$count);
        }
        
        
    }

}
