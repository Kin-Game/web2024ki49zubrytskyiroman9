<?php
// File containing various functions such as data validation, password hashing, etc.

// Функція для перевірки правильності формату email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Функція для перевірки правильності формату паролю
function validatePassword($password) {
    // Перевірка, щоб пароль мав щонайменше 8 символів і містив принаймні одну цифру і одну велику літеру
    return preg_match('/^(?=.*[0-9])(?=.*[A-Z]).{8,}$/', $password);
}

// Функція для хешування паролю
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Функція для перевірки, чи співпадають введений пароль і його хеш
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

function register_user($conn, $google_id, $email, $username, $password) {
    // Підготовка SQL-запиту для вставки даних нового користувача
    $sql = "INSERT INTO users (google_id, email, username, password) VALUES (?, ?, ?, ?)";
    
    // Підготовка та виконання підготовленого запиту
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $google_id, $email, $username, $password);
    if ($stmt->execute()) {
        // Якщо додавання користувача відбулося успішно, повертаємо true
        return true;
    } else {
        // Якщо сталася помилка при виконанні SQL-запиту, виводимо повідомлення про помилку
        echo "Error: " . $sql . "<br>" . $stmt->error; // Виведено повідомлення про помилку
        return false; // Повернено false в разі помилки
    }
}


// Функція для отримання користувача за його іменем користувача
function get_user_by_username($conn, $username) {
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Повертаємо дані користувача у вигляді масиву
        return $result->fetch_assoc();
    } else {
        // Якщо користувача не знайдено, повертаємо null
        return null;
    }
}


// Функція для отримання користувача за його email
function get_user_by_email($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Повертаємо дані користувача у вигляді масиву
        return $result->fetch_assoc();
    } else {
        // Якщо користувача не знайдено, повертаємо null
        return null;
    }
}

?>
