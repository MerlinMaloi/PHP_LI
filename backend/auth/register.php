<?php
session_start();
require_once('../config/db.php'); // Подключаем конфигурацию и БД

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Проверка на совпадение паролей
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Пароли не совпадают';
        header('Location: ../frontend/templates/register.php');
        exit();
    }

    // Проверка, существует ли уже такой email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = 'Этот email уже занят';
        header('Location: ../frontend/templates/register.php');
        exit();
    }

    // Хеширование пароля
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Запись нового пользователя в базу данных
    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    $stmt->execute([
        'email' => $email,
        'password' => $hashed_password
    ]);

    $_SESSION['success'] = 'Регистрация успешна! Пожалуйста, войдите.';
    header('Location: ../frontend/templates/login.php');
    exit();
}
