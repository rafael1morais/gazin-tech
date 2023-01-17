<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('levels', 'ApiLevelController@getAllLevels')->name('get.levels');
Route::get('levels/{id}', 'ApiLevelController@getLevel')->name('get.level');
Route::post('levels/cadastra', 'ApiLevelController@createLevel')->name('post.level');
Route::put('levels/', 'ApiLevelController@updateLevel')->name('put.level');
Route::delete('levels/{id}','ApiLevelController@deleteLevel')->name('delete.level');

Route::get('developers', 'ApiDeveloperController@getAllDevelopers')->name('get.developers');
Route::get('developers/{id}', 'ApiDeveloperController@getDeveloper')->name('get.developer');
Route::post('developers', 'ApiDeveloperController@createDeveloper')->name('post.developer');
Route::put('developers/', 'ApiDeveloperController@updateDeveloper')->name('put.developer');
Route::delete('developers/{id}','ApiDeveloperController@deleteDeveloper')->name('delete.developer');
