<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="ContactUs.css">
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
                <a href="ContactUs.php"><button type="button">Contact Us</button></a>
                <button type="button">Profile</button>
            </div>
            
        </nav>
    </header>

    <main>
        <section class="contact">
            <h1 class="title">Contact Us</h1>
            <p class="subtitle">We'd love to hear from you! Please feel free to reach out with any questions or inquiries, and we'll get back to you as soon as possible.</p>

            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="icon"><img src="location2.png" alt="Address"></div>
                        <p>123 Tech Street, Tokyo, Japan</p>
                    </div>
                    <div class="contact-item">
                        <div class="icon"><img src="phone2.png" alt="Phone"></div>
                        <p>(111) 233-405</p>
                    </div>
                    <div class="contact-item">
                        <div class="icon"><img src="email2.png" alt="Email"></div>
                        <p>techconnect@gmail.com</p>
                    </div>
                </div>

                <div class="message-form">
                    <h2>Send Us a Message</h2>
                    <form action="#" method="POST">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" required>
                        
                        <label for="email">email</label>
                        <input type="email" id="email" name="email" placeholder="Your Email" required>
                        
                        <label for="message">your message</label>
                        <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                        
                        <button type="submit" name="submit">Send Message</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

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

        <?php
        include_once 'userRepository.php';

     // Check if form is submitted

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $message = isset($_POST['message']) ? $_POST['message'] : null;

    if ($name && $email && $message) {
        $userR = new UserRepository();
        $userR->messageFromContactUs($name, $email, $message);
        echo "<script>alert('Your message has been sent successfully!');</script>";
    } else {
        echo "<script>alert('Please fill in all fields before submitting.');</script>";
    }
}
?>

</html>
