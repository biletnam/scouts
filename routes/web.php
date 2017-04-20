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
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/', 'PageController@home')->name('home');
Route::get('home', 'PageController@home')->name('home');
Route::get('inschrijven', 'PageController@inschrijven')->name('inschrijven');
Route::group(['prefix' => 'den18'], function() {
	Route::get('/', 'PageController@den18')->name('den18.index');
	Route::get('geschiedenis', 'PageController@geschiedenis')->name('den18.geschiedenis');
	Route::get('uniform', 'PageController@uniform')->name('den18.uniform');
});
Route::get('schakeltje', 'SchakeltjeController@index')->name('schakeltje.index');
Route::get('nieuws', 'ArticleController@index')->name('nieuws.index');
Route::get('contact', 'PageController@contact')->name('contact');

Route::group(['middleware' => 'auth', 'prefix' => 'leiding'], function() {
	Route::resource('schakeltje', 'SchakeltjeController', ['only' => ['store', 'destroy']]);
	Route::get('/', 'PageController@dashboard');
	Route::get('/dashboard', 'PageController@dashboard');
	Route::get('/nuttig', 'PageController@nuttig')->name('nuttig');

    Route::get('/ledenlijst/excelify', 'MemberController@excelify')->name('ledenlijst.excelify');
    Route::resource('ledenlijst', 'MemberController', ['except' => 'create', 'parameters' => ['ledenlijst' => 'member']]);
    Route::get('/ledenlijst/{tak?}/create', 'MemberController@create')->name('ledenlijst.create');
    Route::post('/ledenlijst/toggle-paid/{id}', 'MemberController@togglePaid');

    Route::get('/wachtlijst/excelify', 'WaitinglistController@excelify')->name('wachtlijst.excelify');
    Route::resource('wachtlijst', 'WaitinglistController');
    Route::get('/wachtlijst/{tak?}/create', 'WaitinglistController@create')->name('wachtlijst.create');
    Route::post('/wachtlijst/register', 'WaitinglistController@register')->name('wachtlijst.register');

    Route::resource('gebruikers', 'UserController');
	Route::resource('nieuws', 'ArticleController', ['except' => 'índex', 'parameters' => ['nieuws' => 'article']]);
});
