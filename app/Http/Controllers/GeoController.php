<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->isMethod("post")){
            $errorcode = $request->input("error");
            
            if ($errorcode === 0){
                $lat = $request->input("latitude");
                $long = $request->input("longitude");
            }
            else{
                
            }
            
        }
        return view('geo.search');

    }
    
}
