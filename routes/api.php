<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;


Route::prefix('v1/events')->group(function(){
    Route::get('/',[EventController::class,'index']);
    Route::get('/active-events',[EventController::class,'activeEvents']);
    Route::post('/',[EventController::class,'store']);
    Route::put('/{id}',[EventController::class,'update']);
    Route::patch('/{id}',[EventController::class,'update']);
    Route::delete('/{id}',[EventController::class,'destroy']);
});