<?php

use App\Repositories\GeoRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GeoRepositoryTest extends TestCase
{
    /**
     * Testing with an existing Postal Code
     *
     * @return void
     */
    public function testGeocodingSearchResultsWithValidPostalCode()
    {
        $geoRepo = new GeoRepository();
        $test_address = "H2A 1E9"; 
        $test_pairs = $geoRepo->GetGeocodingSearchResults($test_address);
        
        $this->assertArrayHasKey("longitude", $test_pairs, 'cannot find the longitude');
        $this->assertArrayHasKey("lattitude", $test_pairs, 'cannot find the lattitude');
    }
    
    /**
     * Testing with a complete address
     */
    public function testGeocodingSearchResultsWithValidAddress(){
        $geoRepo = new GeoRepository();
        $test_address = "3040 Sherbrooke St. W, Westmount, Quebec"; 
        $test_pairs = $geoRepo->GetGeocodingSearchResults($test_address);
        
        $this->assertArrayHasKey("longitude", $test_pairs, 'cannot find the longitude');
        $this->assertArrayHasKey("lattitude", $test_pairs, 'cannot find the lattitude');
    }
    
    public function testGeocodingSearchResultsWithAmbiguousAddress(){
        
    }
    
    /**
     * Testing with something that is not an address
     * Result should be an empty return
     */
    public function testGeocodingSearchResultsWithWrongAddress(){
        $geoRepo = new GeoRepository();
        $test_address = "trololo this is not an address";
        $test_pairs = $geoRepo->GetGeocodingSearchResults($test_address);
        
        $this->assertEmpty($test_pairs);
    }
}
