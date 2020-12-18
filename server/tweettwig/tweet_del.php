<?php

require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('./view');

$twig = new \Twig\Environment($loader);

$template = $twig->load('tweet.html.twig');

$link = mysqli_connect("db-host", "root", "password", "mydb");

$id = $_GET['id'];

if (!$id) {
    $err_message['err_no_id'] = "データがありません";
} else {
    mysqli_query($link, "DELETE from tweet where id = $id");
    $suc_message = "削除しました";
}


$tweettitle = array(
    'name' => '名前',
    'contents' => '投稿内容',
    'input_datetime' => '投稿時間',
    'delete' => '削除',
);

$sql = "SELECT * from tweet order by input_datetime desc";
//echo $sql;

$dbsdata = array();

//この１行で実行
$rs = mysqli_query($link, $sql);

while (true) {
    //取得した行に対応する連想配列を返す
    $row = mysqli_fetch_assoc($rs);
    if ($row == null) {
        break;
    } else {
        array_push($dbsdata, $row);
    }
}

//データベースとの接続を切る
mysqli_close($link);

echo $template->render(
    array(
        'tweettitle' => $tweettitle,
        'errmessage' => $err_message,
        'sucmessage' => $suc_message,
        'dbsdata' => $dbsdata,
    )
);