<?php 
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: LogIn-form.php");
} else {
    if ($_SESSION['role'] == "user") {
        header("Location: Home.php");
    } else {
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Dashboard-css.css?v=1.0">
</head>


<body>

<header> 
        <nav>
            <div class="logo">
                <img src="logo3.png" alt="#">
                <a> Tech Connect </a>
            </div>

            <div class="button">
                <a href="Home.php"><button type="button">Home</button></a>
                <a href="About us.html"><button type="button">About Us</button></a>
                <a href="Job-listing.html"><button type="button">Jobs</button></a>
                <a href="ContactUs.html"><button type="button">Contact Us</button></a>
                <button type="button">Profile</button>
            </div>
        </nav>
    </header>

    <table>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>SURNAME</th>
            <th>EMAIL</th>
            <th>USERNAME</th>
            <th>PASSWORD</th>
            <th>ROLE</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php
        include_once 'userRepository.php';
        $userRepository = new UserRepository();
        $users = $userRepository->getAllUsers();

        foreach($users as $user){
            echo 
            "
            <tr>
                <td>$user[id]</td> 
                <td>$user[name]</td> 
                <td>$user[surname]</td> 
                <td>$user[email]</td> 
                <td>$user[username]</td> 
                <td>$user[password]</td> 
                <td>{$user['role']}</td>
                <td><a href='Edit.php?id=$user[id]'>Edit</a></td> 
                <td><a href='Delete.php?id=$user[id]'>Delete</a></td> 
            </tr>
            ";
        }
        ?>
        </table>

        <!-- footer -->
</body>

<footer>
    <div class="footer">
        <p>&copy; 2024 Tech Connect | All Rights Reserved</p>
        <p>We are here to help you find the best opportunities in the tech industry.</p>
        <ul class="links">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
</footer>
</html>
<?php
    }
}

?>