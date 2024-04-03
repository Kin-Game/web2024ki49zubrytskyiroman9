<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Business Card</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Додані стилі для кнопок реєстрації, входу та виходу */
        .auth-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
        }
        .auth-buttons .btn {
            margin-left: 10px;
        }
        .username {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to My Business Card</h1>
    </header>
    
    <div class="container">
        <!-- Секція з інформацією про мене -->
        <section id="about-me">
            <h2>About Me</h2>
            <p>My name is Roman Zubrytskyi, I am a 4th-year student, studying at the National University of Lviv Polytechnic, majoring in computer engineering</p>
        </section>

        <!-- Кнопки для переходу на інші сторінки -->
        <div class="buttons">
            <a href="education.php" class="btn">My Education</a>
            <a href="projects.php" class="btn">My Projects</a>
            <a href="contacts.php" class="btn">My Contacts</a>
        </div>

        <!-- Додані кнопки для реєстрації, входу та виходу -->
        <div class="auth-buttons">
            <?php
            session_start();
            if(isset($_SESSION['user_id']) || isset($_SESSION['google_user_name'])) {
                echo '<p class="username">Welcome, ' . (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : (isset($_SESSION['google_user_name']) ? $_SESSION['google_user_name'] : 'User')) . '</p>';
                echo '<a href="logout.php" class="btn">Logout</a>';
            } else {
                echo '<a href="register.php" class="btn">Register</a>';
                echo '<a href="login.php" class="btn">Login</a>';
            }
            ?>
        </div>


    </div>

    <footer>
        <p>&copy; 2024 My Business Card</p>
    </footer>
</body>
</html>
