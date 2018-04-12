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
/*电影相关*/
Route::get('/', 'HomeController@home')->name('home');
Route::get('/movieInfo','HomeController@movieInfo');
Route::get('/cinemas','HomeController@cinemas')->name('cinemas');
Route::get('/cinema','HomeController@cinema')->name('cinema');
Route::get('/showScreen','HomeController@showScreen')->name('showScreen');
Route::get('/selectSeat','HomeController@selectSeat')->name('selectSeat');
Route::any('/ticket','HomeController@ticket')->name('ticket');
//Route::view('/selectSeat','user.selectSeat')->name('selectSeat');

/*用户相关*/
Route::view('/reg','user.register');
Route::view('/log','user.login')->name('log');
Route::post('/register','UserController@register')->name('register');
Route::post('/login','UserController@login')->name('login');
Route::any('/logOut','UserController@logOut')->name('logOut');

Route::any('/editPerson','UserController@editPerson')->name('editPerson');
Route::any('/editPersonInfo','UserController@editPersonInfo')->name('editPersonInfo');

Route::any('/personal','UserController@personal')->name('personal');
Route::any('/dropTicket','UserController@dropTicket')->name('dropTicket');


Route::any('/userList','AdminController@userList')->name('userList');
Route::any('/deleteUser','AdminController@deleteUser')->name('deleteUser');

/*管理员操作*/
Route::any('/userEdit','AdminController@userEdit')->name('userEdit');
Route::any('/editUserInfo','AdminController@editUserInfo')->name('editUserInfo');
Route::any('/createUser','AdminController@createUser')->name('createUser');

/*页面测试*/
Route::view('/create','admin.userCreate')->name('create');
Route::view('/list','admin.userList')->name('list');
Route::view('/userTicket','admin.userTicket');
//Route::view('/personal','user.personal');



Route::get('/movie',function (){
    return view('user.movie');
})->name('movie');
//Route::get('/cinema',function(){
//    return view('user.cinema');
//})->name('cinema');

Route::get('/filmInfo',function (){
    return view('user.filmInfo');
})->name('filmInfo');
