<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<form action="/home/upload" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}" />
    文件名：<input type="file" name="photo" value="" /><br />
    <input type="submit" value="上传" />
</form>
</body>
</html>