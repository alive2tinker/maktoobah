<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register', [
            'countries' => Country::all()
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'city_id' => ['required'],
            'gender' => ['required'],
            'nationality' => ['required'],
            'dob' => ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'tribal' => ['required'],
            'skin_color' => ['required'],
            'hair_color' => ['required'],
            'hair_type' => ['required'],
            'eye_color' => ['required'],
            'marital_status' => ['required'],
            'job' => ['required'],
            'education' => ['required'],
            'smoker' => ['required'],
            'details' => ['required'],
            'polygamy_friendly' => ['required'],
            'misyar_friendly' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'city_id' => $data['city_id'],
            'gender' => $data['gender'],
            'nationality' => $data['nationality'],
            'dob' => $data['dob'],
            'height' => $data['height'],
            'weight' => $data['weight'],
            'skin_color' => $data['skin_color'],
            'tribal' => $data['tribal'],
            'skin_color' => $data['skin_color'],
            'hair_color' => $data['hair_color'],
            'hair_type' => $data['hair_type'],
            'eye_color' => $data['eye_color'],
            'marital_status' => $data['marital_status'],
            'job' => $data['job'],
            'education' => $data['education'],
            'smoker' => $data['smoker'],
            'details' => $data['details'],
            'polygamy_friendly' => $data['polygamy_friendly'],
            'misyar_friendly' => $data['misyar_friendly'],
            'age' => Carbon::parse($data['dob'])->age
        ]);
    }
}
