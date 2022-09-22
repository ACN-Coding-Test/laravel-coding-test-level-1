<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasUuid;

class Event extends Model
{

    protected $table = 'events';

    protected $fillable = ['name','slug'];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = true;

    use SoftDeletes;
    use HasUuid;

}
