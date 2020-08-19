<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $potentialMates = User::where([
            ['gender', '!=', Auth::user()->gender],
            ['id', '!=', Auth::user()->id]
        ])->orderby('updated_at','desc')->paginate(10);
        return view('home', [
            'users' => $potentialMates,
            'countries' => Country::all()
        ]);
    }
}
