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

echo $template->render($data);