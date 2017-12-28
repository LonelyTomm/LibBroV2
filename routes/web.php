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

Route::get('/book/add','IndexController@addBook');
Route::post('/book/add','IndexController@addBookPost');

Route::post('/find','IndexController@find');

Route::get('/borrow/book/{id}','IndexController@borrowBook');
Route::get('/modify/book/{id}','IndexController@modifyBook');
Route::post('/modify/book/{id}','IndexController@modifyBookPost');

Route::get('/return','IndexController@returnBooksTable');
Route::get('/return/{id}','IndexController@returnBook');

Route::get('/BorrowLog','IndexController@showBorrowLog');

Auth::routes();

Route::get('/home/show', 'IndexController@indexFunc')->name('home');
