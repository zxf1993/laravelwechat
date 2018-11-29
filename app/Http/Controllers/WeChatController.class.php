<?php
/**
 * Created by PhpStorm.
 * User: zhangxiufeng
 * Date: 2018/11/29
 * Time: 4:43 PM
 */

namespace App\Http\Controllers;

use Log;

class WeChatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');
        $app->server->push(function($message){
            return "欢迎来到测试环节";
        });

        return $app->server->serve();

    }
}