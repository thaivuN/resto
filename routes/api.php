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


Route::get('/resto/reviews', "ApiController@getReviews");
Route::get('/restos', "ApiController@getNearbyRestos");
//GET for testing purpose
Route::get("/resto/create", "ApiController@registerResto");
Route::get("/resto/reviews/create", "ApiController@storeReviews");
Route::post("/resto/reviews/create", "ApiController@storeReviews");