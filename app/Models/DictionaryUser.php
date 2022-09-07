<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DictionaryUser extends Pivot
{
    protected $fillable = [
        'user_id',
        'dictionary_id',
    ];

    public $timestamps = false;
}
