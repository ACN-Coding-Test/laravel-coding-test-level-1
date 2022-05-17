<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    

protected $fillable = [
    'name',
    'slug',
];

protected $appends = [
    'createdAt',
    'updatedAt'
];


public function getCreatedAtAttribute()
{
    return $this->created_at;
}

public function getUpdatedAtAttribute()
{
    return $this->updated_at;
}

}
