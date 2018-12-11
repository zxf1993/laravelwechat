<?php

    /*
    * 批量添加
    * $tableName   表名
    * $data        更新数据
    * $connect     库名
    */
function addAll($table,$data,$connect='')
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
function updateBatch($tableName = "", $multipleData = [],$connect='')
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
function upload(Request $request){
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
function multiUploadImg(Request $request){
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