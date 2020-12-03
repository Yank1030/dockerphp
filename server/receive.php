<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ確認</title>
</head>
<body>
    <h1>データ確認画面</h1>

    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $myname = htmlspecialchars($_POST['myname'], ENT_QUOTES, 'UTF-8');
        $age = (int)$_POST['age'];
        $err = '';
        if($myname){
            if(strlen($myname) > 30){
                $err='ユーザ名が長いです';
            }
        }else{
            $err = '名前の入力がありません';
        }
    }

    //年齢チェック
    if(preg_match('/^[0-9]+$/',$age)){
        if($age > 200){
            $err = '正しい年齢を入力してください';
        }
    }else{
        $err = '年齢は半角数字を入れてください';
    }
    ?>

エラー：<?php echo $err ?>
</body>
</html>