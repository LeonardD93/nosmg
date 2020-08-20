<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::delete('elimina/{game_id}', function(int $id) {
  $game = \App\Game::findOrFail($id);
  $game->delete();
  return $game->id;
});

Route::group(['middleware'=>'auth:api'], function() {
  Route::get('esempio', function() {
    return \App\Game::all();
  });
  Route::get('users/me', function() {
    return Auth::user();
  });
});
