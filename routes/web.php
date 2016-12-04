<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', "HomeController@index");
Route::get('/home', "HomeController@index");
Route::get('/geo', "GeoController@index");
Route::post('/geo', "GeoController@index");
Route::get('/resto_info/{id}','RestoController@index');
Route::post('/search','SearchController@index');
Route::get('/create', "GeoController@create")->middleware('auth');
Route::post('/store', "GeoController@store")->middleware('auth');
Route::get('/resto_update/{id}','RestoController@update')->middleware('auth');
Route::post('/resto/store','RestoController@store')->middleware('auth');
Route::post('/resto/review/store/{id}', "ReviewController@store")->middleware('auth');
Auth::routes();

