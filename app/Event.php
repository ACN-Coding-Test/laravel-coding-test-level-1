<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid as Generator;

class Event extends Model
{
    use SoftDeletes;
    protected $table = "events";
    protected $fillable = [
        'id',
        'name',
        'slug',
        'startAt',
        'endAt'
    ];
    protected $dates = ['deleted_at'];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->id = Generator::uuid4()->toString();
            } catch (UnsatisfiedDependencyException $e) {
                abort(500, $e->getMessage());
            }
        });
    }

}
