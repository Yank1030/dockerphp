<?php

require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('./view');

$twig = new \Twig\Environment($loader);

$template = $twig->load('quiz.html.twig');

$question = array(
    "title" => "問題1",
    "question" => "日本で二番目に高い山は？",
    "choice1" => "富士山",
    "choice2" => "北岳",
    "choice3" => "穂高岳",
    "choice4" => "二上山",
    "ans" => "北岳"
);
echo $template->render($question);

// {% for questions in question %}
// {% if $_SERVER['REQUEST_METHOD'] == "POST" &&isset($_POST["ans$i"]))){
//     {%  if ($_POST["ans$i"] == $question[$i]['ans'])%}
//     echo "正解です";
//     {% endif %}
//     {% if (isset($result)):%}
//     {% endif %}
// }