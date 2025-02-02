<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: LogIn-form.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="Profile.css?v=1.0">
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
            <a href="About us.php"><button type="button">About Us</button></a>
            <button type="button">Jobs</button>
            <a href="ContactUs.php"><button type="button">Contact Us</button></a>
            
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<button id="logoutBtn" type="button">Log Out</button>';
            } else {
                echo '<a href="LogIn-form.php"><button type="button">Log In</button></a>';
            }
            ?>
        </div>
    </nav>
</header>

<div class="container">
    <div class="profile-pic">
        <img src="<?php echo isset($_SESSION['profile_picture']) ? htmlspecialchars($_SESSION['profile_picture']) : 'default-profile.jpg'; ?>" alt="Profile Picture" id="profile-picture">
    </div>

    <div class="about-me">
        <h2>About Me</h2>
        <li><?php echo htmlspecialchars($_SESSION['about_me']); ?></li>
    </div>

    <div class="details">
        <h2>Details</h2>
        <ul>
            <li><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['name']) . " " . htmlspecialchars($_SESSION['surname']); ?></li>
            <li><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></li>
            <li><strong>Age:</strong> <?php echo htmlspecialchars($_SESSION['age']); ?></li>
            <li><strong>Location:</strong> <?php echo htmlspecialchars($_SESSION['location']); ?></li>
        </ul>

        <div class="social-media">
            <?php if (isset($_SESSION['facebook']) && $_SESSION['facebook']) { ?>
                <a href="<?php echo htmlspecialchars($_SESSION['facebook']); ?>"><img src="facebook1.png" alt="Facebook"></a>
            <?php } ?>
            <?php if (isset($_SESSION['instagram']) && $_SESSION['instagram']) { ?>
                <a href="<?php echo htmlspecialchars($_SESSION['instagram']); ?>"><img src="instagram1.png" alt="Instagram"></a>
            <?php } ?>
            <?php if (isset($_SESSION['linkedin']) && $_SESSION['linkedin']) { ?>
                <a href="<?php echo htmlspecialchars($_SESSION['linkedin']); ?>"><img src="linkedin1.png" alt="LinkedIn"></a>
            <?php } ?>
            <?php if (isset($_SESSION['other_social']) && $_SESSION['other_social']) { ?>
                <a href="<?php echo htmlspecialchars($_SESSION['other_social']); ?>"><img src="social-icon.png" alt="Other Social"></a>
            <?php } ?>
        </div>
    </div>
</div>

<footer>
    <div class="footer">
        <p>&copy; 2024 Tech Connect | All Rights Reserved</p>
        <p>We are here to help you find the best opportunities in the tech industry.</p>
    </div>
</footer>

<div id="logoutModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h2>Are you sure you want to log out?</h2>
        <button id="confirmLogout">Log Out</button>
        <button id="cancelLogout">Cancel</button>
    </div>
</div>

<script>
    const logoutBtn = document.getElementById('logoutBtn');
    const logoutModal = document.getElementById('logoutModal');
    const confirmLogout = document.getElementById('confirmLogout');
    const cancelLogout = document.getElementById('cancelLogout');

    logoutModal.style.display = "none";

    logoutBtn.addEventListener('click', function() {
        logoutModal.style.display = "flex";
    });

    confirmLogout.addEventListener('click', function() {
        window.location.href = "logout.php";
    });

    cancelLogout.addEventListener('click', function() {
        logoutModal.style.display = "none";
    });
</script>

</body>
</html>
