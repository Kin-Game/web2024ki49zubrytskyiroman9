<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Education</title>
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
        <h1>My Education</h1>
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
        <!-- Таблиця з інформацією про освіту -->
        <section id="education">
            <h2>Education</h2>
            <table>
                <tr>
                    <th>Degree</th>
                    <th>Institution</th>
                    <th>Study specialty</th>
                    <th>Duration</th>
                </tr>
                <tr>
                    <td>Lyceum student</td>
                    <td>Drohobych Lyceum of the Drohobych City Council</td>
                    <td>Information technologies</td>
                    <td>2018-2020</td>
                </tr>
                <tr>
                    <td>Bachelor</td>
                    <td>Lviv Polytechnic National University</td>
                    <td>Computer engineering</td>
                    <td>2020-2024(present)</td>
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
