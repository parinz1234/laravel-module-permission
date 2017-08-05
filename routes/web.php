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

Route::get('/adduser', [
    'as' => 'add_user',
    'uses' => 'initController@initUser'
]);

Route::get('/init', [
    'as' => 'init',
    'uses' => 'initController@init'
]);

Route::get('/testauth', [
    'as' => 'test_auth',
    'uses' => 'initController@testAuth'
]);

Route::get('/assignrole', [
    'as' => 'assign_role',
    'uses' => 'initController@assignRole'
]);

Route::get('/checkuser', [
    'as' => 'check_user',
    'uses' => 'initController@checkUser'
]);