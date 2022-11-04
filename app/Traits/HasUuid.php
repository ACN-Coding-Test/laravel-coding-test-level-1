<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->id = empty($item->id) ? static::generateUuid() : $item->id;
        });
    }

    public static function generateUuid()
    {
        // Create new uuid
        do {
            $id = Str::uuid()->toString();
        } while (static::where('id', $id)->count() > 0);
        return $id;
    }
}
