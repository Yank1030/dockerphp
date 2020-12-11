<?php
// APIのIDとURLを取得
require_once("common.php");

// リクエストの組み立て
$params = array(
  "applicationId" => RAKUTEN_APPID,
  "keyword"   => "グラフィックボード",
  "hits" => 10,
  "page" => 1,
  "sort" => "+itemPrice"
);
$query = http_build_query($params);
$request = RAKUTEN_ITEM_SEARCH_API . '?' . $query;

// API呼び出し
$response = file_get_contents($request);
$result = json_decode($response);

// 結果の出力
var_dump($result);