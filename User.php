<?php
class User {
    private $conn;
    private $table_name = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Check if email exists in the database
    public function emailExists($email) {
        $query = "SELECT id FROM {$this->table_name} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Register a new user with optional fields
    public function register($name, $surname, $email, $username, $password, $age, $location, $role = 'user', $about_me = '', $profile_picture = '', $facebook = '', $instagram = '', $linkedin = '', $other_social = '') {
        $query = "INSERT INTO {$this->table_name} 
                  (name, surname, email, username, password, age, location, role, about_me, profile_picture, facebook, instagram, linkedin, other_social) 
                  VALUES 
                  (:name, :surname, :email, :username, :password, :age, :location, :role, :about_me, :profile_picture, :facebook, :instagram, :linkedin, :other_social)";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':about_me', $about_me);
        $stmt->bindParam(':profile_picture', $profile_picture);
        $stmt->bindParam(':facebook', $facebook);
        $stmt->bindParam(':instagram', $instagram);
        $stmt->bindParam(':linkedin', $linkedin);
        $stmt->bindParam(':other_social', $other_social);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Login method to authenticate the user
    public function login($email, $password) {
        $query = "SELECT id, name, surname, email, password, age, location, about_me, role FROM {$this->table_name} WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['age'] = $row['age'];
                $_SESSION['location'] = $row['location'];
                $_SESSION['about_me'] = $row['about_me'];
                $_SESSION['role'] = $row['role'];  // Save the role in session
                return true;
            }
        }
        return false;
    }

    // Retrieve user data by email
    public function getUserDataByEmail($email) {
        $query = "SELECT name, surname, age, location, about_me, profile_picture, facebook, instagram, linkedin, other_social 
                  FROM {$this->table_name} WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }
        return null; 
    }

    // Log out method to destroy the session
    public function logout() {
        session_start();
        session_unset();  // Unset all session variables
        session_destroy(); // Destroy the session
        header("Location: Home.php"); // Redirect to homepage after logout
        exit;
    }
    
}
?>
