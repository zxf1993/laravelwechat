<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function setPage(Request $request, $data, $prepage, $total)
    {
        #每页显示记录
        $prePage = $prepage;
        //$total =count($data);
        $allitem = $prepage *100;
        $total > $allitem ? $total = $allitem : $total;
        if(isset($request->page)){
            $current_page =intval($request->page);
            $current_page =$current_page<=0?1:$current_page;
        }else{
            $current_page = 1;
        }
        #url操作
        $url = $url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        if(strpos($url,'&page')) $url=str_replace('&page='.$request->page, '',$url);

        # $data must be array
        $item =array_slice($data,($current_page-1)*$prePage,$prePage);
        $paginator = new LengthAwarePaginator($item,$total,$prePage,$current_page,[
            'path'=>$url,
            'pageName'=>'page'
        ]);
        return $paginator;
    }
}
