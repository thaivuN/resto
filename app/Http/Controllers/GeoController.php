<?php

namespace App\Http\Controllers;

use App\Repositories\GeoRepository;
use App\Repositories\SearchRepository;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    protected $georepo;
    protected $searcher;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeoRepository $georepo, SearchRepository $seacher)
    {
        //$this->middleware('auth');
        $this->georepo = $georepo;
        $this->searcher = $seacher;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->isMethod("get")){
            if($request->session()->has("latitude") && $request->session()->has("longitude"))
            {
                  
                $lat = $request->session()->get('latitude');
                $long = $request->session()->get('longitude');
                
                
            }
            else
            {
                return redirect("/home");
            }
        }
        elseif ($request->isMethod("post")){
            $errorcode = $request->input("error");
            
            if ($errorcode == 0){
                $lat = $request->input("latitude");
                $long = $request->input("longitude");
                
                
                
            }
            else if ($errorcode == 6){
                $postal = $this->georepo->GetGeocodingSearchResults($request->input('postal'));
                
                if (is_array($postal) && is_numeric($postal['latitude']) && is_numeric($postal['longitude'])){
                    //The postal code is valid
                    
                    $lat = $postal['latitude'];
                    $long = $postal['longitude'];
                    
                    
                }
                else{
                    //The given address/postal code was not good enough
                    //TO DO: Instead of redirecting to home, set default address;
                    
                    return redirect("/home");
                     
                }
                
                
            }
            
        }
        
        //$addresses = $this->searcher->getRestoAddressesNear($lat, $long);
        return view('geo.search');
        //return view('geo.search', ['addresses' => $addresses,]);

    }
    
    public function store(Request $request){
        
    }
}
