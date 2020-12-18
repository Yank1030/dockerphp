<?php

require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('./view');

$twig = new \Twig\Environment($loader);

$template = $twig->load('tweet.html.twig');

$tweettitle = array(
    'name' => '名前',
    'contents' => '投稿内容',
    'input_datetime' => '投稿時間',
    'delete' => '削除',
);

$dbsdata = array();
$errmessage = array();

$link = mysqli_connect("db-host", "root", "password", "mydb");
$contents = $_GET["contents"];

$len = mb_strlen($contents, "utf-8");

if ($len == 0) {
    $err_message['err_empty'] = "空白です";
} else if ($len > 140) {
    $err_message['err_over_length'] = "文字数オーバーです";
} else {
    mysqli_query($link, 'INSERT tweet(name, contents, input_datetime)values("kei", "' . $contents . '" , sysdate())');
    $suc_message = "ツイートしました";
}


$rs = mysqli_query($link, 'SELECT * FROM tweet order by input_datetime desc');

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