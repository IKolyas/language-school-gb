<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'translation',
    ];

    protected $guarded = [];

    public function dictionaries()
    {
        return $this->belongsToMany(Dictionary::class)->using(DictionaryWord::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
