 <!DOCTYPE html>
 <html lang="ja">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $link = mysqli_connect('db-host', 'root', 'password', 'mydb');

                        if (!$link) {
                            echo "データベース接続失敗" . PHP_EOL;
                            echo "errno: " . mysqli_connect_errno() . PHP_EOL;
                            echo "error: " . mysqli_connect_error() . PHP_EOL;
                            exit;
                        }
                        echo 'データベース接続成功';

                        //クエリを実行するためのデフォルトのデータベースを選択
                        //mysqli_select_db($link, "mydb"); ← mysqli_connectにすでに入っている
                        //データベース上でクエリを実行
                        $rs = mysqli_query($link, 'SELECT * FROM tweet order by input_datetime');

                        while (true) {
                            //取得した行に対応する連想配列を返す
                            $row = mysqli_fetch_assoc($rs);
                            if ($row == null) {
                                break;
                            } else {
                                echo "<tr>";
                                echo "<td>{$row['name']}</td>";
                                echo "<td>{$row['contents']}</td>";
                                echo "<td>{$row['input_datetime']}</td>";
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


     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
         integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
     </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
         integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
     </script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
         integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
     </script>

 </body>

 </html>