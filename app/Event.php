<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

	protected $table = 'events';


    protected $fillable = [
        'id', 'name', 'slug', 'createdAt', 'updatedAt'
    ];
    
    public static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->id = (string) Str::uuid();
            $event->slug = Str::slug($event->name);
            $event->createdAt = now();
            $event->updatedAt = now();
        });
    }
}
