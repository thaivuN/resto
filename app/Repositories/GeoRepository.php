<?php

namespace App\Repositories;

use App\Resto;

/**
 * Repository class handling the fetching of latitude and longitude from an address
 * 
 * @author Thai-Vu Nguyen
 */
class GeoRepository {

    /**
     * Returns an array containing latitude and longitude keys
     * @param string $address
     * @return array
     */
    public function GetGeocodingSearchResults($address) {
        $address = urlencode($address); //Url encode since it was provided by user
        $url = "http://maps.google.com/maps/api/geocode/xml?address={$address}&sensor=false";

        // Retrieve the XML file
        $results = file_get_contents($url);
        $xml = new \DOMDocument(); //backslash to indicate global namespace
        $xml->loadXML($results);

        // traverse the DOMDocument or use XPath to find the longitude/latitude pairs
        $xpath = new \DOMXpath($xml);

        //Check if status is OK
        $status = $xpath->query('status')->item(0)->nodeValue;

        if (isset($status) && !empty($status) && $status === 'OK') {
            $geo_results = $xpath->query('result');
            
            //Check if the result is one
            if ($geo_results->length == 1){
                //Get lattitude and longitude
                $lat = $xpath->query('geometry/location/lat', $geo_results->item(0))->item(0)->nodeValue;
                $long = $xpath->query('geometry/location/lng', $geo_results->item(0))->item(0)->nodeValue;
                
                $pairs['latitude'] = $lat;
                $pairs['longitude'] = $long;
                
                return $pairs;
            }
            
        }
        
        
    }

}
