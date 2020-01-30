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

Route::match(['get', 'post'], '/', ['uses'=>'UserLoginController@login', 'as'=>'login'])->middleware('loginAuth');

Route::match(['get', 'post'], '/register', ['uses'=>'UserRegisterContoller@register', 'as'=>'register']);

Route::match(['get', 'post'], '/exit',['uses'=>'UserLoginController@logout', 'as'=>'logout']);

Route::get('/links', 'LinkController@getAllUserLinks')->middleware('userAuthorize');

Route::match(['get', 'post'], '/createlink', ['uses'=>'LinkController@createUserLink', 'as'=>'createLink'])->middleware('userAuthorize');

Route::match(['get', 'post'], '/editlink/{linkId?}', 'LinkController@editUserLink')->middleware('userAuthorize');

Route::get('/{linkKey?}', 'LinkController@redirectToUserLink');

/*  Autorize
->middleware('userAuthorize')
Route::group(['middleware'=>'userAuthorize'], function () {
    Route::match(['get', 'post'], '/register', ['uses'=>'UserRegisterContoller@register', 'as'=>'register']);

    Route::match(['get', 'post'], '/exit',['uses'=>'UserLoginController@logout', 'as'=>'logout']);

    Route::get('/links', 'LinkController@getAllUserLinks');

    Route::match(['get', 'post'], '/createlink', 'LinkController@createUserLink');

    Route::match(['get', 'post'], '/editlink/{linkId?}', 'LinkController@editUserLink');
});
*/