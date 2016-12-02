<?php

namespace App\Http\Controllers;

use App\Resto;

use Illuminate\Http\Request;

class RestoController extends Controller
{
    public function __construct(){
        
    }
    
    public function index(){
        $resto=Resto::find(1);
        //$reviews=resto::reviews();
        return view('geo.resto')->with('resto',$resto);
    }
}
