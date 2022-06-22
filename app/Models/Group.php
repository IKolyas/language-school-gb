<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'description',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(GroupUser::class);
    }
}
