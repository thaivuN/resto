<?php

use App\Repositories\GeoRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GeoRepositoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testValidPostalCode()
    {
        $geoRepo = new GeoRepository();
        $test_address = "H2A 1E9"; 
        $test_pairs = $geoRepo->GetGeocodingSearchResults($test_address);
        
        $this->assertArrayHasKey("longitude", $test_pairs, 'cannot find the longitude');
        $this->assertArrayHasKey("lattitude", $test_pairs, 'cannot find the lattitude');
    }
    
    public function testValidAddress(){
        
    }
    
    public function testAmbiguousAddress(){
        
    }
    
    public function testWrongAddress(){
        //$geoRepo = new GeoRepository();
        
    }
}
