<?php

use Illuminate\Support\Facades\Route;

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



Route::post('/upload-file', [\App\Http\Controllers\Controller::class,'upload'])->name('upload-file');

Route::get('/home', [\App\Http\Controllers\Controller::class,'home'])->name('home');
Route::post('/perform-cal', [\App\Http\Controllers\Controller::class,'perfromCal'])->name('perform-cal');
Route::get('/cal', [\App\Http\Controllers\Controller::class,'cal'])->name('cal');
