<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Chat extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function otherEnd()
    {
        return Auth::user()->id === $this->sender->id ? $this->receiver : $this->sender;
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
