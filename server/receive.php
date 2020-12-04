<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ確認</title>
</head>

<body>
    <?php
    $err = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $myname = htmlspecialchars($_POST['myname'], ENT_QUOTES, 'UTF-8');
        $age = (int)$_POST['age'];
        if ($myname) {
            if (strlen($myname) > 30) {
                $err = 'ユーザ名が長いです';
            }
        } else {
            $err = '名前の入力がありません';
        }

        //年齢チェック
        if (preg_match('/^[0-9]+$/', $age)) {
            if ($age > 200) {
                $err = '正しい年齢を入力してください';
            }
        } else {
            $err = '年齢は半角数字を入れてください';
        }
    } else {
        $err = '正常にデータを受信できませんでした';
        $myname = '';
        $age = '';
    }

    if ($err) {
        echo '<form action="receive.php" method="POST">';
        echo '名前：<input type="text" name="myname" value="' . $myname . '"><br>';
        echo '年齢：<input type="number" name="age" value="' . $age . '"><br>';
        echo '<input type="submit" value="送信">';
        echo '</form>';
    } else {
        $_SESSION['myname'] = $myname;
        $_SESSION['age'] = $age;
        //make token
        $bytes = openssl_random_pseudo_bytes(16);
        //convert to 16進数
        $token = bin2hex($bytes);
        //set to session
        $_SESSION['token'] = $token;
    ?>

    <h1>入力データの確認</h1>
    名前：<?php echo $myname ?><br>
    年齢：<?php echo $age ?><br>
    <form action="tnk.php" method="POST">
        <input type="hidden" name="token" value=<?php echo $token ?>>
        <input type="submit" value="送信">
    </form>
    <?php
    }
    ?>
</body>

</html>