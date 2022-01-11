<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Event extends Model
{
    use HasFactory;
    use Uuids;
	use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    // Change default 'created_at' to 'createdAt'
    const CREATED_AT = 'createdAt';
    
    // Change default 'updated_at' to 'updatedAt'
    const UPDATED_AT = 'updatedAt';

    protected $fillable = ['name', 'slug'];
    protected $guarded = [];
}
