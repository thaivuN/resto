<?php

namespace App\Http\Controllers;

use Validator;
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
        
        $request->session()->put("latitude", $lat);
        $request->session()->put("longitude", $long);
        
        $addresses = $this->searcher->getRestoAddressesNear($lat, $long);
        //return view('geo.search');
        return view('geo.search', ['addresses' => $addresses,]);

    }
    
    /**
     * Directs to the page containing the form for creating a Restorant
     * 
     * @param Request $request
     */
    public function create(Request $request){
        return view ('geo.storeresto');
    }
    
    /**
     * Store the restaurant into the database
     * @param Request $request
     */
    public function store(Request $request){
        
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'civic_num' =>'required|numeric',
            'street' => 'required|max:255',
            'suite' => 'present|numeric',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'postal_code' => 'required|max:255'
        ]);
        
        $pairs = $this->georepo->GetGeocodingSearchResults($request->get("postal_code"));
        
        $extraValidator = Validator::make(
                [
                    'latitude' => $pairs['latitude'],
                    'longitude' => $pairs['longitude']
                ], 
                [
                    'latitude' => 'required|numeric|max:10',
                    'longitude' => 'required|numeric|max:10'
                ]);
        
        if ($extraValidator->fails()){
            return redirect('/create')->withInput()->withErrors($extraValidator);
        }
        
        
        $genre = App\Genre::firstOrNew(['genre' => $request->genre]);
        
        $resto = App\Resto::firstOrNew([
            'name' => $request->name,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone
            
        ]);
        
        $address = App\Address::firstOrNew([
            'civic_num' => $request->civic_num,
            'longitude' => $pairs['longitude'],
            'latitude' => $pairs['latitude']
        ]);
        
        if(isset($resto->user_id)){
            //New field
        }
        
       
        
        
        return view ("home.index");
    }
    
    
}
