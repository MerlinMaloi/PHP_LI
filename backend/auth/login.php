<?php
session_start();
require_once('../config/db.php'); // Подключаем конфигурацию и БД

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Проверка на наличие пользователя в базе данных
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Успешная аутентификация
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        header('Location: ../frontend/templates/home.php');
        exit();
    } else {
        // Ошибка аутентификации
        $_SESSION['error'] = 'Неверный логин или пароль';
        header('Location: ../frontend/templates/login.php');
        exit();
    }
}
