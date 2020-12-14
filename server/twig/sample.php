<?php

require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('./view');

$twig = new \Twig\Environment($loader);

$template = $twig->load('sample.html.twig');

$data = array(
    'title' => 'sample',
    'message'  => 'My Webpage!',
);
echo $template->render($data);
?>
