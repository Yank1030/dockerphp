<?php

function shownum($lists, callable $method)
{
    return $method($lists);
}

# クラスの定義
class Sample
{
    function showall($lists)
    {
        foreach ($lists as $list) {
            echo $list;
        }
    }

    function cultwice($lists)
    {
        array_map(function ($list) {
            echo $list * 2;
        }, $lists);
    }

    function filter($lists)
    {
        array_filter($lists, function ($list) {
            echo $list % 2 === 1;
        });
    }

    function reduce($lists)
    {
        array_reduce($lists, function ($num, $list) {
            echo $num * $list;
        }, 100);
    }
}

$numberlist = range(1, 10);

#メソッドをコールバック関数として渡す。
$obj = new Sample();
shownum($numberlist, array($obj, 'showall'));
echo "\n";
shownum($numberlist, array($obj, 'cultwice'));
echo "\n";
shownum($numberlist, array($obj, 'filter'));
echo "\n";
shownum($numberlist, array($obj, 'reduce'));