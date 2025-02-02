<?php

session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: LogIn-form.php");
    exit;
}



require_once 'Database.php';

$db = new Database();
$conn = $db->getConnection();

// Get the search term from the GET request
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the query to fetch job listings (add WHERE clause for search)
$query = "SELECT company_name, job_title, location, time_posted, job_type, applicants, division, salary, company_logo_path FROM job_listings";

if ($searchTerm) {
    $query .= " WHERE job_title LIKE :searchTerm OR company_name LIKE :searchTerm";
}

$stmt = $conn->prepare($query);

if ($searchTerm) {
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
}

$stmt->execute();
$jobLists = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="Job-listing-css.css?v=<?php echo time(); ?>">
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
                <a href="profile.php"><button type="button">Profile</button></a>
            </div>
        </nav>
    </header>

    <div class="main">
        <div class="main-header">
            <ion-icon class="menu-bar" name="menu-outline"></ion-icon>
            <div class="search">
                <form method="get" action="Job-listing.php">
                    <input type="text" name="search" placeholder="Search your best job here..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                </form>
            </div>
        </div>

        <div class="filter-wrapper">
            <p>Recommendations</p>
            <div class="filter">
                <button class="btn-filter">Software Engineer</button>
                <button class="btn-filter">Data Analyst</button>
                <button class="btn-filter">Full Stack Developer</button>
                <button class="btn-filter">Front-end Developer</button>
            </div>
        </div>

        <div class="wrapper">
            <?php foreach ($jobLists as $job): ?>
                <div class="card">
                    <div class="card-left">
                        <img src="<?php echo $job['company_logo_path']; ?>" alt="Company Logo">
                    </div>
                    <div class="card-center">
                        <h3><?php echo $job['company_name']; ?></h3>
                        <p class="card-detail"><?php echo $job['job_title']; ?></p>
                        <p class="card-loc"><ion-icon name="location-outline"></ion-icon><?php echo $job['location']; ?></p>
                        <div class="card-sub">
                            <p><ion-icon name="today-outline"></ion-icon> <?php echo $job['time_posted']; ?></p>
                            <p><ion-icon name="hourglass-outline"></ion-icon> <?php echo $job['job_type']; ?></p>
                            <p><ion-icon name="people-outline"></ion-icon> <?php echo $job['applicants']; ?> Applicants</p>
                        </div>
                    </div>
                    <div class="card-right">
                        <div class="card-tag">
                            <h5>Division</h5>
                            <a href="#"><?php echo $job['division']; ?></a>
                        </div>
                        <div class="card-salary">
                            <p><b><?php echo $job['salary']; ?></b> <span>/ year</span></p>
                        </div>
                    </div>
                    <button class="apply-now-btn">Apply Now</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

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
