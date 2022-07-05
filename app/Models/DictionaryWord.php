<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DictionaryWord extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'word_id',
        'dictionary_id',
    ];

    public $timestamps = false;

}
