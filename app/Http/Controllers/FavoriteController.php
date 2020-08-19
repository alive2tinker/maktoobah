<?php

namespace App\Http\Controllers;

use App\Events\FavoriteCreated;
use App\Favorite;
use App\Http\Resources\FavoriteResource;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Notifications\NewFavoriteNotification;
class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('favorites.index');
    }

    public function list()
    {
        return FavoriteResource::collection(Auth::user()->favorites()->orderBy('created_at')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $favorite = Favorite::create([
            'favorable_id' => $request->input('favorable_id'),
            'favorable_type' => "App\User",
            'user_id' => auth()->user()->id
        ]);

        FavoriteCreated::dispatch($favorite);

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $favorite = Favorite::where([
            ['user_id', auth()->user()->id],
            ['favorable_id', $id]
        ])->first();

        $favorite->delete();

        return true;
    }

    public function isFavorited($id)
    {
        $user = User::find($id);
        $result = Favorite::where([['favorable_id', $id], ['user_id', Auth::user()->id]])->first() !== null;
        return response()->json(['result' => $result, 'count' => $user->favorated->count()]);
    }
}
