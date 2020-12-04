<?php


    phpinfo();
    $link = mysqli_connect('db-host','root','root','database');

    if(mysqli_connect_errno()){
        die("DB erroe");
    } else {
        echo "Success";
    }

