<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Event extends Model
{
    use SoftDeletes;

    protected $table = 'event';

    protected $fillable = [
        'name',
        'slug',
        'startAt',
        'endAt'
    ];

    
    
    public $timestamps = true;
}
