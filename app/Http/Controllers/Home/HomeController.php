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

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = DB::select('select * from business_image where id=1', [1]) ;
        return view('Home.index')->with('data',$users);

        $users_ucenyer=DB::connection('mysql_ucenter')->select('select * from uc_user where id=3',[1]);
        return view('Home.index')->with('user',$users_ucenyer);
    }
}
