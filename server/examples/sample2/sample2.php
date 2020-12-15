<?php
require_once '../../vendor/autoload.php';

// 商品一覧情報取得
$file = 'items.json';
$json = file_get_contents($file);
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$data = json_decode($json, true);

$loader = new \Twig\Loader\FilesystemLoader('./views');
$twig = new \Twig\Environment($loader);

echo $twig->render('sample2.html.twig', ['items' => $data['items']]);