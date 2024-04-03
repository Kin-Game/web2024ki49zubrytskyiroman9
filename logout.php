<?php
// Підключення до файлу конфігурації та функцій
include_once 'config.php';
include_once 'functions.php';

// Запускаємо сесію
session_start();

// Видаляємо всі дані сесії
session_unset();

// Завершуємо сесію
session_destroy();

// Перенаправляємо користувача на головну сторінку
header('Location: index.php');
exit;
?>
