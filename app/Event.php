<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasUuid;

class Event extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    use SoftDeletes;
    use HasUuid;

}
