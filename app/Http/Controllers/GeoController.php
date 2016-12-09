<?php

namespace App\Http\Controllers;

use App;
use DB;
use Validator;
use App\Repositories\GeoRepository;
use App\Repositories\SearchRepository;
use App\Repositories\PaginationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



/**
 * Controller used to handle the search of nearby restaurants
 * 
 * @author Thai-Vu Nguyen, Hau Gilles Che
 */
class GeoController extends Controller {

    protected $georepo;
    protected $searcher;
    protected $paginator;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeoRepository $georepo, SearchRepository $seacher, PaginationRepository $paginator) {
        $this->georepo = $georepo;
        $this->searcher = $seacher;
        $this->paginator= $paginator;
    }

    /**
     * Gets the nearby restaurant
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        
        if ($request->isMethod("GET")) {
            if ($request->session()->has("latitude") && $request->session()->has("longitude")) {
                $lat = $request->session()->get('latitude');
                $long = $request->session()->get('longitude');
            } else {
                //Check if user is authenticated, if so, use his postal code
                if (Auth::check()) {
                    $user = Auth::user();
                    $postal = $this->georepo->GetGeocodingSearchResults($user->postal_code);
                    $lat = $postal['latitude'];
                    $long = $postal['longitude'];
                } else {
                    return redirect("/home"); //Go back to the form
                }
            }
        } elseif ($request->isMethod("POST")) {
            $errorcode = $request->input("error");

            if ($errorcode === 0) {
                $lat = $request->input("latitude");
                $long = $request->input("longitude");
            } else {
                $postal = null;
                try {
                    $postal = $this->georepo->GetGeocodingSearchResults($request->input('postal'));
                } catch (\ErrorException $e) {
                    //Happens when user put in an empty string.
                }

                $validator = Validator::make(['latitude' => $postal['latitude'], 'longitude' => $postal['longitude']], ['latitude' => 'required|numeric', 'longitude' => 'required|numeric']);

                if ($validator->fails()) {
                    //The given postal code was not good enough
                    return redirect("/home");
                }

                $lat = $postal['latitude'];
                $long = $postal['longitude'];
            }
        }

        $request->session()->put("latitude", $lat);
        $request->session()->put("longitude", $long);

        $restos = $this->searcher->getRestoAddressesNear($lat, $long);
        $ratings = null;
        foreach ($restos as $resto) {
            $ratings[$resto->id] = $this->searcher->getAverageRating($resto);
        }

       $paginatedRestos = $this->paginator->makePaginableCollection($restos, "geo", 6);
        
        return view('geo.nearbyresto')->with('restos', $paginatedRestos)->with("ratings", $ratings);
    }    

}
