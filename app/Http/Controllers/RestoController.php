<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestoController extends Controller
{
    public function __construct(){
        
    }
    
    public function index(){
        $resto=Resto::find(1);
        $address=Address::find(1);
        return view('resto_info')->with('resto',$resto)->with('address'
                ,$address);
    }
}
