<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\crudcontroller;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {
    Route::get('adddummy', [crudcontroller::class, 'adddummy']);
   
    Route::get('events', [crudcontroller::class, 'events']);
    Route::get('events/active-events', [crudcontroller::class, 'active-events']);
    Route::post('events', [crudcontroller::class, 'functionevents']);
    Route::get('events/{id}', [crudcontroller::class, 'functionevents']);
    Route::patch('events/{id}', [crudcontroller::class, 'functionevents']);
    Route::put('events/{id}', [crudcontroller::class, 'functionevents']);
    Route::delete('events/{id}', [crudcontroller::class, 'functionevents']);


 });
