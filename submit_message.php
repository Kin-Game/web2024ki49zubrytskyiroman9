<?php
// Підключення до бази даних
$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Отримання даних з форми
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Занесення даних у базу даних
$sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Message sent successfully"); window.location.href = "contacts.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
