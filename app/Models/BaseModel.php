<?php

namespace App\Models;

use App\Helper\ApiResponse;
use App\Helper\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;

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
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereUpdatedAt($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\EventModelFactory factory(...$parameters)
 * @method static \Illuminate\Database\Query\Builder|EventModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventModel whereStartAt($value)
 * @method static \Illuminate\Database\Query\Builder|EventModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|EventModel withoutTrashed()
 */
abstract class BaseModel extends Model{
    use HasFactory;
    use SoftDeletes;

    public static $restfulController = null;

    public static function setRestfulRouting(){
        //    GET /api/v1/events -> Return all events from the database
        //GET /api/v1/events/{id} -> Get one even
        Route::get('/{id?}', [static::$restfulController, 'get']);
        //POST /api/v1/events -> Create an event
        Route::post('/', [static::$restfulController, 'handleRestful']);
        //PUT /api/v1/events/{id} -> Create event if not exist, else update the event in idempotent way
        Route::put('/{id}', [static::$restfulController, 'handleRestful']);
        //PATCH /api/v1/events/{id} -> Partially update event
        Route::patch('/{id}', [static::$restfulController, 'handleRestful']);
        //DELETE /api/v1/events/{id} -> Soft delete an event
        Route::delete('/{id}', [static::$restfulController, 'handleRestful']);

    }

    public static function handleBasicGet($id,$extraWhere = null){


            $response = new ApiResponse();


            $builder = EventModel::query();

            if($id){
                $builder = $builder->where('id', $id);
            }

            if($extraWhere){
                $extraWhere($builder);
            }


            $builder->orderBy("id");
            $response->isSuccess    = true;
            $response->message      = "Fetched successfully";
            $response->data->results = $builder->paginate();;

            //# used when not api
            $response->controllerResponse = view();


            //# to check is api or normal, if normal will return controller respose
            return ($response);


    }

    public static function handleBasicRestFull($id, $nonDeleteValidationCallback = null){

        //# restful by model base, more model no need to do 1 by 1 or worst copy paste, simple CRUD task

        $request = request();
        $method  = $request->getMethod();


        //# validations
        if($nonDeleteValidationCallback && $method != "DELETE"){

            $nonDeleteValidationCallback();
        }

        $result = null;
        switch($method){
            case "POST":

                $result = static::create($request->all());
                break;
            case "PUT":
                $result = static::findOrNew($id);
                $result->update($request->all());
                break;
            case "PATCH":
                $result = static::findOrFail($id);
                $result->update($request->all());
                break;
            case "DELETE":
                $result = static::findOrFail($id)->delete();
                break;
        }

        $response               = new ApiResponse();
        $response->isSuccess    = true;
        $response->message      = "Success $method";
        $response->data->result = $result;
        return ($response);
    }

}
