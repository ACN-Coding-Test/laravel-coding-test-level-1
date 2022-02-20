<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $table = "events";

    protected $fillable = ['name', 'slug', 'start_at', 'end_at', 'updated_at'];
}
