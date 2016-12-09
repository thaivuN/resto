<?php

namespace App\Http\Controllers;

use DB;
use App\Resto;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\SearchRepository;
use App\Repositories\GeoRepository;
use Illuminate\Support\Facades\Auth;
use Validator;

/**
 * RESTful API class
 * To be implemented later
 */
class ApiController extends Controller {

    protected $searcher;
    protected $georepo;

    public function __construct(SearchRepository $seacher, GeoRepository $georepo) {
        $this->searcher = $seacher;
        $this->georepo = $georepo;
    }

    /**
     * Returning reviews of a restaurant based on its ID
     * @param Request $request
     * @return json response
     */
    public function getReviews(Request $request) {

        $this->validate($request, ['id' => 'required|numeric']);
        $resto = Resto::find($request->id);
        if (isset($resto)) {
            $reviews = $resto->reviews;
        } else {
            $reviews = [];
        }
        return response()->json($reviews, 200);
    }

    /**
     * Returning the Resto model based on an id
     * @param Request $request
     * @return json response
     */
    public function getRestoDetails(Request $request) {
        $this->validate($request, ['id' => 'required|numeric']);
        $resto = Resto::find($request->id);

        return response()->json($resto, 200);
    }

    /**
     * Add a review of to restaurant based on its ID
     * Need to pass an authenticable email and password
     * @param Request $request
     * @return json response
     */
    public function storeReviews(Request $request) {

        $credentials = $request->only('email', 'password');
        $valid = Auth::once($credentials);
        if (!$valid) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        } else {
            $this->validate($request, ['id' => 'required|numeric|exists:restos,id',
                'title' => 'required|max:255',
                'content' => 'required|max:5000',
                'rating' => 'required|numeric|min:1|max:5'
            ]);

            $user = User::where('email', $request->email)->first();

            $resto = Resto::find($request->id);
            $review = new Review(['title' => $request->title,
                'content' => $request->content,
                'rating' => $request->rating,
                'user_id' => $user->id]);
            $resto->reviews()->save($review);

            return response()->json(['success' => 'The review was successfully created'], 200);
        }
    }

    /**
     * Returns the 10 nearest resto based on the user's latitude and longitude
     * 
     * @param Request $request
     * @return json response
     */
    public function getNearbyRestos(Request $request) {
        $this->validate($request, ['lat' => 'required|numeric', 'long' => 'required|numeric']);

        $restos = $this->searcher->getTenNearestResto($request->lat, $request->long);

        return response()->json($restos, 200);
    }

    /**
     * Add a restaurant.
     * Need to pass an authenticable email and password
     * @param Request $request
     * @return json response
     */
    public function registerResto(Request $request) {

        $credentials = $request->only('email', 'password');

        $valid = Auth::once($credentials);
        if (!$valid) {
            return response()->json(['error', 'invalid_credentials'], 401);
        }

        $this->validateRequest($request);

        $pairs = $this->georepo->GetGeocodingSearchResults($request->postal_code);

        if ($this->validateLatitudeAndLongitude($pairs) == false) {
            return response()->json(['error' => 'Postal Code does not lead to a real location'], 422);
        }

        if ($this->validateUniqueResto($request, $pairs) == false) {
            return response()->json(['error' => 'The restaurant already exists'], 422);
        }


        $resto = new Resto([
            'name' => $request->name,
            'latitude' => $pairs['latitude'],
            'longitude' => $pairs['longitude']
        ]);
        
        $this->fillBasicRestoInfo($resto, $request);
        
        $user = User::where('email', $request->email)->first();
        $resto->user_id = $user->id;
        $resto->save();

        return response()->json(['success' => 'The restaurant was successfully created'], 200);
    }

    /**
     * Check if the combination of the longitude, latitude and name is unique in the database
     * 
     * @param Request $request
     * @param array $pairs containing latitude and longitude keys
     * @return boolean
     */
    private function validateUniqueResto(Request $request, $pairs) {
        $exists = Resto::where('name', '=', $request->name)
                ->where('latitude', '=', $pairs['latitude'])
                ->where('longitude', '=', $pairs['longitude'])
                ->count();

        //there is a non-0 count, the resto is not unique 
        if ($exists) {
            return false;
        } {
            return true;
        }
    }

    /**
     * Validates whethere or not the latitude and longitude exist in the array
     * 
     * @param array $pairs
     * @return boolean
     */
    private function validateLatitudeAndLongitude($pairs) {
        $extraValidator = Validator::make(
                        [
                    'latitude' => $pairs['latitude'],
                    'longitude' => $pairs['longitude']
                        ], [
                    'latitude' => 'required|numeric',
                    'longitude' => 'required|numeric'
        ]);

        if ($extraValidator->fails()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Validates the inputs from the Create/Update Restaurant form
     * @param Request $request
     * @return type
     */
    private function validateRequest(Request $request) {
        return $this->validate($request, [
                    'name' => 'required|max:255',
                    'description' => 'present|max:5000',
                    'resto_email' => 'present|email|max:255',
                    'price' => 'required|numeric|min:1|max:5',
                    'phone' => 'present|max:255',
                    'civic_num' => 'required|numeric',
                    'street' => 'required|max:255',
                    'suite' => 'present|numeric',
                    'city' => 'required|max:255',
                    'country' => 'required|max:255',
                    'postal_code' => 'required|max:255',
                    'province' => 'required|max:255',
                    'link' => 'present|url|max:255',
                    'genre' => 'required|max:255',
                    'img' => 'present|url'
        ]);
    }
    
    /**
     * Set the various basic fields of the Resto object (assuming the name, latitude and longitude is already in the Resto).
     * The method does not set the user_id nor does it save into the database.
     *  
     * @param Resto $resto
     * @param Request $request
     */
    private function fillBasicRestoInfo(Resto $resto, Request $request) {

        $resto->description = $request->description;
        $resto->email = $request->resto_email;
        $resto->phone = $request->phone;
        $resto->civic_num = $request->civic_num;
        $resto->price = $request->price;
        if (is_numeric($request->suite)) {
            $resto->suite = $request->suite;
        }
        $resto->street = $request->street;
        $resto->province = $request->province;
        $resto->image_link = $request->img;
        $resto->postal_code = $request->postal_code;
        $resto->city = $request->city;
        $resto->country = $request->country;
        $resto->link = $request->link;
        $genre = \App\Genre::firstOrCreate(['genre' => $request->genre]);
        $resto->genre_id = $genre->id;
    }

}
