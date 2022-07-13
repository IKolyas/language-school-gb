<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'word_id',
        'user_id',
        'dictionary_id',
        'rating'
    ];

    public $timestamps = false;
}
