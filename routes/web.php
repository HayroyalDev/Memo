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

Route::get('/','UserController@SignIn');
Route::get('SignOut','UserController@SignOut')->name('logout');
Route::post('/','UserController@AuthenticateUser');
Route::get('dashboard','UserController@Dashboard')->name('user.dashboard');
Route::get('dashboard/messages','UserController@Message');
Route::get('dashboard/messages/new','UserController@NewMessage')->name('message.new');
Route::post('dashboard/messages/new','UserController@SendMessage');
Route::get('dashboard/messages/{rc_id}','UserController@ShowMessage');
Route::post('dashboard/messages/{rc_id}','UserController@SendMessage');
Route::get('admin', 'AdminController@DashBoard')->name('dashboard');
Route::get('admin/dashboard', 'AdminController@DashBoard')->name('dashboard');
Route::any('admin/memo/add', 'AdminController@addMemo')->name('memo.add');
Route::any('admin/memo/view', 'AdminController@viewMemo')->name('memo.view');
Route::any('admin/memo/delete/{id}', 'AdminController@deleteMemo')->name('memo.delete');
Route::post('admin/dashboard', 'AdminController@DashBoardPost')->name('dashboard.post');
Route::get('admin/users','AdminController@Users')->name('admin.user.all');
Route::get('admin/users/{type}','AdminController@userAction')->name('admin.user.action');
Route::post('admin/users/{type}','AdminController@usersPost')->name('admin.user.post.action');
Route::post('admin/users','AdminController@UsersPost')->name('admin.user.post');
Route::get('admin/dashboard/downloads/{did}', 'AdminController@Downloads');
Route::get('messages/downloads/{mid}','UserController@Downloads');
Route::get('user/memo/read','UserController@readReceipt')->name('memo.read');
