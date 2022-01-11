<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuids
{
    /**
     * Override Laravel boot() function so that the model has new UUID when a record is created.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    /**
     * Override Laravel getIncrementing() function to return false, i.e. the identifier does not auto increment.
     *
     * @return bool
     */
    public function getIncrementing() : bool
    {
        return false;
    }

    /**
     * Let Laravel knows that the key type is a string, not an integer.
     *
     * @return string
     */
    public function getKeyType() : string
    {
        return 'string';
    }
}
