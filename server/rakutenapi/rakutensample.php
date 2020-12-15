<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <title>楽天商品検索API サンプル</title>
    <style type="text/css">
    <!--
    img {
        border: none;
    }

    table {
        margin: 10px;
        border-top-width: 1px;
        border-left-width: 1px;
        border-top-style: solid;
        border-left-style: solid;
        border-top-color: gray;
        border-left-color: gray;
    }

    table td {
        padding: 5px;
        border-right-width: 1px;
        border-bottom-width: 1px;
        border-right-style: solid;
        border-bottom-style: solid;
        border-right-color: gray;
        border-bottom-color: gray;
    }

    .image {
        width: 80px;
        text-align: center;
    }

    .price {
        color: #8b0000;
        font-weight: bold;
        width: 80px;
        text-align: center;
    }

    //
    -->
    </style>
</head>

<body>
    <?php
    mb_language("Japanese");
    mb_internal_encoding("utf-8");

    //★追加開始----
    $me = $_SERVER['SCRIPT_NAME'];
    if (isset($_GET['page'])) {
        $num = intval($_GET['page']);
        if ($num < 1)   $num = 1;
    } else {
        $num = 1;
    }
    if ($num == 1) {
        $n2 = $num + 1;
        $paging = "<a href=\"{$me}?page={$n2}\">次のページ</a>>>";
    } else {
        $n1 = $num - 1;
        $n2 = $num + 1;
        $paging = "<<<a href=\"{$me}?page={$n1}\">前のページ</a>　　<a href=\"{$me}?page={$n2}\">次のページ</a>>>";
    }
    //★追加終了----

    $hit = '30';
    $word = 'PHP プログラミング';
    $base = 'https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706?applicationId=1083936079267142254&';
    $keyword = '&keyword=' . urlencode($word);
    $hits = '&hits=' . $hit;
    $page = '&page=' . $num;
    $sort = '&sort=-itemPrice';
    $file = $base . $affiliateId . $operation . $keyword . $hits . $page . $sort;

    $data = file_get_contents($file);
    $data = str_replace('itemSearch:ItemSearch', 'itemsearch', $data);
    $xml = simplexml_load_string($data);

    foreach ($xml->Body->itemsearch->Items->Item as $item) {

        $itemName = $item->itemName;
        $itemPrice = $item->itemPrice;
        $itemCaption = $item->itemCaption;
        $affiliateUrl = $item->affiliateUrl;
        $smallImageUrl = $item->smallImageUrl;

        //文字数を指定して抜き出す　100文字以上なら･･･を追加する
        $content = mb_substr($itemCaption, 0, 100);
        if (mb_strlen($itemCaption) > 100) {
            $content .= '･･･';
        }

        print <<< page
<table width="80%" cellspacing="0" cellpadding="0">
  <tr>
    <td class="image" rowspan="2">
      <a href="{$affiliateUrl}" target="_blank"><img src="{$smallImageUrl}"</a>
    </td>
    <td><a href="{$affiliateUrl}" target="_blank">{$itemName}</a></td>
    <td class="price">{$itemPrice}円</td>
  </tr>
  <tr>
    <td colspan="2">{$content}</td>
  </tr>
</table>

page;
    }
    echo "<p>{$paging}</p>"
    ?>
    <!-- Rakuten Web Services Attribution Snippet FROM HERE -->
    <a href="http://webservice.rakuten.co.jp/" target="_blank">
        Supported by 楽天ウェブサービス</a>
    <!-- Rakuten Web Services Attribution Snippet TO HERE -->
</body>

</html>