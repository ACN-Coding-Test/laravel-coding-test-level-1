<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/view', [ViewController::class, 'view']);
Route::get('/edit', [ViewController::class, 'edit']);
Route::get('/editdata', [ViewController::class, 'editdata']);
Route::post('/delete', [ViewController::class, 'delete']);
Route::get('/validatorfail', function () {
   print('something wrong with the input');
});
