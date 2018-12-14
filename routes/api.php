<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['api','cors']], function () {
    Route::post('register', 'User\ApiController@register');     // 注册
    Route::post('login', 'User\ApiController@login');           // 登陆
    Route::post('test', 'User\ApiController@test');           // ceshi
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('get_user_details', 'User\ApiController@get_user_details');  // 获取用户详情
        Route::get('quitLogin', 'User\ApiController@quitLogin');  // 退出登录
    });
});
