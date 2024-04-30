<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: sign.php");
    exit;
}

include("config.php");

mysqli_select_db($dbconnect, "db_bara");
$email = $_SESSION['user_email'];
$query = "SELECT * FROM form WHERE mail = '$email'";
$result = mysqli_query($dbconnect, $query);

if ($result) {
    $user_data = mysqli_fetch_assoc($result);
    $user_name = $user_data['nm'];
    $address = $user_data['addrs'];
    $birthday = $user_data['bod'];
    $contact = $user_data['cnumber'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexStyle.css">
    <title>About | Your information</title>
</head>

<body>
    <div class="container">
        <div class="glass-container">
            <nav class="navbar">
                <div class="logo"><a href="index.php">Home</div>
                <ul class="nav-links">
                    <li class="nav-link"><a href="#">About</a></li>
                    <li class="nav-link"><a href="#">Youtube</a></li>
                    <li class="nav-link"><a href="#">More</a></li>
                </ul>
            </nav>
            <div class="content">
                <div class="main">
                    <h1>Below is complete information about your account</h1>
                    <li><strong>Name:</strong> <?= $user_name ?></li>
                    <li><strong>Email:</strong> <?= $email ?></li>
                    <li><strong>Address:</strong> <?= $address ?></li>
                    <li><strong>Date of Birth:</strong> <?= $birthday ?></li>
                    <li><strong>Contact Number:</strong> <?= $contact ?></li>
                </div>
                <div class="image-wrapper">
                    <img src="image.png">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
} else {
    echo "Failed to fetch user data.";
}
?>