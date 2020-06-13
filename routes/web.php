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
Auth::routes();
// Languages Route
Route::get('/language', 'LanguageController@getLanguage')->name('get.language');
Route::get('/language/{lang}', 'LanguageController@changeLanguage')->name('change.language');


Route::get('logout', 'ErrorsController@abort404')->name('errors.404');


  
// Social Auth Routes
Route::get('auth/{provider}', 'Auth\\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\\SocialAuthController@handleProviderCallback');

// Home Routes

Route::get('/', function () { return view('index'); });



