<?php
//GET送信が行われているか判定
if (isset($_GET['no'])) {
    //数値かどうか判定
    if (ctype_digit($_GET['no'])) {
        $no = (int)$_GET['no'];
        if (($no % 3) == 0) {
            echo '3の倍数です！！';
        } else {
            echo '3の倍数ではありません。';
        }
    } else {
        echo '数字列ではありません。';
    }
} else {
    echo '数字が送られていません。';
}