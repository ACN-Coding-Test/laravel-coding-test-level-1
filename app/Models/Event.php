<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['id', 'name', 'slug'];

    protected static function newEvent(){
        return EventFactory::new();
    }

    public function scopeActive($query)
    {
        return $query->where('created_at', '<', Carbon::now())->where('updated_at', '>', Carbon::now());
    }
}
