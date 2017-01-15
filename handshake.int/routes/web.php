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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/coming-soon', function () {
    return view('coming_soon');
});

Route::get('/gestures', 'Auth\RegisterController@gestures');//->middleware('auth');//middleware toevoegen
Route::post('/saveGestures', 'GestureController@registerGestures')->middleware('auth');
