<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'tasks',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function createdDictionaries()
    {
        return $this->hasMany(Dictionary::class, 'creator_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class)->using(GroupUser::class);
    }

    public function dictionaries()
    {
        return $this->belongsToMany(Dictionary::class)->using(DictionaryUser::class);
    }

    public function wordsRatings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }

    public function statistics()
    {
        return $this->hasOne(Statistics::class);
    }
}
