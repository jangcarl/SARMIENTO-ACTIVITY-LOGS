<?php
require_once 'core/models.php';
require_once 'core/handleForms.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            border: 2px solid #0077B6;
            border-radius: 15px;
            background-color: #CAF0F8;
            margin: 20px;
            padding: 20px;
            text-align: center;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        input[type="text"], input[type="password"] {
            background-color: #F9FAFB;
            color: #0077B6;
            border: 1px solid #B0BEC5;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }

        .message {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .message.success {
            color: white;
            background-color: #0077B6;
        }

        .message.error {
            color: white;
            background-color: #D00000;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0077B6;
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        a.button:hover {
            background-color: #0096C7;
            transform: scale(1.05);
        }

        a.button:active {
            background-color: #005F73;
            transform: scale(0.98);
        }
    </style>
</head>

<body>
    <div class="outerMain">
        <div class="main">
            <div class="innerMain">
                <h1>Register</h1>
                <?php
                if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
                    $class = $_SESSION['status'] == "200" ? "success" : "error";
                    echo "<p class='message $class'>{$_SESSION['message']}</p>";
                }
                unset($_SESSION['message']);
                unset($_SESSION['status']);
                ?>
                <div class="mainForm">
                    <form action="core/handleForms.php" method="POST">
                        <p>
                            <label for="username">Username</label>
                            <input type="text" name="username" required>
                        </p>
                        <p>
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" required>
                        </p>
                        <p>
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" required>
                        </p>
                        <p>
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </p>
                        <p>
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" required>
                        </p>
                        <p style="text-align: center;">
                            <input type="submit" name="insertNewUserAccBtn" value="Register" class="submit-button">
                        </p>
                    </form>
                </div>
                <p style="margin-top: 30px;">Already have an account? Log in <a href="login.php">here</a>.</p>
            </div>
        </div>
    </div>
</body>

</html>
