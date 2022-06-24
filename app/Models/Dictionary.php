<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;

    protected $fillable = [
        'dictionary_name',
        'creator_id',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function words()
    {
        return $this->belongsToMany(Word::class)->using(DictionaryWord::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(DictionaryUser::class);
    }
}
