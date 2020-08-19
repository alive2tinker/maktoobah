<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'country_id'
    ];

    public function name()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
