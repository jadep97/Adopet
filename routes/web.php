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
    return view('pages.home');
});

Route::get('/adoption', function () {
    return view('pages.adoption');
});

// Route::get('/pet/list', function () {
// 	$pets = DB::table('pets')->get();
//
//     return view('pages.petlist', ['pets' => $pets]);
// });

Route::get('/pet/postPet/{id}', 'PetController@postPet');
Route::get('/pet/getPostedPets', 'PetController@getPostedPets');

Route::resource('pet', 'PetController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'loginController@index');
Auth::routes();

Route::get('activate/{token}', 'Auth\RegisterController@activate')->name('activate');
