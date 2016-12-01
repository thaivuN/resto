<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestoController extends Controller
{
    public function __construct(){
        
    }
    
    public function index($id){
        $resto=Resto::find($id);
        $address=Address::find($id);
        return view('resto.info')->with('resto',$resto)->with('address'
                ,$address);
    }
}
