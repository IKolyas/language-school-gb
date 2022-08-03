<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'training_days',
        'training_days_strike',
        'max_training_days_strike',
        'created_at',
        'updated_at'
    ];
}
