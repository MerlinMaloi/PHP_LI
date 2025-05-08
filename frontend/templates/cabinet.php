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
    <title>Кабинет пользователя</title>
</head>
<body>
    <h1>Добро пожаловать в ваш кабинет, <?= $_SESSION['user_email'] ?>!</h1>
    <p>Здесь вы можете редактировать свои данные и управлять ресурсами.</p>
    <a href="home.php">На главную</a><br>
    <a href="../backend/auth/logout.php">Выйти</a>
</body>
</html>

