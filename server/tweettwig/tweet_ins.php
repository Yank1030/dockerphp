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

$message = array(
    'title' => 'Twitter風掲示板',
    'insertwarning' => 'ツイート内容を入力してください',
);

$data = array(
    'teettitle' => $tweettitle,
    'message' => $message,
);

echo $template->render($data);

$link = mysqli_connect("db-host", "root", "password", "mydb");
$contents = $_GET["contents"];

$len = mb_strlen($contents, "utf-8");

if ($len == 0) {
    echo "空白です";
} else if ($len > 140) {
    echo "文字数オーバーです";
} else {
    mysqli_query($link, 'INSERT tweet(name, contents, input_datetime)values("kei", "' . $contents . '" , sysdate())');
    echo "ツイートしました";
}


$rs = mysqli_query($link, 'SELECT * FROM tweet order by input_datetime desc');

while (true) {
    //取得した行に対応する連想配列を返す
    $row = mysqli_fetch_assoc($rs);
    if ($row == null) {
        break;
    } else {
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
}

//データベースとの接続を切る
mysqli_close($link);