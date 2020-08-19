<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'city_id',
        'gender',
        'nationality',
        'dob',
        'height',
        'weight',
        'skin_color',
        'tribal',
        'hair_color',
        'hair_type',
        'eye_color',
        'marital_status',
        'job',
        'education',
        'smoker',
        'details',
        'polygamy_friendly',
        'misyar_friendly',
        'age'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function age()
    {
        return Carbon::parse($this->dob)->age;
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favorated()
    {
        return $this->morphMany(Favorite::class, 'favorable');
    }

    public function favoritedThis($id)
    {
        return $this->favorites->containsStrict('favorable_id', $id);
    }

    public function sentChats()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function receivedChats()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }
    public function chats()
    {
        return $this->sentChats->merge($this->receivedChats);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function sent_chats()
    {
        return $this->hasMany(Chat::class,'sender_id');
    }

    public function received_chats()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
