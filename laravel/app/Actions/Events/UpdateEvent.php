<?php

namespace App\Actions\Events;

use App\Models\Event;
use Illuminate\Http\Request;
use Laraditz\Action\Action;

class UpdateEvent extends Action
{
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required',
        ];
    }

    public function handle(Request $request)
    {
        return Event::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name' => $this->name,
                'slug' => $this->slug
            ]
        );
    }
}
