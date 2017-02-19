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

Route::get('/', 'PageController@home')->name('home');
Route::get('home', 'PageController@home')->name('home');
Route::get('inschrijven', 'PageController@inschrijven')->name('inschrijven');
Route::group(['prefix' => 'den18'], function() {
	Route::get('/', 'PageController@den18')->name('den18.index');
	Route::get('geschiedenis', 'PageController@geschiedenis')->name('den18.geschiedenis');
	Route::get('uniform', 'PageController@uniform')->name('den18.uniform');
});
Route::get('schakeltje', 'SchakelController@index')->name('schakeltje.index');
Route::get('nieuws', 'ArticleController@index')->name('nieuws.index');
Route::get('contact', 'PageController@contact')->name('contact');

Route::group(['middleware' => 'auth', 'prefix' => 'leiding'], function() {
	Route::get('dashboard', 'PagesController@dashboard');
	Route::get('nuttig', 'PageController@nuttig')->name('nuttig');
	
	Route::resource('ledenlijst', 'MemberController');
	Route::resource('wachtlijst', 'WaitinglistController');
	Route::resource('gebruikers', 'UserController');
	Route::resource('nieuws', 'ArticleController', ['except' => ['índex']]);
	Route::resource('schakeltje', 'SchakelController', ['only' => ['store', 'destroy']]);
});