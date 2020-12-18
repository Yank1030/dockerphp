<?php
require_once '../../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('./view');

$twig = new \Twig\Environment($loader);

$template = $twig->load('sample3.html.twig');

//DBへ接続
$com = mysqli_connect('db-host', 'root', 'password', 'mydb');

if ($com !== false) {
    //変数を初期化
    $success_msg = null;
    $error_msgs = array();
    $posted_data = array();

    //処理
    if (isset($_POST['send']) === true) {
        //入力情報を取得
        $name = $_POST['name'];
        $comment = $_POST['comment'];

        //validation
        $name_str = mb_strlen($name);
        $comment_str = mb_strlen($comment);

        //エラーの種類判別
        if ($name_str === 0) {
            $error_msgs['empty_name'] = '名前を入力して下さい。';
        }
        if ($comment_str === 0) {
            $error_msgs['empty_comment'] = '本文を入力して下さい。';
        }
        if ($name_str > 10) {
            $error_msgs['over_name'] = '名前は10文字以内で入力して下さい。';
        }
        if ($comment_str > 100) {
            $error_msgs['over_comment'] = '本文は100文字以内で入力して下さい。';
        }

        //DBへデータ追加処理
        if (!$error_msgs) {
            //sqlインジェクション対策
            $name = mysqli_real_escape_string($com, $name);
            $comment = mysqli_real_escape_string($com, $comment);

            //sqlの発行
            $sql = "INSERT INTO post(name,comment)VALUES('$name','$comment')";

            //sqlの実行
            $result = mysqli_query($com, $sql);

            //結果メッセージ
            if ($result !== false) {
                $success_msg = '投稿に成功しました。';
            } else {
                $error_msgs['result'] = '投稿に失敗しました。';
            }
        }
    }

    //投稿一覧データの取得
    $sql = "SELECT * FROM post ORDER BY id DESC";
    $result = mysqli_query($com, $sql);

    //結果を連想配列で取得
    while ($row = mysqli_fetch_assoc($result)) {
        //結果を表示用の配列に追加
        array_push($posted_data, $row);
    }
} else {
    echo 'データベースの接続に失敗しました。';
}

//DBへの接続を閉じる
mysqli_close($com);

//レンダリング
echo $template->render(
    array(
        'success_msg' => $success_msg,
        'error_msgs' => $error_msgs,
        'posted_data' => $posted_data,
    )
);