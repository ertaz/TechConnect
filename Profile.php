<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: LogIn-form.php');
    exit();
}

include_once 'Database.php';
include_once 'User.php';

$db = new Database();
$connection = $db->getConnection();
$user = new User($connection);


$userDetails = $user->getUserDataByEmail($_SESSION['email']);

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
            <a href="About_us.php"><button type="button">About Us</button></a>
            <a href="Job-listing.php"><button type="button">Jobs</button></a>
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
        <img src="<?php echo isset($userDetails['profile_picture']) && $userDetails['profile_picture'] ? htmlspecialchars($userDetails['profile_picture']) : 'default-profile.jpg'; ?>" alt="Profile Picture" id="profile-picture">
    </div>

    <div class="about-me">
        <h2>About Me</h2>
        <p><?php echo isset($userDetails['about_me']) ? htmlspecialchars($userDetails['about_me']) : 'No information available'; ?></p>
    </div>

    <div class="details">
        <h2>Details</h2>
        <ul>
            <li><strong>Name:</strong> <?php echo htmlspecialchars($userDetails['name']) . " " . htmlspecialchars($userDetails['surname']); ?></li>
            <li><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></li>
            <li><strong>Age:</strong> <?php echo htmlspecialchars($userDetails['age']); ?></li>
            <li><strong>Location:</strong> <?php echo htmlspecialchars($userDetails['location']); ?></li>
        </ul>

        <div class="social-media">
            <?php if (isset($userDetails['facebook']) && $userDetails['facebook']) { ?>
                <a href="<?php echo htmlspecialchars($userDetails['facebook']); ?>"><img src="facebook1.png" alt="Facebook"></a>
            <?php } ?>
            <?php if (isset($userDetails['instagram']) && $userDetails['instagram']) { ?>
                <a href="<?php echo htmlspecialchars($userDetails['instagram']); ?>"><img src="instagram1.png" alt="Instagram"></a>
            <?php } ?>
            <?php if (isset($userDetails['linkedin']) && $userDetails['linkedin']) { ?>
                <a href="<?php echo htmlspecialchars($userDetails['linkedin']); ?>"><img src="linkedin1.png" alt="LinkedIn"></a>
            <?php } ?>
            <?php if (isset($userDetails['other_social']) && $userDetails['other_social']) { ?>
                <a href="<?php echo htmlspecialchars($userDetails['other_social']); ?>"><img src="social-icon.png" alt="Other Social"></a>
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
