<?php

namespace App\Models;

use App\Http\Controllers\EventController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\EventModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $name
 * @property string|null $slug
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereUpdatedAt($value)
 * @property string $startAt
 * @property string $endAt
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\EventModelFactory factory(...$parameters)
 * @method static \Illuminate\Database\Query\Builder|EventModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereStartAt($value)
 * @method static \Illuminate\Database\Query\Builder|EventModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|EventModel withoutTrashed()
 */
class EventModel extends BaseModel
{

    protected $fillable = ['name','slug','startAt','endAt'];

    public static $restfulController = EventController::class;

    protected $table = "event";


}
