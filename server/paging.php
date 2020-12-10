<?php

// 初期パラメータセット
$maxArticlesPerPage = 5;
$page = 1;
if (isset($_GET['p']) && preg_match('/^[1-9][0-9]*$/', $_GET['p'])) {
    $page = $_GET['p'];
}
$offset = ($page - 1) * $maxArticlesPerPage;

// データベーへの接続
try {
    $dbh = new PDO('mysql:host=db-host;dbname=mydb;charset=utf8', 'root', 'password', array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
    var_dump($e->getMessage());
    exit;
}
// 記事データ取得
$sql = "select id, article from articles limit ? offset ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($maxArticlesPerPage, $offset));
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 合計記事数、ページ数を算出
$totalArticles = $dbh->query("select count(id) from articles")->fetchColumn();
$totalPages = ceil($totalArticles / $maxArticlesPerPage);

// 表示中の記事数表示
$from = $offset + 1;
$to   = $offset + $maxArticlesPerPage;
if ($to > $totalArticles) {
    $to = $totalArticles;
}
?>
<!DOCTYPE>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>ページング機能の実装</title>
</head>

<body>
    <h1>記事一覧</h1>
    <p><?php echo $from ?>〜<?php echo $to ?>件を表示／全<?php echo $totalArticles ?>件中</p>
    <ul>
        <?php foreach ($articles as $article) : ?>
        <li><?php echo htmlspecialchars($article['article'], ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach ?>
    </ul>
    <?php if ($page > 1) : ?>
    <a href="?p=<?php echo $page - 1 ?>">&lt;</a>
    <?php endif ?>
    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
    <?php if ($i == $page) : ?>
    <strong><a href="?p=<?php echo $i ?>"><?php echo $i ?></a></strong>
    <?php else : ?>
    <a href="?p=<?php echo $i ?>"><?php echo $i ?></a>
    <?php endif ?>
    <?php endfor ?>
    <?php if ($page < $totalPages) : ?>
    <a href="?p=<?php echo $page + 1 ?>">&gt;</a>
    <?php endif ?>
</body>

</html>