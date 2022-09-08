<?php

    $connect = mysqli_connect('localhost', 'root', 'password', 'test');

    if (!$connect) {
        die('Error connect to DataBase');
    }