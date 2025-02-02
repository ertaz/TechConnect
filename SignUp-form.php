<?php
include_once 'Database.php';
include_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $connection = $db->getConnection();
    $user = new User($connection);

    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $surname = isset($_POST['surname']) ? trim($_POST['surname']) : null;
    $age = isset($_POST['age']) ? trim($_POST['age']) : null;
    $location = isset($_POST['location']) ? trim($_POST['location']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : null;

    if (empty($name) || empty($surname) || empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        echo "All fields are required!";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    if ($user->emailExists($email)) {
        echo "This email is already taken. Please use a different email.";
        exit;
    }

    if ($user->register($name, $surname, $email, $username, $password, $age, $location)) {
        $user_id = $connection->lastInsertId();

        $about_me = isset($_POST['about_me']) ? trim($_POST['about_me']) : '';
        $profile_picture = isset($_FILES['profile_picture']['name']) ? $_FILES['profile_picture']['name'] : '';
        $facebook = isset($_POST['facebook']) ? trim($_POST['facebook']) : '';
        $instagram = isset($_POST['instagram']) ? trim($_POST['instagram']) : '';
        $linkedin = isset($_POST['linkedin']) ? trim($_POST['linkedin']) : '';
        $other_social = isset($_POST['other_social']) ? trim($_POST['other_social']) : '';

        if ($profile_picture) {
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'uploads/' . $profile_picture);
        }

        $query = "UPDATE users SET about_me = :about_me, profile_picture = :profile_picture, 
                  facebook = :facebook, instagram = :instagram, linkedin = :linkedin, 
                  other_social = :other_social, age = :age, location = :location 
                  WHERE id = :user_id";

        $stmt = $connection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':about_me', $about_me);
        $stmt->bindParam(':profile_picture', $profile_picture);
        $stmt->bindParam(':facebook', $facebook);
        $stmt->bindParam(':instagram', $instagram);
        $stmt->bindParam(':linkedin', $linkedin);
        $stmt->bindParam(':other_social', $other_social);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':location', $location);
        $stmt->execute();

        header("Location: LogIn-form.php");
        exit;
    } else {
        echo "Error registering user!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="SignUp-form.css?v=1.0">
</head>
<body>

<div class="signup-container">
    <div class="signup-box">
        <div class="signup-text">
            <h2>Sign Up</h2>
        </div>
        <form method="POST" action="SignUp-form.php" enctype="multipart/form-data" id="signup-form">
            <input type="text" id="emri" name="name" placeholder="Name" required>
            <input type="text" id="mbiemri" name="surname" placeholder="Surname" required>
            <input type="number" name="age" id="age" placeholder="Age" required>
            <input type="text" name="location" id="location" placeholder="Location" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="password" id="c-password" name="confirm_password" placeholder="Confirm Password" required>
            
            <div class="optional-box">
                <div class="optional-text">
                    <h2>Optional</h2>
                </div>
                <textarea name="about_me" id="about_me" rows="4" placeholder="About Me (Optional)"></textarea>
                <input type="file" name="profile_picture" id="profile_picture">
                <input type="url" name="facebook" id="facebook" placeholder="Facebook URL (Optional)">
                <input type="url" name="instagram" id="instagram" placeholder="Instagram URL (Optional)">
                <input type="url" name="linkedin" id="linkedin" placeholder="LinkedIn URL (Optional)">
                <input type="url" name="other_social" id="other_social" placeholder="Other Social URL (Optional)">
            </div>
            
            <button type="submit" id="submit-btn">Sign Up</button>
        </form>
    </div>
</div>

</body>
</html>
