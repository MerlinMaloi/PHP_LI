<?php
session_start();

<?php

/**
 * Проверяет, есть ли у пользователя заданное право
 *
 * @param string $capability Имя проверяемого права (например, 'delete_post')
 * @return bool
 */
function can(string $capability): bool {
    global $pdo;

    if (!isset($_SESSION['user_id'])) {
        return false;
    }

    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM user_roles ur
        INNER JOIN permissions p ON ur.role_id = p.role_id
        INNER JOIN capabilities c ON p.capability_id = c.id
        WHERE ur.user_id = :user_id AND c.name = :capability
    ");

    $stmt->execute([
        'user_id' => $userId,
        'capability' => $capability
    ]);

    return $stmt->fetchColumn() > 0;
}

// Использование функции
if (!can('delete_post')) {
   // Отправляем код ответа 403 Forbidden - доступ запрещён
    header($_SERVER['SERVER_PROTOCOL']." 403 Forbidden");
    exit;
}

<?php
// Старт сессии (с поддержкой Redis)
require_once __DIR__ . '/../database/session.php';

// Подключение к базе данных
require_once __DIR__ . '/../config/db.php';

// Утилиты
require_once __DIR__ . '/../utils/validate.php';

// Пример роутинга по GET параметру "page"
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'login':
        header('Location: ../frontend/templates/login.php');
        exit;
    case 'register':
        header('Location: ../frontend/templates/register.php');
        exit;
    case 'cabinet':
        // Защищённый маршрут
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../frontend/templates/login.php');
            exit;
        }
        header('Location: ../frontend/templates/cabinet.php');
        exit;
    default:
        header('Location: ../frontend/templates/home.php');
        exit;
}
