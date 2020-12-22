<?php
//File
if (!isset($_FILES['upfile']['error']) || !is_int($_FILES['upfile']['error'])) {
    // echo 'パラメータが不正です';
} else {
    $file_name = $_FILES["upfile"]["name"];  //"1.jpg"ファイル名取得
    $tmp_path  = $_FILES["upfile"]["tmp_name"]; //"/usr/www/tmp/1.jpg"アップロード先のTempフォルダ
    $file_dir_path = "upload/";
    $img = "";
    // FileUpload [--Start--]
    if (is_uploaded_file($tmp_path)) {
        if (move_uploaded_file($tmp_path, $file_dir_path . $file_name)) {
            chmod($file_dir_path . $file_name, 0644);
            echo $file_name . "をアップロードしました。";
            $img = '<img src="' . $file_dir_path . $file_name . '" >';
        } else {
            echo "Error:アップロードできませんでした。";
        }
    }
    // FileUpload [--End--]
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>カメラ／写真選択</title>
    <style>
    fieldset {
        border: 1px solid #666;
        padding: 3px;
    }

    #photarea {
        padding: 5%;
        width: 90%;
        background: black;
    }

    img {
        width: 100%
    }
    </style>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="main">

    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="#">写真アップロード</a></div>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="jumbotron">
            <h1>PHP＆JS＆HTML５</h1>
            <p>最初にカメラ・写真の選択をおこない、サーバにアップロードします。PHP側で受け取りサーバに置く処理をおこないます。</p>

            <form method="post" action="image.php" enctype="multipart/form-data">
                <p><input type="file" id="image_file" name="upfile"></p>
                <p><input type="submit" class="btn btn-success btn-lg" value="Fileアップロード"></p>
            </form>


        </div>
        <div id="photarea"><?= $img ?></div>
    </div>
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>