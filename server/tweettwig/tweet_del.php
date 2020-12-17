<?php

require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('./view');

$twig = new \Twig\Environment($loader);

$template = $twig->load('tweet.html.twig');

echo $_GET['id'];

$link = mysqli_connect("db-host", "root", "password", "mydb");

$id = $_GET['id'];

mysqli_query($link, "DELETE from tweet where id = $id");

$tweettitle = array(
    'name' => '名前',
    'contents' => '投稿内容',
    'input_datetime' => '投稿時間',
    'delete' => '削除',
);

$message = array(
    'title' => 'Twitter風掲示板',
    'insertwarning' => 'ツイート内容を入力してください',
);

$data = array(
    'teettitle' => $tweettitle,
    'message' => $message,
);

echo $template->render($data);

$sql = "SELECT * from tweet order by input_datetime desc";
//echo $sql;

//この１行で実行
$rs = mysqli_query($link, $sql);

while ($row = mysqli_fetch_assoc($rs)) {
    echo "<th>";
    echo "<tr>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['contents']}</td>";
    echo "<td>{$row['input_datetime']}</td>";
    $id = $row["id"];
    echo "<td><a href='tweet_del.php?id=$id'>削除</a></td>";
    echo "</tr>";
    echo "</th>";
}

//データベースとの接続を切る
mysqli_close($link);