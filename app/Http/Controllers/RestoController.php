<?php

namespace App\Http\Controllers;

use App\Resto;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestoController extends Controller
{
    public function __construct(){
        
    }
    
    public function index(Request $request,$id){
        $resto=Resto::find($id);
        $reviews = $resto->reviews()->paginate(5);
        return view('resto.resto-details')->with('resto',$resto)->with("reviews", $reviews);
    }
    
    public function update(Request $request, $id){
        $resto=Resto::find($id);
        $user=User::find(Auth::id());
        if($resto->userCanEdit($user))
            return view('resto.resto-update')->with('resto',$resto);
    }
    
    public function store(Request $request){
        $this->validate($request,[
           'name' => 'required|max:255',
            'description' => 'required|max:5000',
            'email' => 'present|email|max:255',
            'price' => 'required|numeric|min:1|max:5',
            'phone' => 'required|max:255',
            'civic_num' =>'required|numeric',
            'street' => 'required|max:255',
            'suite' => 'present|numeric',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'postal_code' => 'required|max:255'
        ]);
        
    }
}
