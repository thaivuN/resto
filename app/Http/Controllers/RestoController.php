<?php

namespace App\Http\Controllers;

use App\Resto;
use App\User;
use Validator;
use App\Genre;
use App\Repositories\GeoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestoController extends Controller
{
    protected $georepo;
    public function __construct(GeoRepository $georepo){
        $this->georepo = $georepo;
    }
    
    public function index(Request $request,$id){
        $resto=Resto::find($id);
        $reviews = $resto->reviews()->latest()->paginate(5);
        return view('resto.resto-details')->with('resto',$resto)->with("reviews", $reviews);
    }
    
    public function update(Request $request, $id){
        $resto=Resto::find($id);
        $user=User::find(Auth::id());
        if($resto->userCanEdit($user))
            return view('resto.resto-update')->with('resto',$resto);
    }
    
    public function save(Request $request, $id){
        $this->validate($request,[
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
            'postal_code' => 'required|max:255',
            'genre' => 'required|max:255',
            'province'=> 'required|max:255',
            'link' => 'present|url'
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
            return redirect()->back()->withInput()->withErrors(['lat_long' => 'The postal code is invalid']);
        }
        $resto=Resto::find($id);
        $resto->latitude=$pairs['latitude'];
        $resto->longitude=$pairs['longitude'];
        
        $resto->name=$request->name;
        $resto->description=$request->description;
        $resto->email=$request->email;
        $resto->phone=$request->phone;
        $resto->civic_num=$request->civic_num;
        $resto->price=$request->price;
        if (is_numeric($request->suite)){
                $resto->suite = $request->suite;
            }
        $resto->street=$request->street;
        $resto->postal_code = $request->postal_code;
        $resto->city = $request->city;
        $resto->country = $request->country;
        $resto->province = $request->province;
        $resto->link = $request->link;
        $genre=Genre::firstOrCreate(['genre'=>$request->genre]);
        $resto->genre_id=$genre->id;
        $resto->save();
        return redirect('/resto_info/'.$id);
    }
}
