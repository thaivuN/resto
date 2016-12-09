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

        return response()->json();
    }
}
