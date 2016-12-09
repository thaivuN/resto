<?php

namespace App\Http\Controllers;

use DB;
use App\Resto;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use App\Repositories\SearchRepository;
use App\Repositories\GeoRepository;
use Illuminate\Support\Facades\Auth;
use Validator;


class ApiCont extends Controller
{
    public function storeReviews(Request $request) {

        $credentials = $request->only('email', 'password');
        //$credentials = ['email'=> $request->email, 'password' => $request->password];
        
        //var_dump($credentials);
        //$temp = $request->all();
        //var_dump($temp);
        $valid = Auth::once($credentials);
        if (!$valid) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        } else {
            $this->validate($request, ['id' => 'required|numeric|exists:restos,id',
                'title' => 'required|max:255',
                'content' => 'required|max:5000',
                'rating' => 'required|numeric|min:1|max:5'
            ]);

            $user = User::where('email', $request->email)->first();

            $resto = Resto::find($request->id);
            $review = new Review(['title' => $request->title,
                'content' => $request->content,
                'rating' => $request->rating,
                'user_id' => $user->id]);
            $resto->reviews()->save($review);

            return response()->json(['success' => 'The review was successfully created'], 200);
        }
    }
}
