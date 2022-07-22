<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\Uuids;

class Event extends Model
{
    use Notifiable, Uuids, HasFactory;
    protected $guarded = [];
}
