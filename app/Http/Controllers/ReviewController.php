<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resto;
use App\Review;
use Illuminate\Support\Facades\Auth;

/**
 * Controller used to handle Review model logic
 * 
 * @author Hau Gilles Che, Thai-Vu Nguyen
 */
class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Insert a review into the database
     * @param Request $request
     * @param int $id Restaurant ID
     * @return return to the origin page
     */
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
    
    /**
     * Removes a review
     * @param Request $request
     * @param int $id Review ID
     * @return return to the origin page
     */
    public function delete(Request $request, $id){
        $review = Review::find($id);
        $review->delete();
        return redirect()->back();
    }
}
