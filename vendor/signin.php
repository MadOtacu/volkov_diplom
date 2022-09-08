<?php

    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $password = $_POST['password'];

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);
        if($user['login'] == "admin")
        {
            $_SESSION['user'] = [
                "id" => $user['id'],
                "full_name" => $user['full_name'],
                "avatar" => $user['avatar'],
                "email" => $user['email'],
                "login" => $user['login'],
                "password" => $user['password'],
            ];
    
            header('Location: ../adminpanel.php');
        }
        else
        {
            $_SESSION['user'] = [
                "id" => $user['id'],
                "full_name" => $user['full_name'],
                "avatar" => $user['avatar'],
                "email" => $user['email'],
                "login" => $user['login'],
                "password" => $user['password'],
            ];
    
            header('Location: ../profile.php');
        }

        

    } else {
        $_SESSION['message'] = 'Неверный логин или пароль';
        header('Location: ../index.php');
    }
    ?>

<pre>
    <?php
        print_r($check_user);
        print_r($user);
    ?>
</pre>
