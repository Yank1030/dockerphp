<?php

require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('./view');

$twig = new \Twig\Environment($loader);

$template = $twig->load('tweet.html.twig');

$tweettitle = array(
    "name" => "名前",
    "contents" => "投稿内容",
    "input_datetime" => "投稿時間",
    "delete" => "削除",
);

$dbsdata = array();

$link = mysqli_connect('db-host', 'root', 'password', 'mydb');
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
        'dbsdata' => $dbsdata,
    )
);