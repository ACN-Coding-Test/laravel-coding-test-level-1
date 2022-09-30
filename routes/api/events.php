<?php

use App\Http\Controllers\Api\EventController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/events')->group(function(){
    Route::get('/',[EventController::class,'index']);
    Route::post('/',[EventController::class,'store']);
    Route::get('/active-events',[EventController::class,'activeEvents']);
    Route::get('/{id}',[EventController::class,'show']);
    Route::patch('/{id}',[EventController::class,'update']);
    Route::delete('/{id}',[EventController::class,'destroy']);
});

Route::prefix('v2/events')->group(function(){
    //Here
});