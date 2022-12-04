<?php
    session_start();
    require_once '../db_connection/connection.php';

    $username = $_POST['username'];
    $password = md5(md5(trim($_POST['password'])));

    $check_user = mysqli_query($conn, "SELECT * FROM `User` WHERE `username` = '$username' AND `password` = '$password'");
    if (mysqli_num_rows($check_user) > 0) {
        $user = mysqli_fetch_assoc($check_user);
        
        $_SESSION['user'] = [
            "idUser" => $user['idUser']
        ];

        header('Location: ../index.php');
    } else {
        $_SESSION['message_fail'] = 'Не верный логин или пароль';
        header('Location: login.php');
    }
?>