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
    public function index()
    {
        $users = DB::select('select * from business_image where id=1', [1]) ;
        $users='ererere';
        session(['key' => $users]);
        return view('Home.index')->with('data',$users);

        $users_ucenyer=DB::connection('mysql_ucenter')->select('select * from uc_user where id=3',[1]);

        return view('Home.index')->with('user',$users_ucenyer);
    }
    public function test()
    {
        $data=new BaseModel();
        $test=new LaravelTest();
        $users_ucenyer= $test->getAll();
        $array= [
            ['id'=>1,'name'=>'eee'],
            ['id'=>2,'name'=>'ddd'],
        ];;
//        $data->addAll('laravel_test',$array);
//        $data->addAll('laravel_test',$array,'mysql_ucenter');
//        $data->updateBatch('laravel_test',$array);
//        $data->updateBatch('laravel_test',$array,'mysql_ucenter');
    }
    public function input(Request $request){
        $path  =$request->all();
        return $path;
    }
    public function show(){
        return view('Home.show');
    }
    public function upload(Request $request){
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = $request->file('photo');
            $extension = $photo->extension();
            $store_result = $photo->storeAs('photo', 'test.jpg');//设置图片目录
            $output = [
                'extension' => $extension,
                'store_result' => $store_result
            ];
            print_r($output);exit();
        }
        exit('未获取到上传文件或上传过程出错');
    }
    public function multiUploadImg(Request $request){
        // 重组数组，子函数
        function reArrayFiles( $file_post ) {

            $file_ary = array();
            $file_count = count($file_post['name']);
            $file_keys = array_keys($file_post);

            for ($i=0; $i<$file_count; $i++) {
                foreach ($file_keys as $key) {
                    $file_ary[$i][$key] = $file_post[$key][$i];
                }
            }

            return $file_ary;
        }
        $imgFiles = $_FILES['photo']; // 与前端页面中的 input name=“filesToUpload[]” 相对应
        $uploadedFiles = array(); // 返回值

        if(!empty($imgFiles))
        {
            $img_desc = reArrayFiles( $imgFiles );
            $destinationPath = UPLOAD_URL.'app/photo/';
            foreach( $img_desc as $img )
            {
                $savedFile = $destinationPath.date('YmdHis',time()).mt_rand().'.'.pathinfo( $img['name'], PATHINFO_EXTENSION );
                move_uploaded_file($img['tmp_name'],  $savedFile);
                $img['savedFile'] = $savedFile ;
                array_push( $uploadedFiles, $img );
            }
        }

        $allowed_extensions = ["png", "jpg", "gif"];
        // TODO 判断文件类型

        return ['uploadedFiles' => $uploadedFiles ];
    }
}
