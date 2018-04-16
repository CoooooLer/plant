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

Route::any('/','UserController@home')->name('home');                               /*主页*/
Route::any('/jianjie','UserController@jianjie')->name('jianjie');                  /*多肉简介页面添加文章*/
Route::any('jianjiepage','UserController@jianjiepage')->name('jianjiepage');       /*多肉简介页面*/
Route::any('/yanghu','UserController@yanghu')->name('yanghu');                     /*种植养护页面添加文章*/
Route::any('/yanghupage','UserController@yanghupage')->name('yanghupage');         /*种植养护页面*/
Route::any('rizhi','UserController@rizhi')->name('rizhi');                         /*种植日志页面添加文章*/
Route::any('rizhipage','UserController@rizhipage')->name('rizhipage');             /*种植日志页面*/
Route::any('mengtu','UserController@mengtu')->name('mengtu');                      /*萌图欣赏页面*/
Route::any('single','UserController@single')->name('single');                      /*详情页面*/
/*用户相关*/
Route::view('/reg','user.register');                                                /*用户注册页面*/
Route::view('/log','user.login')->name('log');                                      /*用户登录页面*/
Route::post('/register','UserController@register')->name('register');               /*用户注册信息*/
Route::post('/login','UserController@login')->name('login');                        /*用户登录*/
Route::any('/logOut','UserController@logOut')->name('logOut');                      /*用户退出*/

Route::any('/editPerson','UserController@editPerson')->name('editPerson');          /*用户编辑资料页面*/
Route::any('/editPersonInfo','UserController@editPersonInfo')->name('editPersonInfo');/*用户保存编辑资料*/

Route::any('/personal','UserController@personal')->name('personal');                /*用户个人中心*/
Route::any('/dropPost','UserController@dropPost')->name('dropPost');                /*用户删除文章*/

/*搜索*/
Route::any('/homeSearch','UserController@homeSearch')->name('homeSearch');          /*搜索文章*/

/*管理员操作*/
Route::any('/userList','AdminController@userList')->name('userList');               /*管理员中心*/
Route::any('/deleteUser','AdminController@deleteUser')->name('deleteUser');         /*管理员删除用户*/
Route::any('/userEdit','AdminController@userEdit')->name('userEdit');               /*管理员编辑用户资料页面*/
Route::any('/editUserInfo','AdminController@editUserInfo')->name('editUserInfo');   /*管理员编辑用户资料保存*/
Route::any('/createUserInfo','AdminController@createUser')->name('createUserInfo'); /*管理员创建用户页面*/
Route::view('/createUser','admin.userCreate')->name('createUser');                  /*管理员保存创建的用户*/

/*页面测试*/




