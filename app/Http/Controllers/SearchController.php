<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use App\User;
class SearchController extends Controller
{
    public function __invoke(Request $request){
        $matchThese = [];



        foreach($request->all() as $index => $input)
        {
            if($input != null && ($index != "_token"))
                if($index == 'age_from')
                    array_push($matchThese, ['age', '>=', $input]);
                else if($index == 'age_to')
                    array_push($matchThese, ['age', '<=', $input]);
                else
                    array_push($matchThese, [$index, $input]);
        }
        $users = User::where($matchThese)->orderby('updated_at','desc')->paginate(10);

        return view('home', [
            'users' => $users,
            'countries' => Country::all()
        ]);
    }
}
