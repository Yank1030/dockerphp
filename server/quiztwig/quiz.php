<?php

require_once '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('./view');

$twig = new \Twig\Environment($loader);

$template = $twig->load('quiz.html.twig');

$question1 = array(
    "questionnum" => "問題1",
    "question" => "日本で二番目に高い山は？",
    "choices" => array("choice1" => "阿蘇山", "choice2" => "北岳", "choice3" => "穂高岳", "choice4" => "二上山"),
    "ans" => "北岳"
);

$question2 = array(
    "questionnum" => "問題2",
    "question" => "日本で一番低い山は？",
    "choices" => array("choice1" => "富士山", "choice2" => "北岳", "choice3" => "天保山", "choice4" => "二上山"),
    "ans" => "天保山",
);


$question3 = array(
    "questionnum" => "問題3",
    "question" => "日本で一番面積の大きい都道府県は？",
    "choices" => array("choice1" => "岩手県", "choice2" => "沖縄県", "choice3" => "大阪府", "choice4" => "北海道"),
    "ans" => "北海道",
);

$data = array();
for ($i = 1; $i <= 3; $i++) {
    $var_question = 'question' . $i;
    $data += array("question$i" => $$var_question);
}

echo $template->render($data);

for ($i = 1; $i <= 3; $i++) {
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST[${'question' . $i}["ans"]])) {
        $result = "不正解です";
        if ($_POST[${'question' . $i}["ans"]] == ${'question' . $i}["ans"]) {
            $result = "正解です";
        }
        if (isset($result)) :
            echo ${'question' . $i}["questionnum"], ":", $result, "<br>";
        endif;
    }
}