<?php

namespace App\Models;

use App\Models\Traits\UUID;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, SoftDeletes, UUID;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'slug',
        'venue',
        'description',
        'start_at',
        'end_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function scopeIsActive($query)
    {
        $today = Carbon::now();

        $query->where('start_at', '<=', $today->format('Y-m-d'))
            ->where('end_at', '>=', $today->format('Y-m-d'));
    }
}
