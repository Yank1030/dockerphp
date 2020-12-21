<?php
require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('./view');

$twig = new \Twig\Environment($loader);

$template = $twig->load('index.html.twig');

const STORE_FILE_PATH = './ranking.json';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('不正なアクセスです');
}

if (!isset($_POST['result']) || !is_numeric($_POST['result'])) {
    exit('不正なパラメータです');
}
$result = $_POST['result'];

// 現在のランキングを取得する
$ranking = json_decode(file_get_contents(STORE_FILE_PATH), true);

// 現在のランクに今回の結果を追加
$ranking[] = $result;

// ランキングを再ソート
sort($ranking);

// 新しいランキングを保存
file_put_contents(STORE_FILE_PATH, json_encode($ranking));

$flg = false;
foreach ($ranking as $rank => $time) {
    array(
        $rank => $rank + 1,
        $time => number_format($time, 3, '.', ','),
    );
}


echo $template->render(
    array(
        'ranking' => $ranking,
    )
);