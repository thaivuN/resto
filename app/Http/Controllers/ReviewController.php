<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resto;
use App\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(Request $request, $id){
        
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required|max:5000',
            'rating' => 'required|numeric|min:1|max:5'
        ]);
        
        $resto=Resto::find($id);
        $review = new Review(['title' => $request->title, 'content' => $request->content, 'rating' => $request->rating, 'user_id' => Auth::id()]);
        $resto->reviews()->save($review);
        return redirect()->back();
    }
    
    public function delete(Request $request, $id){
        $review = Review::find($id);
        $review->delete();
        return redirect()->back();
    }
}
