<?php


namespace App\Repositories\facades;


use App\Http\Resources\ChatResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ChatRepository
{
    const CACHE_KEY = "chats";

    public function getCacheKey($key)
    {
        str_replace(" ", "_", $key);

        return self::CACHE_KEY . "." . $key;
    }

    public function list()
    {
        $key = $this->getCacheKey('chats.' . Auth::user()->id);

        return cache()->remember($key, Carbon::now()->addDay(), function(){
            return Auth::user()->chats();
        });
    }
}
