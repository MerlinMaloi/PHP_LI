<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
</head>
<body>
    <h1>Добро пожаловать на главную страницу, <?= $_SESSION['user_email'] ?>!</h1>
    <p>Это защищённый раздел для авторизованных пользователей.</p>
    <a href="cabinet.php">Перейти в кабинет</a><br>
    <a href="../backend/auth/logout.php">Выйти</a>
</body>
</html>
