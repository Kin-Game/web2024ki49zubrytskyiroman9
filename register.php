<?php
include_once 'config.php';
include_once 'db.php';
include_once 'functions.php';

// Підключення до бази даних
$conn = connectDB();

session_start();
if(isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($name) || empty($email) || empty($password)) {
        $error = "Please fill in all fields";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        // Перевірка, чи користувач з таким ім'ям вже існує
        $existing_user_by_name = get_user_by_username($conn, $name);
        if($existing_user_by_name) {
            $error = "User with this username already exists";
        } else {
            // Перевірка, чи користувач з таким email вже існує
            $existing_user_by_email = get_user_by_email($conn, $email);
            if($existing_user_by_email) {
                $error = "User with this email already exists";
            } else {
                // Хешування паролю перед збереженням
                $hashed_password = hashPassword($password);

                // Додавання користувача до бази даних
                $result = register_user($conn, '', $email, $name, $hashed_password);

                if($result === true) {
                    header('Location: login.php');
                    exit;
                } else {
                    $error = $result;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Registration</h1>
    </header>
    
    <div class="container">
        <section id="registration-form">
            <h2>Register New Account</h2>
            <?php if(isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn">Register</button>
            </form>
            <a href="index.php" class="btn">Back to Home</a>
            <a href="login.php" class="btn">Login</a>
            <!-- Додавання кнопки "Увійти через Google" у форму реєстрації -->
            <a href="https://accounts.google.com/o/oauth2/auth?client_id=637492123416-qmbtiqn92hes0ev3r7hvm0i3s1ejv2pa.apps.googleusercontent.com&redirect_uri=http://localhost&scope=https://www.googleapis.com/auth/userinfo.email%20https://www.googleapis.com/auth/userinfo.profile&response_type=code" class="btn">Register with Google</a>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 My Business Card</p>
    </footer>
</body>
</html>
