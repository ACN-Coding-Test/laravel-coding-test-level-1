<?php

namespace App\Models;

use App\Http\Services\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'slug',
        'startAt',
        'endAt',
    ];

    public $incrementing = false;
}
