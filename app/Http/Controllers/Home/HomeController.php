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

use App\Models\BaseModel;
use App\Models\LaravelTest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Validator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
//        $users = DB::select('select * from business_image');
        $users = DB::table('business_image')->paginate(15);
//        $prePage=15;
//        $total=count($users);
//        $paginator = $this->setPage($request,$users,$prePage,$total);
//        dd($paginator);
//        $data =$paginator->toArray()['data'];


//        $users = 'ererere';
//        session(['key' => $users]);
//        return view('Home.index')->with('list', $users);
//
//        $users_ucenyer = DB::connection('mysql_ucenter')->select('select * from uc_user where id=3', [1]);

        return view('Home.index')->with('lists', $users);
    }

    public function test()
    {
        $data          = new BaseModel();
        $test          = new LaravelTest();
        $users_ucenyer = $test->getAll();
        $array         = [
            ['name' => 'eee'],
            ['name' => 'ddd'],
        ];;
        addAll('laravel_test', $array);
//        $data->addAll('laravel_test',$array,'mysql_ucenter');
//        $data->updateBatch('laravel_test',$array);
//        $data->updateBatch('laravel_test',$array,'mysql_ucenter');
    }

    public function input(Request $request)
    {
        $path = $request->all();
        return $path;
    }

    public function show()
    {
        return view('Home.show');
    }

    public function image(Request $request)
    {
        $name = 'photo';
        $path = 'photo';
        multiUploadImg($name, $path);
    }

    /*
 * 但文件上传
*/
    function upload(Request $request, $name, $path)
    {
        if ($request->hasFile($name) && $request->file($name)->isValid()) {
            $photo        = $request->file($name);
            $extension    = $photo->extension();
            $store_result = $photo->storeAs($path, 'test.jpg');//设置图片目录
            $output       = [
                'extension'    => $extension,
                'store_result' => $store_result,
            ];
            return $output;
        }
        exit('未获取到上传文件或上传过程出错');
    }
}
