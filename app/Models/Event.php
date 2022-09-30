<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\Sluggable;

class Event extends Model
{
    Use HasFactory, HasUuids, SoftDeletes, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'startAt',
        'endAt'
    ];

    public $incrementing = false;

    protected $keyType = 'uuid';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function scopeFilter($query, $params = []) {
        if(isset($params['order_by']) && $params['order_by'] != '') {
            $dir = isset($params['order_dir']) && $params['order_dir'] != '' ? $params['order_dir'] : 'asc';
            $query->orderBy($params['order_by'], $dir);
        }else {
            $query->orderBy('createdAt', 'desc');
        }

        if(isset($params['columns']) && $params['columns'] != '') {
            $query->select(DB::RAW($params['columns']));
        }

        return $query;
    }
}
