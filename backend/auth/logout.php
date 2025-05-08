<?php
session_start();

// Уничтожаем сессию
session_unset();
session_destroy();

// Перенаправляем на страницу входа
header('Location: ../frontend/templates/login.php');
exit();
