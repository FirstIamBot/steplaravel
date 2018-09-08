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
    return view('welcome');
});
Route::get('/library', 'Library\BooksController@index')->name('library');
Route::get('autor', 'Library\AutorController@index')->name('autor');
Route::get('autor/{nameAutor}', 'Library\AutorController@showAutorBooks');
Route::get('autor/{nameAutor}/{nameBook}', 'Library\AutorController@showAutorBook');
//***************************************************
Route::get('/finds', 'Library\FindController@index')->name('finds');
//************  AJAX Route ************************************************
Route::post('findAuto','Library\FindController@fetch');
//*******************************************************
Route::post('findBooks','Library\FindController@findBooks');
Route::post('findBook','Library\FindController@findBook');

//************************************************************
Route::get('genre/{numGenre}', 'Library\BooksController@showBooksGenre')->where('numGenre', '[1-9]?[0-9]');
Route::get('book/{nameBook}', 'Library\BooksController@showBook')->name('book');
Route::get('about', 'Library\BooksController@about');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
