<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;
}
