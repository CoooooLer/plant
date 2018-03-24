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

Route::get('/', 'HomeController@home')->name('home');
Route::get('/movieInfo','HomeController@movieInfo');
Route::get('/cinemas',function (){
    return view('user.cinemas');
})->name('cinemas');
Route::get('/cinema','HomeController@cinema')->name('cinema');

Route::get('/movie',function (){
    return view('user.movie');
})->name('movie');
//Route::get('/cinema',function(){
//    return view('user.cinema');
//})->name('cinema');

Route::get('/filmInfo',function (){
    return view('user.filmInfo');
})->name('filmInfo');
