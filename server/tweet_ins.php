<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Twitter風掲示板</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="tweet.php">Twitter風掲示板</a>
            </div>

        </div>
    </nav>

    <div class="col-md-3">
        <form action="tweet_ins.php" method="GET">
            <br>
            ツイート内容を入力してください。<br>
            <textarea name="contents" cols="40" rows="4"></textarea>
            <br>

            <input type="submit" value="ツイート" class="btn btn-primary">
        </form>
    </div>

    <div class="col-md-9">

        <div class="table-responsive">
            <p>ここにツイートを表示する。</p>
            <?php

            $link = mysqli_connect("db-host", "root", "password", "mydb");
            $contents = $_GET["contents"];

            $len = mb_strlen($contents, "utf-8");

            if ($len == 0) {
                echo "空白です";
            } else if ($len > 140) {
                echo "文字数オーバーです";
            } else {
                //testというデータベースに対してSQLを実行する 
                mysqli_query($link, 'INSERT tweet(name, contents, input_datetime)values("kei", "' . $contents . '" , sysdate())');

                echo "ツイートしました";
            }

            //データベースとの接続を切る
            mysqli_close($link);

            ?>


        </div>
    </div>
</body>

</html>