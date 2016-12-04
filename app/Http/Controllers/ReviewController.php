<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resto;
use App\Review;

class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(Request $request, $id){
        $resto=Resto::find($id);
        $review = new Review(['title' => $request->title, 'content' => $request->content, 'rating' => $request->rating]);
        $resto->reviews()->save($review);
        return redirect()->back();
    }
    
    public function delete(Request $request, $id){
        $review = Review::find($id);
        $review->delete();
        return redirect()->back();
    }
}
