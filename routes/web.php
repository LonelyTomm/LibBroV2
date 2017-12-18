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

Route::get('/logout', 'IndexController@logOut');
Route::get('/index/{page?}', 'IndexController@indexFunc');

Route::get('/desc/{id}','IndexController@getDescription');
Route::get('/genre/{genre}/{page?}','IndexController@getGenre');

Route::post('/find','IndexController@find');

Auth::routes();

Route::get('/home/show', 'IndexController@indexFunc')->name('home');
