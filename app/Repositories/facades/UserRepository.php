<?php


namespace App\Repositories\facades;


use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    const CACHE_KEY = "USERS";

    public function latest()
    {
        $key = $this->getCacheKey('latest');

        return cache()->remember($key, Carbon::now()->addDay(), function(){
            return User::orderby('updated_at','desc')->take(10)->get();
        });
    }

    public function potentialMates()
    {
        $key = $this->getCacheKey('potential_mates.'. Auth::user()->id);

        return cache()->remember($key, Carbon::now()->addMinutes(5), function(){
            return User::where([
                ['gender', '!=', Auth::user()->gender],
                ['id', '!=', Auth::user()->id]
            ])->orderby('updated_at','desc')->paginate(10);
        });
    }

    public function search($keywords)
    {
        $key = $this->getCacheKey($keywords);

        return cache()->remember($key, Carbon::now()->addDay(), function() use($keywords){
            return User::where('search_index', 'LIKE', '%' . $keywords . '%')->orderby('updated_at','desc')->paginate(10);
        });
    }

    public function getCacheKey($key)
    {
        str_replace(" ", "_", $key);

        return self::CACHE_KEY . "." . $key;
    }
}
