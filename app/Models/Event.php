<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Http\Traits\EventTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Event extends Model
{
    use EventTrait;
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $fillable = [
        'id', 'name', 'slug', 'startAt', 'endAt','updatedAt', 'createdAt'
    ];
}
