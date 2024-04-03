<?php
// File for connecting to the database and executing queries

// Підключення до бази даних
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = null;
    $dbname = "business_card";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Перевірка підключення
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Виконання запиту до бази даних
function executeQuery($sql) {
    $conn = connectDB();

    // Виконання запиту
    $result = $conn->query($sql);

    // Закриття з'єднання з базою даних
    $conn->close();

    return $result;
}
?>
