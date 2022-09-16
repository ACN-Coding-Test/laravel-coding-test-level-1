<?php

// namespace App\Traits;

// use Illuminate\Support\Str;

// trait Uuid
// {
//     protected static function boot()
//     {
//         parent::_boot_();

//         static::_creating_(function ($model) {
//             try {
//                 $model->id = (string) Str::_uuid_(); // generate uuid
//             } catch (UnsatisfiedDependencyException $e) {
//                 abort(500, $e->getMessage());
//             }
//         });
//     }
// }


namespace App\Traits;

use Illuminate\Support\Str;

trait UUID
{
    protected static function boot()
    {
        // Boot other traits on the Model
        parent::boot();

        /**
         * Listen for the creating event on the user model.
         * Sets the 'id' to a UUID using Str::uuid() on the instance being created
         */
        static::creating(function ($model) {
            if ($model->getKey() === null) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });
    }

    // Tells the database not to auto-increment this field
    public function getIncrementing ()
    {
        return false;
    }

    // Helps the application specify the field type in the database
    public function getKeyType ()
    {
        return 'string';
    }
}