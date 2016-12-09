<?php

namespace App\Repositories;

use DB;
use App\Resto;
use App\Review;

/**
 * Repository class used to handle restaurant searching 
 *
 * @author Thai-Vu Nguyen
 */
class SearchRepository {

    /**
     * Returns the nearest restaurant based on the latitude and longitude
     * 
     * @param float $latitude
     * @param float $longitude
     * @param float $radius
     * @return the nearest restaurants
     */
    public function getRestoAddressesNear($latitude, $longitude, $radius = 50) {
        
        $restos = $this->buildHarversineQuery($latitude, $longitude, $radius)->get();

        return $restos;
    }
    
    /**
     * Returns the 10 nearest restaurant based on the latitude and longitude
     * @param float $latitude
     * @param float $longitude
     * @param float $radius
     * @return the 10 nearest restaurants
     */
    public function getTenNearestResto($latitude, $longitude, $radius = 50){
        $restos = $this->buildHarversineQuery($latitude, $longitude, $radius)->limit(10)->get();
        return $restos;
    }
    
    /**
     * Builds the query used to find the nearest restaurants
     * @param float $latitude
     * @param float $longitude
     * @param float $radius
     * @return a laravel query search
     */
    private function buildHarversineQuery($latitude, $longitude, $radius = 50){
        $distances = Resto::select('restos.*')
                ->selectRaw('( 6371 * acos( cos( radians(?) ) *
            cos( radians( latitude ) )
            * cos( radians( longitude ) - radians(?))
            + sin( radians(?) ) *
            sin( radians(latitude ) ) )
          ) AS distance', [$latitude, $longitude, $latitude]);

        $restosQuery = DB::table(DB::raw("({$distances->toSql()}) as restodistance"))
                ->mergeBindings($distances->getQuery())
                ->whereRaw("distance < ? ", [$radius])
                ->orderBy('distance');
        

        return $restosQuery;
    }

    /**
     * Returns the average rating of a restaurant
     * @param $resto Resto model or an object containing the 'id' key attribute
     * @return float
     */
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
