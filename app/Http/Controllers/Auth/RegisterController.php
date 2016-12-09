<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\GeoRepository;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/geo';

    /**
     *  Repository used to find a latitude and longitude from a postal code
     * @var GeoRepository 
     */
    protected $georepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeoRepository $georepo) {
        $this->middleware('guest');
        $this->georepo = $georepo;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        $data['latitude'] = null;
        $data['longitude'] = null;
        if (!empty($data['postal_code'])) {
            $pairs = $this->georepo
                    ->GetGeocodingSearchResults($data['postal_code']);
            $data['latitude'] = $pairs['latitude'];
            $data['longitude'] = $pairs['longitude'];
            
        }
        return Validator::make($data, [
                    'name' => 'required|max:255|unique:users',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'postal_code' => 'required|max:255',
                    'latitude' => 'required|numeric',
                    'longitude' => 'required|numeric'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'postal_code' => $data['postal_code']
        ]);
    }

}
