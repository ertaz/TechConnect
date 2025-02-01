<?php
session_start();

// Ensure that the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: LogIn-form.php");
    exit;
}

// Check the user role and control the visibility of the dashboard button
$showDashboardButton = ($_SESSION['role'] === 'admin');  // Only show if user is admin
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekti1</title>
    <link rel="stylesheet" href="Home.css">
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
                <a href="Job-listing.php"><button type="button">Jobs</button></a>
                <a href="ContactUs.html"><button type="button">Contact Us</button></a>
                <button type="button">Profile</button>
                <!-- Only show the Dashboard button if the user is an admin -->
                <?php if ($showDashboardButton): ?>
                    <a href="Dashboard.php"><button type="button">Dashboard</button></a>
                <?php endif; ?>
                <a href="Logout.php"><button type="button">Sign Out</button></a>
            </div>
            
        </nav>
    </header>

        <div class="background">
            <section class="main-selection">
                <div class="content">
                    <div class="details">
                        <h2 class="title">Looking for a job?</h2>
                        <h3 class="subtitle">Let us help you find your way through the tech industry</h3>
                        <p class="description">Welcome </p>
                        <a href="LogIn-form.php"><button type="button">Get Started</button></a> 
                    </div>
                </div>
            </section>
        </div> 
    
        <section class="more-content">
            <div class="more-box box1">
                <div class="box1">
                    <h2>Start Your Career Journey Today!</h2>
                    <img class="imgg" src="img11.jpg" alt="">
                    <p>Explore our wide range of opportunities in the tech industry. Whether you are just starting out or looking for your next big role, we are here to help!</p>
                    <button type="button">Learn More</button>
                </div>
            </div>
            <div class="more-box box2">
                <div class="box2">
                    <h2>Join Our Tech Community</h2>
                    <img class="imgg" src="img22.webp" alt="">
                    <p>Be part of a growing network of tech professionals. Connect, collaborate, and thrive together in the world of technology.</p>
                    <button type="button">Join Us</button>
                </div>
            </div>
        </section>

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