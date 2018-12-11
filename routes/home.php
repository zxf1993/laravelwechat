<?php
Route::get('index', 'HomeController@index');
Route::get('test', 'HomeController@test');

Route::get('index1', 'UserController@index');
Route::get('users', 'UserController@session');
Route::get('input', 'HomeController@input');
Route::any('upload', 'HomeController@upload');
Route::any('show', 'HomeController@show');
