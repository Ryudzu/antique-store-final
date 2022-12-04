<?php
    session_start();
    if($_SESSION['user']) {
        header('Location: ../index.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../styles/login.css">
        <title>Логин</title>
    </head>
    <body>
        <main>
            <div class="circle"></div>
            <div class="register-form-container">
                <h1 class="form-title">
                    Логин
                </h1>
                <form class="form-fields" method="post" action="signin.php">
                    <div class="form-field">
                        <input type="text" name="username" id="username" placeholder="Имя*" required>
                    </div>
                    <div class="form-field">
                        <input type="password" name="password" id="password" placeholder="Пароль*" required>
                    </div>
                    <div class="form-buttons">
                        <button class="button" type="submit">Войти</button>
                        <div class="divider">или</div>
                        <a href="register.php" target="_self" class="button button-login">Регистрация</a>
                    </div>
                    <?php
                        if ($_SESSION['message_success']) {
                            echo '<div class="button" style="background: green; opacity: 0.7; margin-top: 20px; line-height: 35px;"> ' . $_SESSION['message_success'] . ' </div>';
                        }
                        if ($_SESSION['message_fail']) {
                            echo '<div class="button" style="background: red; opacity: 0.7; margin-top: 20px; line-height: 35px;"> ' . $_SESSION['message_fail'] . ' </div>';
                        }
                        unset($_SESSION['message_success']);
                        unset($_SESSION['message_fail']);
                    ?>
                </form>
            </div>
        </main>
    </body>
</html>