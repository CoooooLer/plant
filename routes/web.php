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
    return view('home');
});

Route::get('/film',function (){
    return view('film');
});
Route::get('/cinema',function(){
    return view('cinema');
});

Route::get('/filmInfo',function (){
    return view('filmInfo');
});
