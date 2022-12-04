<?php

    session_start();
    require_once '../db_connection/connection.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if(isset($_POST['submit'])) {
        $err = array();

        if(strlen($_POST['username']) < 3 or strlen($_POST['username']) > 30) {
            $err[] = "Слишком короткий логин!";
            $_SESSION['message'] = 'Слишком короткий логин!';
            header('Location: register.php');
        }

        if(strlen($_POST['password']) < 3 or strlen($_POST['password']) > 30) {
            $err[] = "Слишком короткий пароль!";
            $_SESSION['message'] = 'Слишком короткий пароль!';
            header('Location: register.php');
        }

        if($_POST['password'] !== $_POST['confirm_password']) {
            $err[] = "Пароли не совпадают!";
            $_SESSION['message'] = 'Пароли не совпадают!';
            header('Location: register.php');
        }

        $check_user = mysqli_query($conn, "SELECT * FROM `User` WHERE `username` = '$username'");

        if(mysqli_num_rows($check_user) > 0) {
            $err[] = "Этот логин уже занят!";
            $_SESSION['message'] = 'Этот логин уже занят!';
            header('Location: register.php');
        }

        if(count($err) == 0) {
            $password = md5(md5(trim($_POST['password'])));

            $query = "INSERT INTO `User` (`username`, `email`, `password`, `phone`, `address`) VALUES ('$username', '$email', '$password', '$phone', '$address')";
            mysqli_query($conn, $query);

            $_SESSION['message_success'] = 'Регистрация прошла успешно!';
            header('Location: login.php');
        }
    }
?>