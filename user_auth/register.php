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
        <link rel="stylesheet" href="../styles/register.css">
        <title>Регистрация</title>
    </head>
    <body>
        <main>
            <div class="circle"></div>
            <div class="register-form-container">
                <h1 class="form-title">
                    Регистрация
                </h1>
                <form class="form-fields" method="POST" action="signup.php">
                    <div class="form-field">
                        <input type="text" name="username" id="username" placeholder="Имя*" required>
                    </div>
                    <div class="form-field">
                        <input type="text" name="email" id="email" placeholder="Почта*" required>
                    </div>
                    <div class="form-field">
                        <input type="tel" name="phone" id="phone" placeholder="Телефон*" required>
                    </div>
                    <div class="form-field">
                        <input type="text" name="address" id="address" placeholder="Адрес*" required>
                    </div>
                    <div class="form-field">
                        <input type="password" name="password" id="password" placeholder="Пароль*" required>
                    </div>
                    <div class="form-field">
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Подтвердите пароль*" required>
                    </div>
                    <div class="form-buttons">
                        <button class="button" type="submit" name="submit">Регистрация</button>
                        <div class="divider">или</div>
                        <a href="login.php" target="_self" class="button button-login">Войти</a>
                    </div>
                </form>
                <?php
                    if ($_SESSION['message']) {
                        echo '<div class="button" style="background: red; opacity: 0.7; margin-top: 20px; line-height: 35px;"> ' . $_SESSION['message'] . ' </div>';
                    }
                    if ($_SESSION['message_success']) {
                        echo '<div class="button" style="background: green; opacity: 0.7; margin-top: 20px; line-height: 35px;"> ' . $_SESSION['message_success'] . ' </div>';
                    }
                    unset($_SESSION['message']);
                    unset($_SESSION['message_success']);
                ?>
            </div>
        </main>
    </body>
</html>