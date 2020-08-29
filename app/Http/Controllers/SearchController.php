<?php

namespace App\Http\Controllers;

use App\Country;
use App\Repositories\facades\UserRepository;
use Illuminate\Http\Request;
use App\User;
class SearchController extends Controller
{
    public function __invoke(Request $request){

        $users = UserRepository::search($request->input('keywords'));

        return view('home', [
            'users' => $users,
        ]);
    }
}
