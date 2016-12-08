<?php

namespace App\Http\Controllers;

use App;
use DB;
use Validator;
use App\Repositories\GeoRepository;
use App\Repositories\SearchRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
     * Gets the nearby restaurant
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
            else{   
                $postal = null;
                try{
                $postal = $this->georepo->GetGeocodingSearchResults($request->input('postal'));
                }
                catch(\ErrorException $e){
                    //Happens when user put in an empty string.
                    //Since we do check
                }
                
                $validator = Validator::make(['latitude' => $postal['latitude'], 'longitude' => $postal['longitude']], 
                ['latitude' => 'required|numeric', 'longitude' => 'required|numeric']);
                
                if ($validator->fails()){
                    //The given address/postal code was not good enough
                    //TO DO: Instead of redirecting to home, set default address;
                    
                    return redirect("/home");
                     
                }
                
                $lat = $postal['latitude'];
                $long = $postal['longitude'];
                
            }
            
            
        }
        
        $request->session()->put("latitude", $lat);
        $request->session()->put("longitude", $long);
        
        $restos = $this->searcher->getRestoAddressesNear($lat, $long);
        foreach($restos as $resto){
            $ratings[$resto->id] = $this->searcher->getAverageRating($resto);
        }
        //return view('geo.search');
        //return view('geo.nearbyresto', ['restos' => $restos,]);
        //return view('geo.nearbyresto')->with('restos',$restos)->with("ratings",$ratings);
        return view('geo.nearbyresto')->with('restos',$restos)->with("ratings",$ratings);

    }
   
    
}
