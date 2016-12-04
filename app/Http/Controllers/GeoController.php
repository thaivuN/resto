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
            else if ($errorcode == 6){   
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
        //return view('geo.search');
        return view('geo.nearbyresto', ['restos' => $restos,]);

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
        //Notes: should change description, email and phone to nullable
        //Therefore can't rely on phone for uniqueness
        
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:5000',
            'email' => 'present|email|max:255',
            'price' => 'required|numeric|min:1|max:5',
            'phone' => 'required|max:255',
            'civic_num' =>'required|numeric',
            'street' => 'required|max:255',
            'suite' => 'present|numeric',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'postal_code' => 'required|max:255'
        ]);
        
        $pairs = $this->georepo->GetGeocodingSearchResults($request->postal_code);
        
        $extraValidator = Validator::make(
                [
                    'latitude' => $pairs['latitude'],
                    'longitude' => $pairs['longitude']
                ], 
                [
                    'latitude' => 'required|numeric',
                    'longitude' => 'required|numeric'
                ]);
        
        if ($extraValidator->fails()){
            return redirect('/create')->withInput()->withErrors(['lat_long' => 'The postal code is invalid']);
        }
        
        
        
        $exists = DB::table('restos')->where('name', '=', $request->name)
                ->where('latitude', '=', $pairs['latitude'])
                ->where('longitude', '=', $pairs['longitude'])
                ->count();
         
        if($exists){
           return redirect()->back()->withInput()
                   ->withErrors(['address'=>'The Address already exists','weirdname' => $resto->name, 'weirdlat' => $resto->latitude, 'weirdlng' =>$resto->longitude]);
        }
        else{
            //The resto is new
            $resto = new App\Resto([
            'name' => $request->name,
            'latitude' => $pairs['latitude'],
            'longitude' =>$pairs['longitude']
            ]);
            $resto->description = $request->description;
            $resto->email = $request->email;
            $resto->phone = $request->phone;
            $resto->civic_num = $request->civic_num;
            $resto->price = $request->price;
            if (is_numeric($request->suite)){
                $resto->suite = $request->suite;
            }
            $resto->street = $request->street;
            
        
            $resto->postal_code = $request->postal_code;
            $resto->city = $request->city;
            $resto->country = $request->country;
            
            $genre = App\Genre::firstOrCreate(['genre' => $request->genre]);
            
            $resto->genre_id = $genre->id;
            $resto->user_id = Auth::id();
            $resto->save();
            
            return view ("home.index");
        }
        
        
        
    }
    
    
}
