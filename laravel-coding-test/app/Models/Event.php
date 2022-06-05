<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = FALSE;

    protected $table = 'event';

    protected $casts = [
        'id' => 'string'
    ];
    
    protected $fillable = [
        'id',
        'name',
        'slug',
        'createdAt',
        'updatedAt',
        'startAt',
        'endAt',
    ];
}
