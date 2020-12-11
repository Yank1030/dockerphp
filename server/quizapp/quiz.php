<?php
$question = array(
    array(
        "question" => "日本で二番目に高い山は？",
        "choices" => array("富士山", "北岳", "穂高岳", "二上山"),
        "ans" => "北岳"
    ),
    array(
        "question" => "日本で一番低い山は？",
        "choices" => array("富士山", "北岳", "天保山", "二上山"),
        "ans" => "天保山",
    ),
    array(
        "question" => "日本で一番面積の大きい都道府県は？",
        "choices" => array("岩手県", "沖縄県", "大阪府", "北海道"),
        "ans" => "北海道",
    )
);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Quiz</p>

    <form action="" method="POST">
        <?php for ($i = 0; $i < count($question); $i++) { ?>

        <p>問題 <?php echo $i + 1 ?>: <?php echo $question[$i]['question']; ?></p>

        <ul>
            <div>
                <?php foreach ($question[$i]['choices'] as $choices) : ?>
                <input type="radio" name="<?php echo "ans$i" ?>"
                    value="<?php echo $choices; ?>"><?php echo $choices; ?><br>
                <?php endforeach; ?>
            </div>
        </ul>

        <?php } ?>
        <input type="submit" value="回答">
    </form>

    <?php
    for ($i = 0; $i < count($question); $i++) {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["ans$i"])) {
            $result = "不正解です";
            echo $_POST["ans$i"];
            echo $question[$i]['ans'];
            if ($_POST["ans$i"] == $question[$i]['ans']) {
                $result = "正解です";
            }
            if (isset($result)) : ?>
    <p><?php echo "問", $i + 1, ":", $result ?></p>
    <?php endif;
        }
    }
    ?>
</body>

</html>