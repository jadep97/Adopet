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
// Route::get('/pet/list', function () {
// 	$pets = DB::table('pets')->get();
//
//     return view('pages.petlist', ['pets' => $pets]);
// });

Route::get('/pet/postPet/{id}', 'PetController@postPet')->name('postpet');
Route::get('/pet/getPostedPets', 'PetController@getPostedPets');

Route::get('/pet/requestPet/{id}', 'PetController@requestPet');
Route::get('/pet/getUserRequests', 'PetController@getUserRequest');

Route::get('/pet/likePet/{id}', 'PetController@likePet');
Route::get('/pet/getLikedPets', 'PetController@getLikedPets');

Route::get('/pet/commentPet/{id}', 'PetController@commentPet');
Route::get('/pet/getCommentPets/{id}', 'PetController@getCommentPets');


Route::get('/pet/getProfilePets', 'PetController@getProfilePets');

Route::resource('pet', 'PetController');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');

Route::get('/login', 'loginController@index');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::resource('pet', 'PetController');
});
Route::middleware(['auth'])->group(function(){

    Route::get('/search', 'SearchController@index');
    Route::get('/searchpet',['uses' => 'SearchController@searchPet','as' => 'searchpet']);
    Route::get('/search/searchpets', 'SearchController@SearchPets')->name('searchpets');
    Route::get('/search/searchpets', 'SearchController@SearchPets')->name('searchpets');
    Route::resource('search', 'SearchController');
    Route::get('/search/getSearchCommentPet/{id}', 'SearchController@getSearchCommentPet')->name('getSearchCommentPet');
});


Route::get('activate/{token}', 'Auth\RegisterController@activate')->name('activate');
// ss
// Route::get('/search','SearchController@index');
// Route::get('/searchPet',[
//     'as' => 'search.searchPet',
//     'uses' => 'SearchController@searchPet'
// ]);


// Route::middleware(['auth'])->group(function(){

    
//     // Route::get('/post/{id}', 'CommentController@show');
//     Route::resource('comment', 'CommentController');
//     Route::get('comment', 'CommentController@index');
//     //Route::get('/comment/create', 'CommentController@create');
//     // Route::post('/comment/make', 'CommentController@store')->name('comment.store');

// });

Route::get('activate/{token}', 'Auth\RegisterController@activate')->name('activate');
//Route::get('/search','SearchController@index');
//Route::get('/searchpets','SearchController@searchPets');

Route::get('/login/facebook', 'Auth\LoginController@redirectToFacebookProvider')->name('facebook');

Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderFacebookCallback');

Route::group(['middleware' => [
    'auth'
]], function(){
    Route::get('/user', 'GraphController@retrieveUserProfile')->name('fblog');
    Route::get('/user/view', 'GraphController@viewLog')->name('viewfblog');


    Route::get('/user/recommend', 'RecommendPet@recommend')->name('recommend');
});

