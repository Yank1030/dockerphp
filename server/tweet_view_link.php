<!DOCTYPE html>
<html lang="ja">

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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>投稿内容</th>
                        <th>投稿時間</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $link = mysqli_connect("db-host", "root", "password", "mydb");

                    //登録された時間の新しい時間に並べて表示したい
                    //この１行で実行
                    $rs = mysqli_query($link, "select * from tweet order by input_datetime desc");

                    while (true) {
                        $row = mysqli_fetch_assoc($rs);
                        if ($row == null) {
                            break;
                        } else {
                            echo "<tr>";
                            echo "<td>{$row['name']}</td>";
                            echo "<td>{$row['contents']}</td>";
                            echo "<td>{$row['input_datetime']}</td>";
                            $id = $row["id"];
                            echo "<td><a href='tweet_del.php?id=$id'>削除</a></td>";
                            echo "</tr>";
                        }
                    }

                    //データベースとの接続を切る
                    mysqli_close($link);


                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="css/dist/js/bootstrap.min.js"></script>
    <script src="css/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="css/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>