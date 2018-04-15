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
/*相关*/

Route::any('/','UserController@home')->name('home');
Route::any('/yanghu','UserController@yanghu')->name('yanghu');
/*用户相关*/
Route::view('/reg','user.register');
Route::view('/log','user.login')->name('log');
Route::post('/register','UserController@register')->name('register');
Route::post('/login','UserController@login')->name('login');
Route::any('/logOut','UserController@logOut')->name('logOut');

Route::any('/editPerson','UserController@editPerson')->name('editPerson');
Route::any('/editPersonInfo','UserController@editPersonInfo')->name('editPersonInfo');



Route::any('/userList','AdminController@userList')->name('userList');
Route::any('/deleteUser','AdminController@deleteUser')->name('deleteUser');

/*管理员操作*/
Route::any('/userEdit','AdminController@userEdit')->name('userEdit');
Route::any('/editUserInfo','AdminController@editUserInfo')->name('editUserInfo');
Route::any('/createUser','AdminController@createUser')->name('createUser');

/*页面测试*/




