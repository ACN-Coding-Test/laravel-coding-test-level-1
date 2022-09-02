<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Auth;
use App\Notifications\EventCreated;

class Event extends Model
{
    use HasFactory, SoftDeletes;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    protected $fillable = [
        'title','slug'
    ];
    
    protected $casts = [
      'id' => 'string'
    ];
    
    protected $hidden = [
        'deleted_at'
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function ($event) {
            $event->id = (string) Str::uuid();
            if(empty($event->slug)){
                $event->slug = Str::slug($event->name);
            }
        });

        self::created(function($event){
            $user = Auth::user();
            if(empty($user->id)){
                $user = User::find(1);
            }
            $user->notify(new EventCreated($event));
        });

    }
}
