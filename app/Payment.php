<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'name',
        'bank',
        'date',
        'details',
        'user_id'
    ];
}
