<?php

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

Route::get('/', 'HomeController@index');

Auth::routes(['verify' => true]);

Route::get('/wod/{id}', 'WODController@index');

Route::view('/terms', 'terms');

Route::post('/workout/{id}', 'WorkoutController@create');
Route::delete('/workout/{id}', 'WorkoutController@delete');

Route::post('/vote/{id}', 'VoteController@create');

Route::delete('dashboard', 'Auth\UserController@delete')->middleware('auth');
Route::get('/dashboard', 'Auth\UserController@dashboard')->name('dashboard')->middleware('auth');
Route::put('/dashboard', 'Auth\UserController@updateProfile')->middleware('auth');

Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::get('/admin/users', 'AdminController@listUsers');
    Route::put('/admin/users/{userId}', 'AdminController@updateUser');
    Route::delete('/admin/users/{userId}', 'AdminController@deleteUser');

    Route::get('/admin/workouts', 'AdminController@listWorkouts');
    Route::put('/admin/workouts/{workoutId}', 'AdminController@updateWorkout');
    Route::delete('/admin/workouts/{workoutId}', 'AdminController@deleteWorkout');

    Route::get('/admin/email', 'AdminController@ShowEmailForm');
    Route::post('/admin/email', 'AdminController@SendEmailToUsers');
});