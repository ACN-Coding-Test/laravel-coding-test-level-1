<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $keyType = 'string';

    protected $fillable = ['name', 'slug'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string)Str::orderedUuid();
        });
    }
}
