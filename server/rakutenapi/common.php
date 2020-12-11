<?php
// 楽天API情報
define("RAKUTEN_APPID", "1083936079267142254");
define("RAKUTEN_ITEM_SEARCH_API", "https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706");

function get_rakuten_items($keyword)
{
  // リクエストの組み立て
  $params = array(
    "applicationId" => RAKUTEN_APPID,
    "keyword"   => $keyword,
    "hits" => 30,
    "sort" => "-itemPrice",
    "availability" => 1
  );
  $query = http_build_query($params);
  $request = RAKUTEN_ITEM_SEARCH_API . '?' . $query;

  // API呼び出し
  $response = file_get_contents($request);
  $result = json_decode($response);

  return $result;
}