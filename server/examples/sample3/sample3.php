<?php
require_once '../../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('./view');

$twig = new \Twig\Environment($loader);

$template = $twig->load('sample3.html.twig');

//レンダリング
echo $template->render(
    array(
        'success_msg' => "success_msg",
        'error_msgs' => "error_msgs",
        'posted_data' => "posted_data",
    )
);