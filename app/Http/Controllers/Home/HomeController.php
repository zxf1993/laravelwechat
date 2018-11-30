<?php
/**
 * TestController.php
 *
 * Version  :  1.0
 * Create by:  yangming
 * Copyright:
 * Created on: 2018/11/29 下午5:47
 */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        echo "111222";
    }
    public function home()
    {
        echo "333";
    }
}
