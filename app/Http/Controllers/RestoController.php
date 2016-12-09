<?php

namespace App\Http\Controllers;

use DB;
use App\Resto;
use App\User;
use Validator;
use App\Genre;
use App\Repositories\GeoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller class responsible to handle actions concerning the Resto model.
 * 
 * @author Hau Gilles Che, Thai-Vu Nguyen
 */
class RestoController extends Controller {

    protected $georepo;

    /**
     * Controller constructor
     * @param GeoRepository $georepo
     */
    public function __construct(GeoRepository $georepo) {
        $this->georepo = $georepo;
    }

    /**
     * Returns a view containing the details of a restaurant
     * @param Request $request
     * @param int $id The Restaurant ID
     * @return view The view containing restaurant details
     */
    public function index(Request $request, $id) {
        $resto = Resto::find($id);
        $reviews = $resto->reviews()->latest()->paginate(3);
        return view('resto.resto-details')->with('resto', $resto)->with("reviews", $reviews);
    }

    /**
     * Directs to the page containing the form for creating a Restaurant
     * 
     * @param Request $request
     * @return view The view for the form that creates a restaurant
     */
    public function create(Request $request) {
        return view('geo.storeresto');
    }

    /**
     * Handles the storeresto form and store the restaurant into the database
     * @param Request $request
     */
    public function store(Request $request) {

        $this->validateRequest($request);

        $pairs = $this->georepo->GetGeocodingSearchResults($request->postal_code);

        if ($this->validateLatitudeAndLongitude($pairs) == false) {
            return redirect()->back()->withInput()->withErrors(['postal_code' => 'The postal code is invalid']);
        }

        if ($this->validateUniqueResto($request, $pairs) == false) {
            return redirect()->back()->withInput()
                            ->withErrors(['address' => 'The Address already exists']);
        }

        //The resto is new
        $resto = new Resto([
            'name' => $request->name,
            'latitude' => $pairs['latitude'],
            'longitude' => $pairs['longitude']
        ]);

        $this->fillBasicRestoInfo($resto, $request);
        $resto->user_id = Auth::id();
        $resto->save();

        return view("home.index");
    }

    /**
     * Return the view containing the form that updates a restaurant.
     * @param Request $request
     * @param int $id The restaurant ID
     * @return view
     */
    public function update(Request $request, $id) {
        $resto = Resto::find($id);
        $user = User::find(Auth::id());
        if ($resto->userCanEdit($user))
            return view('resto.resto-update')->with('resto', $resto);
    }

    /**
     * Handles the update resto form and updates the restaurant based on its ID.
     * @param Request $request
     * @param int $id Restaurant ID
     * @return view The restaurant's details page
     */
    public function save(Request $request, $id) {
        $this->validateRequest($request);

        $pairs = $this->georepo->GetGeocodingSearchResults($request->postal_code);

        if ($this->validateLatitudeAndLongitude($pairs) == false) {
            return redirect()->back()->withInput()->withErrors(['postal_code' => 'The postal code is invalid']);
        }

        $resto = Resto::find($id);
        $resto->name = $request->name;
        $resto->latitude = $pairs['latitude'];
        $resto->longitude = $pairs['longitude'];

        $this->fillBasicRestoInfo($resto, $request);
        $resto->save();
        return redirect('/resto_info/' . $id);
    }

    /**
     * Validates the inputs from the Create/Update Restaurant form
     * @param Request $request
     * @return type
     */
    private function validateRequest(Request $request) {
        return $this->validate($request, [
                    'name' => 'required|max:255',
                    'description' => 'required|max:5000',
                    'email' => 'present|email|max:255',
                    'price' => 'required|numeric|min:1|max:5',
                    'phone' => 'required|max:255',
                    'civic_num' => 'required|numeric',
                    'street' => 'required|max:255',
                    'suite' => 'present|max:255',
                    'city' => 'required|max:255',
                    'country' => 'required|max:255',
                    'postal_code' => 'required|max:255',
                    'genre' => 'required|max:255',
                    'province' => 'required|max:255',
                    'link' => 'present|url',
                    'image_link' => 'present|url'
        ]);
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
     * Set the various basic fields of the Resto object (assuming the name, latitude and longitude is already in the Resto).
     * The method does not set the user_id nor does it save into the database.
     *  
     * @param Resto $resto
     * @param Request $request
     */
    private function fillBasicRestoInfo(Resto $resto, Request $request) {

        $resto->description = $request->description;
        $resto->email = $request->email;
        $resto->phone = $request->phone;
        $resto->civic_num = $request->civic_num;
        $resto->price = $request->price;
        $resto->suite = $request->suite;
        $resto->street = $request->street;
        $resto->province = $request->province;
        $resto->image_link = $request->image_link;
        $resto->postal_code = $request->postal_code;
        $resto->city = $request->city;
        $resto->country = $request->country;
        $resto->link = $request->link;
        $genre = Genre::firstOrCreate(['genre' => $request->genre]);

        $resto->genre_id = $genre->id;
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

}
