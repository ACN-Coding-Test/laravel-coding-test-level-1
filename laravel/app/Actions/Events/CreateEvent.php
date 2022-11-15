<?php

namespace App\Actions\Events;

use App\Models\Event;
use Laraditz\Action\Action;

class CreateEvent extends Action
{
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required',
        ];
    }

    public function handle()
    {
        return Event::create(
            [
                'name' => $this->name,
                'slug' => $this->slug,
            ]
        );
    }
}
