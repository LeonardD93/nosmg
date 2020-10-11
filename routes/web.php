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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');




Route::post('invitations', 'InvitationsController@store')->name('invitations.store'); // store invitation

Route::get('register/request', 'Auth\RegisterController@requestInvitation')->middleware('guest')->name('requestInvitation'); //request invitation not autentichated
Route::get( 'invitations/create','InvitationsController@create')->middleware('auth')->name('invitations.create'); // invite a new user

Route::post('register', 'Auth\RegisterController@store')->name('storeRegistration'); // create new user

/*
Route::group([
    'middleware' => ['auth'],
    'prefix' => 'invitations',
], function() {
    Route::get('/', 'InvitationsController@index')->name('showInvitations');
});
*/

Route::get('invitations', 'InvitationsController@index')->middleware('auth')->name('invitations');
Route::delete('invitations/{id}','InvitationsController@destroy')->middleware('auth')->name('invitations.destroy');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('hasInvitation');

Route::resource('activities', 'ActivityController');
Route::resource('players', 'PlayerController');


/*
 *
Verb        URI                         Action      RouteName
GET         /activities                 index       activities.index
GET         /activities/create          create      activities.create
POST        /activities                 store       activities.store
GET         /activities/{photo}         show        activities.show
GET         /activities/{photo}/edit    edit        activities.edit
PUT/PATCH   /activities/{photo}         update      activities.update
DELETE      /activities/{photo}         destroy     activities.destroy

Route::get('users/{user}',  ['as' => 'users.edit', 'uses' => 'UserController@edit']);
Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'UserController@update']);
 */
