<?php
// Database connection
$servername = "localhost"; // replace with your server name
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
$dbname = "projekti"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch clients from the database
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Store results in an array
    $clients = [];
    while($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }
} else {
    $clients = [];
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="About_us-css.css?v=1.0">
    <style type="text/css">
        #kontenti {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Roboto', sans-serif;
            width: 100%;
            margin: 0 auto;
            margin-bottom: 50px auto;
            z-index: 0;
        }
        #kontenti img {
            max-width: 400px;
            height: 220px;
        }
        button {
            border-radius: 100%;
            width: 40px;
            height: 40px;
            font-size: 10pt;
            color: blue;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!--nav bar-->
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
                <a href="profile.php"><button type="button">Profile</button></a>
            </div>
        </nav>
    </header> 

    <div class="heading">
        <h1>About us</h1>
        <p>Welcome to<strong>TechConnect</strong>, the premier platform designed to connect computer science graduates with the ever-evolving tech industry. Our mission is to empower the next generation of tech professionals by providing a space where talent meets opportunity.</p>
    </div>

    <div class="container">
        <section class="about">
            <div class="about-image">
                <!-- <img src="Computer-Science-Professionals-Working-Park-University.jpg"> -->
                <div id="kontenti">
                    <header>
                    <img name="mySlide" id="slideshow" />
                    </header>
                    <h2>Recent Hirings</h2>
                    <button onclick="ndrroImg()">Next</button>
                </div>  
            </div>
            <div class="about-content">
                <p>TechConnect is a dynamic, cutting-edge job application website that caters to computer science graduates looking to advance their careers. Whether you're an aspiring software developer, data scientist, AI engineer, or any other tech professional, TechConnect provides the tools and resources to help you succeed in the competitive tech industry. Founded by industry experts with a deep understanding of both the challenges and opportunities in tech recruitment, we created TechConnect to bridge the gap between talented graduates and the innovative companies that need their skills.</p>
            </div>
        </section>
    </div>

    <div class="section_container">
        <div class="header-1">
            <!-- <p>CLIENTS</p> -->
            <h1>What our clients say about us.</h1>
        </div>
        <div class="clients_grid">
            <?php foreach ($clients as $client): ?>
                <div class="card">
                    <p>"<?php echo $client['testimonial']; ?>"</p>
                    <hr>
                    <img src="<?php echo $client['image']; ?>" alt="user">
                    <p class="name"><?php echo $client['name']; ?> - <?php echo $client['role']; ?></p>
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

    <script>
        var i = 0;
        var imgArray = [
            "photo-3.jpg",
            "photo-2.avif",
            "photo-1.png",
            "photo-4.jpg",
            "photo-5.webp"
        ];
        function ndrroImg() {
            document.getElementById('slideshow').src = imgArray[i];
            if (i < imgArray.length - 1) {
                i++;
            } else {
                i = 0;
            }
        }

        document.body.addEventListener('load', ndrroImg());
    </script>

</body>
</html>
