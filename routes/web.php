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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'loginController@index');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::resource('pet', 'PetController');
});

Route::get('activate/{token}', 'Auth\RegisterController@activate')->name('activate');



