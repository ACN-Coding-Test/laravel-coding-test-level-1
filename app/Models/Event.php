<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    // Set which fields are fillable
    protected $fillable =
    [
        'name',
        'slug',
        'startAt',
        'endAt',
        'createdAt',
        'updatedAt'
    ];

    protected $casts = [
        'id' => 'string'
    ];
}
