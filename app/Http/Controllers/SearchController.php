<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resto;

class SearchController extends Controller
{
    /**
     * Display search results
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $restos = Resto::join('genres', 'restos.genre_id', '=', 'genres.id')
                ->where('name', 'like', '%'.$search.'%')
                ->orWhere('city', 'like', '%'. $search.'%')
                ->orWhere('genre', 'like', '%'.$search.'%')->paginate(5);
        
        return view('resto.resto-search')->with("restos", $restos);
    }
}
