<?php
session_start();

include_once 'Database.php';
include_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a new User object and try to log in
    $db = new Database();
    $connection = $db->getConnection();
    $user = new User($connection);

    // If the user exists and password is correct
    if ($user->login($email, $password)) {
        // If login is successful, start the session and redirect to Home.php
        $_SESSION['email'] = $email;
        header("Location: Home.php");
        exit;
    } else {
        // If login fails, show an error message
        $error_message = "Invalid email or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn-Form</title>
    <link rel="stylesheet" href="Login-form-css.css?v=1.0">

</head>
<body>

    <div class="login-container">
       
        <div class="login-box">
            <div class="login-text">
                <h2>Login</h2>
            </div>
            <form action="LogIn-form.php" method="POST">
            <div class="input-box">
            <input type="text" id="userid" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
            <input type="password" id="passwordid" name="password" placeholder="Password" required>
            </div>

            <div class="remember-me">
                <input type="checkbox">Remeber me
            </div>
            <br>

            <button id="submit-btn">Log In</button>

        </form>

            <div class="signup-link">
                <p>Don't have an account? <a href="SignUp-form.php">Sign up</a></p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const BtnSubmit=document.getElementById('submit-btn');
            BtnSubmit.addEventListener('click', validate);

            function validate(ngjarja) {
                ngjarja.preventDefault();

                const user=document.getElementById('userid');
                const password=document.getElementById('passwordid');
                if(user.value == ""){
                    alert("Ju lutem shtypni një username!"); user.focus();
                    return false;
                }
                if(password.value == ""){
                    alert("Ju lutem shtypni një password!"); password.focus();
                    return false;
                }
                this.form.submit();
            }
        });
    </script>    
</body>
</html>