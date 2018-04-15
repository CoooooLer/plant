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
/*页面相关*/

Route::any('/','UserController@home')->name('home');
Route::any('/yanghu','UserController@yanghu')->name('yanghu');
Route::any('/yanghupage','UserController@yanghupage')->name('yanghupage');
Route::any('/jianjie','UserController@jianjie')->name('jianjie');
Route::any('jianjiepage','UserController@jianjiepage')->name('jianjiepage');
Route::any('rizhi','UserController@rizhi')->name('rizhi');
Route::any('rizhipage','UserController@rizhipage')->name('rizhipage');
Route::any('mengtu','UserController@mengtu')->name('mengtu');
//Route::view('mengtu','user.mengtu')->name('mengtu');
Route::any('single','UserController@single')->name('single');
/*用户相关*/
Route::view('/reg','user.register');
Route::view('/log','user.login')->name('log');
Route::post('/register','UserController@register')->name('register');
Route::post('/login','UserController@login')->name('login');
Route::any('/logOut','UserController@logOut')->name('logOut');

Route::any('/editPerson','UserController@editPerson')->name('editPerson');
Route::any('/editPersonInfo','UserController@editPersonInfo')->name('editPersonInfo');

Route::any('/personal','UserController@personal')->name('personal');
Route::any('/dropPost','UserController@dropPost')->name('dropPost');

/*搜索*/
Route::any('/homeSearch','UserController@homeSearch')->name('homeSearch');


/*管理员操作*/
Route::any('/userList','AdminController@userList')->name('userList');
Route::any('/deleteUser','AdminController@deleteUser')->name('deleteUser');
Route::any('/userEdit','AdminController@userEdit')->name('userEdit');
Route::any('/editUserInfo','AdminController@editUserInfo')->name('editUserInfo');
Route::any('/createUser','AdminController@createUser')->name('createUser');

/*页面测试*/




