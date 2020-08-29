<?php

namespace App;

use App\Events\UserCreated;
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
        'age',
        'search_index'
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $searchIndex = "name:".$user->name
                .",city:".$user->city->name()
                .",gender:".$user->gender
                .",nationality:".$user->nationality
                .",weight:".$user->weight
                .",height:".$user->height
                .",education:".$user->education
                .",details:".$user->details
                .",polygamy_friendly:".$user->polygamy_friendly
                .",age:".$user->age()
                .",misyar_friendly:".$user->misyar_friendly
                .",smoker:".$user->smoker
                .",skin_color:".$user->skin_color
                .",tribal:".$user->tribal
                .",hair_color:".$user->hair_color
                .",eye_color:".$user->eye_color
                .",marital_status:".$user->marital_status
                .",job:".$user->job
                .",hair_type:".$user->hair_type;
            $user->update([
                'search_index' => $searchIndex
            ]);
        });
    }

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
