<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory, UsesUuid, Sluggable, SoftDeletes;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $fillable = [
        'name',
        'slug',
        'startAt',
        'endAt'
       ];
       
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function storeEvent($request)
    {
        $slug = SlugService::createSlug(Event::class, 'slug', $request->name);
        $event = [
                    'name' => $request->name,
                    'slug' => $slug,
                    'startAt' => Carbon::parse($request->startAt),
                    'endAt' => Carbon::parse($request->startAt),
                ];
        return Event::create($event);
    }

    public static function updateEvent($event, $request)
    {
        $events = [
            'name' => $request->name,
            'startAt' => Carbon::parse($request->startAt),
            'endAt' => Carbon::parse($request->startAt),
        ];
        return $event->update($events);
    }
}
