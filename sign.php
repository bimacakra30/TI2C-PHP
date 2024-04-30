<?php
session_start();

include("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['register'])) {
        $user_name = $_POST['nm'];
        $address = $_POST['addrs'];
        $birthday = $_POST['bod'];
        $contact = $_POST['cnumber'];
        $email = $_POST['mail'];
        $password = $_POST['pass'];

        if (!empty($email) && !empty($password) && !is_numeric($email)) {
            mysqli_select_db($dbconnect, "db_bara");

            $query = "INSERT INTO form (nm, addrs, bod, cnumber, mail, pass) VALUES ('$user_name', '$address', '$birthday', '$contact', '$email', '$password')";
            mysqli_query($dbconnect, $query);

            echo "<script type='text/javascript'> alert('Successfully Register')</script>";
        } else {
            echo "<script type='text/javascript'> alert('Please Enter some Valid Information')</script>";
        }
    }
    if (isset($_POST['login'])) {
        $email = $_POST['mail'];
        $password = $_POST['pass'];

        if (!empty($email) && !empty($password) && !is_numeric($email)) {
            mysqli_select_db($dbconnect, "db_bara");

            $query = "SELECT * FROM form WHERE mail = '$email' LIMIT 1";
            $result = mysqli_query($dbconnect, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['pass'] == $password) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_name'] = $user_data['nm'];
                    $_SESSION['user_email'] = $email;
                    header("Location: index.php");
                    exit;
                } else {
                    echo "<script type='text/javascript'> alert('Incorrect password.')</script>";
                }
            } else {
                echo "<script type='text/javascript'> alert('Email not found.')</script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('Please enter valid information.')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="https://accounts.google.com/ServiceLogin?service=accountsettings&continue=https://myaccount.google.com%3Futm_source%3Daccount-marketing-page%26utm_medium%3Dgo-to-account-button" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="https://www.facebook.com/login/?next=https%3A%2F%2Fwww.facebook.com%2F" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://github.com/login" class="icon"><i class="fa-brands fa-github"></i></a>
                </div>
                <input type="text" name="nm" placeholder="Name">
                <input type="text" name="addrs" placeholder="Address">
                <input type="date" name="bod" placeholder="Date Of Birth">
                <input type="tel" name="cnumber" placeholder="Contact Number">
                <input type="email" name="mail" placeholder="Email">
                <input type="password" name="pass" placeholder="Password" id="signupPassword">
                <span class="toggle-password" onclick="togglePassword('signupPassword')">Show Password</span>
                <button name="register">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="https://accounts.google.com/ServiceLogin?service=accountsettings&continue=https://myaccount.google.com%3Futm_source%3Daccount-marketing-page%26utm_medium%3Dgo-to-account-button" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="https://www.facebook.com/login/?next=https%3A%2F%2Fwww.facebook.com%2F" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://github.com/login" class="icon"><i class="fa-brands fa-github"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" name="mail" placeholder="Email">
                <input type="password" name="pass" placeholder="Password" id="signinPassword">
                <span class="toggle-password" onclick="togglePassword('signinPassword')">Show Password</span>
                <a href="#">Forget Your Password?</a>
                <button name="login">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>