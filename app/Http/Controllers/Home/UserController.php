<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function index(){

        return session()->get('test');
    }
    public function session(){
        return session()->get('key');
    }
}
