<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Event extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    protected $table = 'event';
    protected $primaryKey = "id";
    // protected $fillable = ['name', 'slug'];
    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'startAt' => 'datetime',
        'endAt' => 'datetime'
    ];
}
