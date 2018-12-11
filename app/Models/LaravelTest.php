<?php
/**
 * LaravelTest.php
 *
 * Version  :  1.0
 * Create by:  yangming
 * Copyright:
 * Created on: 2018/12/6 下午4:45
 */
namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaravelTest extends BaseModel
{
    protected $table = 'laravel_test';

    public function getAll()
    {
        $sql='select * from '.config('database.connections.mysql_ucenter.database','default_val').'.laravel_test as lt join laravel_test lte on lt.id=lte.id';
        $db=DB::select($sql);
        return $db;
    }
}