<?php

namespace App\Http\Controllers;

use App\Country;
use App\Repositories\facades\UserRepository;
use Illuminate\Http\Request;
use App\User;
class SearchController extends Controller
{
    public function __invoke(Request $request){

        $repo = new UserRepository();

        return view('home', [
            'users' => $repo->search($request->input('keywords')),
        ]);
    }
}
