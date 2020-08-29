<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Repositories\facades\ChatRepository;
use Illuminate\Http\Request;
use App\Http\Resources\ChatResource;
use App\Http\Requests\StoreChat;
use App\Notifications\NewMessageNotification;
use Illuminate\Support\Facades\Auth;
use App\User;
class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repo = new ChatRepository();
        return view('chats.index', [
            'chats' => $repo->list()
        ]);
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
    public function store(StoreChat $request, User $user)
    {
        $chat = Chat::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $user->id,
        ]);

        $message = $chat->messages()->create([
            'text' => $request->input('message_text'),
            'user_id' => Auth::user()->id
        ]);

        $chat->receiver->notify(new NewMessageNotification($message));

        return redirect()->back()
            ->with('success', trans('strings.sent_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        return view('chats.show', [
            'chat' => $chat
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }

    public function chatResource(Chat $chat)
    {
        return response()->json(new ChatResource($chat));
    }
}
