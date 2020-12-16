<?php
require_once '../../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('./view');
$twig = new \Twig\Environment($loader);
$template = $twig->load('sample1.html.twig');

$data = [
    'sample_1' => '1',
    'sample_2' => '2',
    'sample_3' => '3',
];
$option2 = [
    '大阪' => 'osaka',
    '兵庫' => 'hyougo',
    '奈良' => 'nara',
];
$params = array(
    'data' => $data,
    'option2' => $option2,
);
echo $template->render($params);