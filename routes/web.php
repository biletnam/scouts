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

// Den 18
Route::group(['prefix' => 'den18'], function() {
	Route::get('/', 'PageController@den18')->name('den18.index');
	Route::get('geschiedenis', 'PageController@geschiedenis')->name('den18.geschiedenis');
	Route::get('uniform', 'PageController@uniform')->name('den18.uniform');
	Route::get('drank-en-drugs', 'PageController@drankdrugs')->name('den18.drankendrugs');
});

Route::get('schakeltje', 'SchakeltjeController@index')->name('schakeltje.index');
Route::get('nieuws', 'ArticleController@index')->name('nieuws.index');
Route::get('contact', 'PageController@contact')->name('contact');

Route::group(['middleware' => 'auth', 'prefix' => 'leiding'], function() {
	Route::resource('schakeltje', 'SchakeltjeController', ['only' => ['store', 'destroy']]);
	Route::get('schakeltje/archief', 'SchakeltjeController@archive')->name('schakeltje.archive');
	Route::delete('schakeltje/archief', 'SchakeltjeController@doArchive')->name('schakeltje.do-archive');
	Route::get('/', 'PageController@dashboard');
	Route::get('/dashboard', 'PageController@dashboard');
	Route::get('/nuttig', 'PageController@nuttig')->name('nuttig');


	// Members
	Route::get('/ledenlijst/excelify', 'MemberController@excelify')->name('ledenlijst.excelify');
	Route::get('/ledenlijst/get-ajax', 'MemberController@getAjax');
	Route::get('/ledenlijst/{member}', 'MemberController@show')->name('ledenlijst.show');

	Route::group(['middleware' => 'has-permission:administratie'], function () {
		Route::resource('ledenlijst', 'MemberController', ['except' => ['index', 'create', 'show'], 'parameters' => ['ledenlijst' => 'member']]);
		Route::get('/ledenlijst/overgang', 'MemberController@doOvergang')->name('ledenlijst.overgang');
		Route::get('/ledenlijst/undo-overgang', 'MemberController@undoOvergang')->name('ledenlijst.undo-overgang');

		Route::get('/ledenlijst/{tak?}/create', 'MemberController@create')->name('ledenlijst.create');
		Route::post('/ledenlijst/toggle-paid/{id}', 'MemberController@togglePaid');

		// Member contacts
		Route::resource('contact', 'ContactController', ['except' => ['index', 'show', 'create']]);
		Route::get('/contact/{member}/create', 'ContactController@create')->name('contact.create');
		Route::get('/contacts/get-for-member-ajax/{member_id}', 'ContactController@getContactsByMemberId');

		// Waitinglist
		Route::get('/wachtlijst/overgang', 'WaitinglistController@doOvergang')->name('wachtlijst.overgang');
		Route::get('/wachtlijst/undo-overgang', 'WaitinglistController@undoOvergang')->name('wachtlijst.undo-overgang');
		Route::get('/wachtlijst/excelify', 'WaitinglistController@excelify')->name('wachtlijst.excelify');
		Route::resource('wachtlijst', 'WaitinglistController', ['except' => ['create'], 'parameters' => ['wachtlijst' => 'waitinglist']]);
		Route::get('/wachtlijst/{tak?}/create', 'WaitinglistController@create')->name('wachtlijst.create');
		Route::post('/wachtlijst/register', 'WaitinglistController@register')->name('wachtlijst.register');
	});

	Route::get('/ledenlijst', 'MemberController@index')->name('ledenlijst.index');
	Route::match(['get', 'post'], '/ledenlijst/{tak?}/print', 'MemberController@print')->name('ledenlijst.print');

	Route::group(['middleware' => 'has-permission:account-management'], function () {
		// Users
		Route::post('/gebruikers/add-role', 'UserController@addRole')->name('gebruikers.add-role');
		Route::delete('/gebruikers/drop-role', 'UserController@dropRole')->name('gebruikers.drop-role');
		Route::resource('gebruikers', 'UserController', ['except' => 'create', 'parameters' => ['gebruiker' => 'user']]);
		Route::get('/gebruikers/{type?}/create', 'UserController@create')->name('gebruikers.create');
	});
	Route::get('instellingen', 'UserController@settings')->name('users.settings');
	Route::post('instellingen', 'UserController@storeSettings')->name('users.save-settings');

	// Mailings
	Route::get('mailinglijst/{list}/new', 'MailinglistController@newCampaign')->name('mailinglijst.new-campaign-for-list');
	Route::post('mailinglijst/{list}/add-subscriber', 'MailinglistController@addSubscriber')->name('mailinglijst.add-subscriber');
	Route::delete('mailinglijst/{list}/remove-subscriber', 'MailinglistController@removeSubscriber')->name('mailinglijst.remove-subscriber');
	Route::get('mailinglijst/new', 'MailinglistController@newCampaign')->name('mailinglijst.new-campaign');
	Route::post('mailinglijst/send', 'MailinglistController@sendCampaign')->name('mailinglijst.send-campaign');

	// Mailinglists
	Route::get('mailinglijst', 'MailinglistController@index')->name('mailinglijst.index');
	Route::get('mailinglijst/{id}', 'MailinglistController@show')->name('mailinglijst.show');

	Route::resource('nieuws', 'ArticleController', ['except' => 'índex', 'parameters' => ['nieuws' => 'article']]);

});

Route::group(['prefix' => 'api','middleware' => ['auth']], function () {
	Route::post('/mailinglists/test', 'MailinglistController@testCampaign');
});