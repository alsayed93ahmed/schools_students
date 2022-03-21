<?php

use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', function () {
    return redirect('/schools');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('schools/list', [SchoolsController::class, 'list'])->name('schools.list');
    Route::resource('schools', SchoolsController::class);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('students/list', [StudentsController::class, 'list'])->name('students.list');
    Route::resource('students', StudentsController::class);
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
