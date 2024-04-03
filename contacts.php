<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Contacts</title>
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
        <h1>My Contacts</h1>
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
        <!-- Контактна інформація -->
        <section id="contacts">
            <h2>Contact Information</h2>
            <table>
                <tr>
                    <th>Contact Method</th>
                    <th>Contact Info</th>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><a href="mailto:roman.zubrytskyi.ki.2020@lpnu.ua">roman.zubrytskyi.ki.2020@lpnu.ua</a></td>
                </tr>
                <tr>
                    <td>Telegram:</td>
                    <td><a href="https://t.me/shyrokyi123">https://t.me/shyrokyi123</a></td>
                </tr>
                <tr>
                    <td>GitHub:</td>
                    <td><a href="https://github.com/Kin-Game">https://github.com/Kin-Game</a></td>
                </tr>
            </table>
        </section>

        <!-- Форма для відправлення повідомлення -->
        <section id="message-form">
            <h2 style="text-align: center;">Send a Message</h2>
            <form action="submit_message.php" method="post" class="message-form">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                </div>
                
                <button type="submit" class="btn">Send</button>
            </form>
        </section>

        <!-- Посилання на головну сторінку -->
        <a href="index.php" class="btn">Back to Home</a>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var form = document.querySelector(".message-form");

        form.addEventListener("submit", function (event) {
            event.preventDefault(); 

            var formData = new FormData(form); 

            // Відправляємо POST запит з даними форми на сервер
            fetch(form.action, {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.text(); 
                }
                throw new Error("Network response was not ok.");
            })
            .then(data => {
                alert("Message sent successfully"); 
                window.location.href = "contacts.php"; 
            })
            .catch(error => {
                console.error("There was an error!", error);
            });
        });
    });
    </script>

    <footer>
        <p>&copy; 2024 My Business Card</p>
    </footer>
</body>
</html>
