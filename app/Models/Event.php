<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
}
