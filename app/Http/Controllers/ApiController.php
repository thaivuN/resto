<?php

namespace App\Http\Controllers;

use App\Resto;
use Illuminate\Http\Request;
use App\Repositories\SearchRepository;

/**
 * RESTful API class
 * To be implemented later
 */
class ApiController extends Controller {

    protected $searcher;

    public function __construct(SearchRepository $seacher) {
        $this->searcher = $seacher;
    }

    public function getReviews(Request $request) {
        
        $this->validate($request, ['id' => 'required|numeric']);
        
        $reviews = Resto::find($request->id)->reviews;
        return response()->json($reviews, 200);
    }

    public function storeReviews(Request $request) {
        
    }

    public function getNearbyRestos(Request $request) {
        $this->validate($request, ['lat' => 'required|numeric', 'long' => 'required|numeric']);
        
        $restos = $this->searcher->getRestoAddressesNear($request->lat, $request->long);
        
        return response()->json($restos, 200);
        
    }

    public function registerResto(Request $request) {
        
        $credentials = $request->only('email', 'password');
        $valid = Auth::once($credentials);
        if (!$valid) {
            return response()->json('error', 'invalid_credentials', 401);
        } else {
            
        }
    }

}
