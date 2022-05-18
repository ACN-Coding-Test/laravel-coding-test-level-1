<?php

namespace App;

use Attribute;
use Illuminate\Database\Eloquent\Model;


class Event extends Model
{ 
    

protected $fillable = [
    'id',
    'name',
    'slug',
    'startAt',
    'endAt',
    'created_at',
    'updated_at'
];

protected $casts = [
    'id' => 'string'
];
}
