<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'     => 'required|unique:events,name,'.$this->event->id,
            'startAt'     => 'required|date',
            'endAt'     => 'required|date',
        ];
    }
}
