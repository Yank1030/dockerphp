<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ありがとうございました</title>
</head>
<body>
    <?php
    if($_POST['token'] != $_SESSION['token']){
        echo '<h1>ページ遷移が正しくありません</h1>';
    }else{
        echo '<h1>ありがとうございました</h1>';
        echo $_SESSION['myname'];
    }    
    ?>
</body>
</html>
<?php session_destroy(); ?>