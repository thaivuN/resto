<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


/**
 * Retrives the reviews of a restaurant
 */
Route::get('/resto/reviews', "ApiController@getReviews");

/**
 * Retrieves the 10 nearest  restaurant based on latitude and longitude
 */
Route::get('/restos', "ApiController@getNearbyRestos");

/**
 * Creates a restaurant
 */
Route::post('/resto/reviews/create', 'ApiController@storeReviews');

/**
 * Creates a review for a restaurant
 */
Route::post("/resto/create", "ApiController@registerResto");


//Extra route at the request of the android team

/**
 * Retrieves the details of the restaurant
 */
Route::get("resto/details", "ApiController@getRestoDetails");
/**
 * Attempt to authenticate.
 */
Route::post("/userlogin", 'ApiController@authenticate');