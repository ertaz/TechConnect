<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Dashboard-css.css">
</head>
<body>
<header> 
        <nav>
            <div class="logo">
                <img src="logo3.png" alt="#">
                <a> Tech Connect </a>
            </div>

            <div class="button">
                <a href="Home.html"><button type="button">Home</button></a>
                <a href="About us.html"><button type="button">About Us</button></a>
                <button type="button">Jobs</button>
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
                <td>$user[Id]</td> 
                <td>$user[Name]</td> 
                <td>$user[Surname]</td> 
                <td>$user[Email]</td> 
                <td>$user[Username]</td> 
                <td>$user[Password]</td> 
                <td><a href='edit.php?id=$user[Id]'>Edit</a></td> 
                <td><a href='delete.php?id=$user[Id]'>Delete</a></td> 
            </tr>
            ";
        }
        ?>
        </table>

        <!-- footer -->
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
</body>
</html>