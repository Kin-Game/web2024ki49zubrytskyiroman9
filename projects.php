<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Projects</title>
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
            margin-right: 10px;
        }
        .username {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>My Projects</h1>
        <!-- Додані кнопки реєстрації, входу та виходу у хедер -->
        <div class="auth-buttons">
            <?php
            session_start();
            if(isset($_SESSION['user_id'])) {
                echo '<p class="username">Welcome, ' . (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User') . '</p>';
                echo '<a href="logout.php" class="btn">Logout</a>';
            } else {
                echo '<a href="register.php" class="btn">Register</a>';
                echo '<a href="login.php" class="btn">Login</a>';
            }
            ?>
        </div>
    </header>
    
    <div class="container">
        <!-- Таблиця з інформацією про проекти -->
        <section id="projects">
            <h2>Projects</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Year</th>
                </tr>
                <tr>
                    <td>System monitoring program</td>
                    <td>Development of a program for monitoring PC system resources, Python</td>
                    <td>2023</td>
                </tr>
                <tr>
                    <td>Mediaplayer</td>
                    <td>Development of a media player for Windows in which you can view and edit media files, Python</td>
                    <td>2023</td>
                </tr>
            </table>
        </section>

        <!-- Посилання на головну сторінку -->
        <a href="index.php" class="btn">Back to Home</a>
    </div>

    <footer>
        <p>&copy; 2024 My Business Card</p>
    </footer>
</body>
</html>
