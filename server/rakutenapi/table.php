<?php
// APIのIDとURLを取得
require_once("common.php");

// 検索実行
$result = get_rakuten_items("グラフィックボード");
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>商品検索(楽天)</title>
    <style>
    table {
        width: 1200px;
        border: solid 2px orangered;
        table-layout: fixed;
    }

    table th,
    table td {
        border: solid 1px orange;
    }
    </style>
</head>

<body>
    <h1>商品検索(楽天)</h1>
    <center>
        <table>
            <tr>
                <th width=150px>イメージ</th>
                <th>商品名</th>
                <th width=150px>価格</th>
            </tr>
            <?php
            var_dump($result);
            foreach ($result->Items as $item) : ?>
            <tr>
                <td><img src='<?php echo $item->Item->mediumImageUrls[0]->imageUrl; ?>'></td>
                <td><?php echo $item->Item->itemName; ?></td>
                <td>
                    <center><?php echo number_format($item->Item->itemPrice); ?>円</center>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </center>

    <div style="margin:20px;">&nbsp;</div>
    <!-- Rakuten Web Services Attribution Snippet FROM HERE -->
    <a href="http://webservice.rakuten.co.jp/" target="_blank"><img
            src="http://webservice.rakuten.co.jp/img/credit/200709/credit_31130.gif" border="0" alt="楽天ウェブサービスセンター"
            title="楽天ウェブサービスセンター" width="311" height="30" /></a>
    <!-- Rakuten Web Services Attribution Snippet TO HERE -->
</body>

</html>