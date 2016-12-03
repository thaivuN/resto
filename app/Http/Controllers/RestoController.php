<?php

namespace App\Http\Controllers;

use App\Resto;

use Illuminate\Http\Request;

class RestoController extends Controller
{
    public function __construct(){
        
    }
    
    public function index(Request $request,$id){
        $resto=Resto::find($id);
        return view('geo.resto')->with('resto',$resto);
    }
}
