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
Route::get('/pet/getUserRequest/{id}', 'PetController@getUserRequest');

Route::resource('pet', 'PetController');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/login', 'loginController@index');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::resource('pet', 'PetController');
});
Route::middleware(['auth'])->group(function(){
    
    Route::get('/search', 'SearchController@index');
    Route::get('/searchpet',['uses' => 'SearchController@searchPet','as' => 'searchpet']);
    Route::resource('search', 'SearchController');
});

Route::get('activate/{token}', 'Auth\RegisterController@activate')->name('activate');
<<<<<<< HEAD
// ss
// Route::get('/search','SearchController@index');
// Route::get('/searchPet',[
//     'as' => 'search.searchPet',
//     'uses' => 'SearchController@searchPet'
// ]);
=======

Route::get('/search','SearchController@index');
Route::get('/searchpet','SearchController@searchPet');

Route::get('/login/facebook', 'Auth\LoginController@redirectToFacebookProvider')->name('facebook');
 
Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');

Route::group(['middleware' => [
    'auth'
]], function(){
    Route::get('/user', 'GraphController@retrieveUserProfile')->name('fblog');
    Route::get('/user/view', 'GraphController@viewLog')->name('viewfblog');
<<<<<<< Updated upstream
});
>>>>>>> 0e42a3f93553842e69a59366c60cea02c05cfa41
=======
    Route::get('/recommend', 'GraphController@recommend');
});

>>>>>>> Stashed changes
