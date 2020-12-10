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
        $link = mysqli_connect('db-host', 'root', 'password', 'mydb');
        $rs = mysqli_query($link, 'SELECT * FROM quiz order by id asc');
        $i = 0;
        while (true) {
            $row = mysqli_fetch_assoc($rs);
            if ($row == null) {
                break;
            } else {
                echo "問", $i + 1, ": {$row['question']}<br>";
                echo "<input type=\"radio\" name=ans$i>{$row['choice1']}<br>";
                echo "<input type=\"radio\" name=ans$i>{$row['choice2']}<br>";
                echo "<input type=\"radio\" name=ans$i>{$row['choice3']}<br>";
                echo "<input type=\"radio\" name=ans$i>{$row['choice4']}<br><br>";
                echo "<div hidden>{$row['ans']}</div>";
                $i++;
            }
        }
        mysqli_close($link);
        ?>
        <input type="submit" value="回答">
    </form>

    <?php
    $link = mysqli_connect('db-host', 'root', 'password', 'mydb');
    $rs = mysqli_query($link, 'SELECT * FROM quiz order by id asc');
    $rows = mysqli_fetch_assoc($rs);
    for ($i = 0; $i < count($rows); $i++) {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["ans$i"])) {
            $result = "不正解です";
            echo $_POST["ans$i"];
            echo $question[$i]['ans'];
            if ($_POST["ans$i"] == $question[$i]['ans']) {
                $result = "正解です";
            }
        }
    }
    ?>

</body>

</html>