<?php
/**
 * BaseModel.php
 *
 * Version  :  1.0
 * Create by:  yangming
 * Copyright:
 * Created on: 2018/12/6 下午4:39
 */
namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BaseModel extends Model
{
    /*
     * 批量添加
     * $tableName   表名
     * $data        更新数据
     * $connect     库名
     */
    public function addAll($table,$data,$connect='')
    {
        if(!empty($connect)){
            $rs =DB::connection($connect)->table($table)->insert($data);
        }else{
            $rs = DB::table($table)->insert($data);
        }
        return $rs;
    }

    /*
     * 同时更新多个记录
     * $tableName   表名
     * $connect     库名
     * $multipleData 更新数据
     * 参数，表名，数组
     */
    public function updateBatch($tableName = "", $multipleData = [],$connect='')
    {

        if ($tableName && !empty($multipleData)) {
            $updateColumn    = array_keys($multipleData[0]);
            $referenceColumn = $updateColumn[0]; //e.g id
            unset($updateColumn[0]);
            $whereIn = "";
            $q = "UPDATE " . $tableName . " SET ";
            foreach ($updateColumn as $uColumn) {
                $q .= $uColumn . " = CASE ";

                foreach ($multipleData as $data) {
                    $q .= "WHEN " . $referenceColumn . " = " . $data[$referenceColumn] . " THEN '" . $data[$uColumn] . "' ";
                }
                $q .= "ELSE " . $uColumn . " END, ";
            }
            foreach ($multipleData as $data) {
                $whereIn .= "'" . $data[$referenceColumn] . "', ";
            }
            $q = rtrim($q, ", ") . " WHERE " . $referenceColumn . " IN (" . rtrim($whereIn, ', ') . ")";
            // Update
            if(!empty($connect)){
                return DB::connection($connect)->update(DB::raw($q));
            }else{
                return DB::update(DB::raw($q));
            }

        } else {
            return false;
        }

    }
}