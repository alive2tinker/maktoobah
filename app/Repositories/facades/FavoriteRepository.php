<?php


namespace App\Repositories\facades;


use App\Http\Resources\FavoriteResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FavoriteRepository
{
    const CACHE_KEY = "favorites";

    public function getCacheKey($key)
    {
        str_replace(" ", "_", $key);

        return self::CACHE_KEY . "." . $key;
    }

    public function all()
    {
        $key = $this->getCacheKey('favorites.' . Auth::user()->id);

        return cache()->remember($key, Carbon::now()->addDay(), function(){
            return FavoriteResource::collection(Auth::user()->favorites()->orderBy('created_at')->paginate(10));
        });
    }
}
