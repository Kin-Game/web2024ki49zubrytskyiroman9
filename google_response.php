<?php
include_once 'config.php';
include_once 'db.php';
include_once 'functions.php';

// Отримання даних відповіді від Google
$google_response = file_get_contents('php://input');

// Розшифрування відповіді та перевірка на валідність
$decoded_response = json_decode($google_response, true);

if(isset($decoded_response['sub'])) {
    // Отримання інформації про користувача з відповіді Google
    $google_id = $decoded_response['sub'];
    $email = $decoded_response['email'];
    $name = $decoded_response['name'];

    // Перевірка, чи існує користувач з таким Google ID в базі даних
    $user = get_user_by_google_id($conn, $google_id);

    // Якщо користувач не знайдений, реєстрація
    if(!$user) {
        $user_id = register_user($conn, $google_id, $email, $name, ''); // За Google-авторизацією пароль не потрібен
    } else {
        $user_id = $user['id'];
    }

    // Збереження ім'я користувача у сесії
    session_start();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['google_user_name'] = $name; // Збереження імені користувача з Google у сесії

    // Перенаправлення на головну сторінку
    header('Location: index.php');
    exit;
} else {
    // Відповідь від Google не містить необхідних даних, повідомлення про помилку
    echo "Google authentication failed";
}
?>
