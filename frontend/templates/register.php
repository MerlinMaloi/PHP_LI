<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация</h1>
    <form action="../backend/auth/register.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="confirm_password">Подтвердите пароль:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>

        <button type="submit">Зарегистрироваться</button>
    </form>
    <p>Есть аккаунт? <a href="login.php">Войдите</a></p>
</body>
</html>
