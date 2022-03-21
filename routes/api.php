<?php

use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', 'App\Http\Controllers\Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','App\Http\Controllers\Auth\ApiAuthController@register')->name('register.api');
});

Route::group(['middleware' => ['auth:api', 'json.response']], function () {
    Route::post('/logout', 'App\Http\Controllers\Auth\ApiAuthController@logout')->name('logout.api');
});

Route::group(['middleware' => ['auth:api', 'cors', 'json.response']], function () {
    Route::get('schools/list', [SchoolsController::class, 'list']);
    Route::post('schools/store',[SchoolsController::class, 'store']);
    Route::delete('schools/{id}',[SchoolsController::class, 'destroy']);
});

Route::group(['middleware' => ['auth:api', 'cors', 'json.response']], function () {
    Route::get('students/list', [StudentsController::class, 'list']);
    Route::post('students/store',[StudentsController::class, 'store']);
    Route::delete('students/{id}',[StudentsController::class, 'destroy']);
});
