<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: sign.php");
    exit;
}

$user_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexStyle.css">
    <title>Welcome | BaraTech Company</title>
</head>

<body>
    <div class="container">
        <div class="glass-container">
            <nav class="navbar">
                <div class="logo">BaraTech Company</a></div>
                <ul class="nav-links">
                    <li class="nav-link"><a href="#">About</a></li>
                    <li class="nav-link"><a href="#">Youtube</a></li>
                    <li class="nav-link"><a href="#">More</a></li>
                </ul>
            </nav>
            <div class="content">
                <div class="main">
                    <h2>Hey! 👋,<br><?= $user_name ?></h2>
                    <p>
                        All information contained herein is confidential. <br>
                        Using end to end encryption
                    </p>
                    <button onclick="location.href='about.php';">Get Started</button>
                </div>
                <div class="image-wrapper">
                    <img src="image.png">
                </div>
            </div>
        </div>
    </div>

</body>

</html>