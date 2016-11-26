<?php

namespace App\Repositories;

use App\Resto;

/**
 * Repository class
 */
class GeoRepository {

    public function GetGeocodingSearchResults($address) {
        $address = urlencode($address); //Url encode since it was provided by user
        $url = "http://maps.google.com/maps/api/geocode/xml?address={$address}&sensor=false";

        // Retrieve the XML file
        $results = file_get_contents($url);
        $xml = new \DOMDocument(); //backslash to indicate global namespace
        $xml->loadXML($results);

        // traverse the DOMDocument or use XPath to find the longitude/latitude pairs
        $xpath = new DOMXpath($xml);
        
        //TODO: Check if status is OK
        
        //Check if the result is one
        
        //Get lattitude and longitude
        
        return $pairs;
    }

}
