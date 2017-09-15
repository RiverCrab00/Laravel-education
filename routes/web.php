<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=>'admin','namespace'=>'admin'],function(){
    Route::get('welcome','IndexController@welcome');
    Route::get('index','IndexController@index');
    Route::group(['prefix'=>'lesson','middleware'=>'login'],function(){
        Route::match(['get','post'],'index','LessonController@index');
        Route::post('status/{lesson}','LessonController@status');
        Route::match(['get','post'],'add','LessonController@add');
        Route::match(['get','post'],'update/{lesson}','LessonController@update');
        Route::post('del/{lesson}','LessonController@del');
        Route::post('batchdel','LessonController@batchdel');
        Route::post('upvideo','LessonController@upvideo');
        Route::post('upimg','LessonController@upimg');
        Route::get('play/{lesson}','LessonController@play');
    });
    Route::group(['prefix'=>'manager'],function(){
        Route::get('login','ManagerController@login');
        Route::post('login_check','ManagerController@login_check');
        Route::get('logout','ManagerController@logout');
    });
});
Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
   Route::group(['prefix'=>'student'],function(){
       Route::match(['get','post'],'login','StudentController@login');
       //QQ登录系统弹窗
       Route::get('qqlogin','StudentController@qqlogin');
       //QQ登录系统后续处理
       Route::get('qqlogin_back','StudentController@qqlogin_back');
       Route::post('sms','StudentController@sms');
   });
});
