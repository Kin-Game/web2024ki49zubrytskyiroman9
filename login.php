<?php
// Підключення до бази даних та інших необхідних файлів
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
    // Отримання даних з форми
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Валідація даних
    if(empty($email) || empty($password)) {
        $error = "Please fill in all fields";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        // Перевірка, чи існує користувач з введеним email
        $user = get_user_by_email($conn, $email);

        // Перевірка паролю, якщо користувач знайдений
        if($user) {
            if(password_verify($password, $user['password'])) {
                // Авторизація користувача
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['username'];
                header('Location: index.php');
                exit;
            } else {
                $error = "Incorrect password";
            }
        } else {
            $error = "User not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    
    <div class="container">
        <section id="login-form">
            <h2>Login to Your Account</h2>
            <?php if(isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn">Login</button>
            </form>
            <a href="index.php" class="btn">Back to Home</a>
            <a href="register.php" class="btn">Register</a>

            <!-- Додавання кнопки "Увійти через Google" -->
            <a href="https://accounts.google.com/o/oauth2/auth?client_id=637492123416-qmbtiqn92hes0ev3r7hvm0i3s1ejv2pa.apps.googleusercontent.com&redirect_uri=http://localhost&scope=https://www.googleapis.com/auth/userinfo.email%20https://www.googleapis.com/auth/userinfo.profile&response_type=code" class="btn">Login with Google</a>
        </section>
    </div>

    <footer>
        <p>&copy; 2024 My Business Card</p>
    </footer>
</body>
</html>
