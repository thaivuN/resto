<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resto;
use App\Genre;
use App\Repositories\SearchRepository;

/**
 * Controller handling searching actions and logic
 * 
 * @author Hau Gilles Che, Thai-Vu Nguyen
 */
class SearchController extends Controller
{
    protected $searcher;
    public function __construct(SearchRepository $seacher)
    {
        
        $this->searcher = $seacher;
    }
    /**
     * Display search results
     *
     * @return The view containg the search result
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $restos = Resto::join('genres', 'genres.id', '=','restos.genre_id' )
                ->where('name', 'like', '%'.$search.'%')
                ->orWhere('city', 'like', '%'. $search.'%')
                ->orWhere('genre', 'like', '%'.$search.'%')
                ->select("restos.*")
                ->paginate(6);
     
        $ratings = null;
        foreach($restos as $resto){
            $ratings[$resto->id] = $this->searcher->getAverageRating($resto);
        }
        return view('resto.resto-search')->with("restos", $restos)->with("ratings", $ratings);
    }
}
