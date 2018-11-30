<?php
/**
 * VerifyTest.php
 *
 * Version  :  1.0
 * Create by:  yangming
 * Copyright:
 * Created on: 2018/11/30 上午9:53
 */
namespace App\Http\Middleware;
use Closure;

class VerifyHome
{
    public function handle($request, Closure $next)
    {
        // if ("判断条件") {
        return $next($request);
        // }

        // 返回跳转到网站首页
        // return redirect('/');
    }
}
