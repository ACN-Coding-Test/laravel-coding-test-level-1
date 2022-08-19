<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
        'id',
        'name',
        'slug',
        'start_at',
        'end_at',
        'soft_delete',
        'updated_at',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
