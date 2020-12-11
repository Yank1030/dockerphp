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

        <?php
        $questions = 4;
        $link = mysqli_connect('db-host', 'root', 'password', 'mydb');
        $rs = mysqli_query($link, 'SELECT * FROM quiz order by id asc');
        $i = 0;
        while (true) {
            $row = mysqli_fetch_assoc($rs);
            if ($row == null) {
                break;
            } else {
                echo "問", $i + 1, ": {$row['question']}<br>";
                for ($j = 1; $j <= $questions; $j++) {
                    echo "<input type=\"radio\" name=\"ans$i\" value=\"$j\">{$row['choice' .$j . '']}<br>";
                }
                echo "<br><div hidden>{$row['ans']}</div>";
                $i++;
            }
        }
        mysqli_close($link);
        ?>
        <input type="submit" value="回答">
    </form>

    <?php
    $link = mysqli_connect('db-host', 'root', 'password', 'mydb');
    $rs1 = mysqli_query($link, 'SELECT * FROM quiz order by id asc');
    $rs2 = mysqli_query($link, 'SELECT count(*) as num FROM quiz');
    $qn = mysqli_fetch_assoc($rs2);
    for ($i = 1; $i <= $qn["num"] + 1; $i++) {
        $rows = mysqli_fetch_assoc($rs1);
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["ans$i"])) {
            $result = "不正解です";
            echo "取得数", $qn["num"];
            var_dump($_POST["ans$i"]);
            echo "入力値：", $_POST["ans$i"];
            if ($_POST["ans$i"] == $rows['ans']) {
                $result = "正解です";
            }
            if (isset($result)) :
                echo "<p>問", $i, ":", $result, "</p>";
            endif;
        }
    }
    ?>

</body>

</html>