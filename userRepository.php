<?php
include_once 'Database.php';
include_once 'User.php';

class UserRepository{
    private $connection;

    function __construct(){
        $conn = new Database();
        $this->connection = $conn->getConnection();
    }

    function insertUser($userRole) {
        $conn = $this->connection;

   
        $id = $userRole->getId();
        $name = $userRole->getName();
        $surname = $userRole->getSurname();
        $email = $userRole->getEmail();
        $username = $userRole->getUsername();
        $password = $userRole->getPassword();
        $age = $userRole->getAge();
        $location = $userRole->getLocation();
        $role = $userRole->getRole();

   
        $sql = "INSERT INTO users (id, name, surname, email, username, password, age, location, role) VALUES (?,?,?,?,?,?,?)";

        $statement = $conn->prepare($sql); 

   
        $statement->execute([$id, $name, $surname, $email, $username, password_hash($password, PASSWORD_DEFAULT),$age, $location, $role]);

       
        echo "<script> alert('User has been inserted successfully!'); </script>";
    }

    function getAllUsers() {
        $conn = $this->connection;

        $sql = "SELECT * FROM users";

        $statement = $conn->query($sql); 
        $users = $statement->fetchAll(); 

        return $users; 
    }

    
    function getUserById($id) {
        $conn = $this->connection;

     
        $sql = "SELECT * FROM users WHERE id=?";

        $statement = $conn->prepare($sql); 
        $statement->execute([$id]);
        $user = $statement->fetch(); 

        return $user;
    }

    function getUserByRole($role){
        $conn = $this->connection;

        $sql = "SELECT * FROM users WHERE role=?";

        $statement = $conn->prepare($sql);
        $statement->execute([$role]);
        $userRole = $statement->fetchAll();

        return $userRole;
    }

    
    function updateUser($id, $name, $surname, $email, $username, $password, $role) {
        $conn = $this->connection;

        $sql = "UPDATE users SET name=?, surname=?, email=?, username=?, password=?, role=? WHERE id=?";

        $statement = $conn->prepare($sql); 

        $statement->execute([$name, $surname, $email, $username, password_hash($password, PASSWORD_DEFAULT), $role, $id]);

        echo "<script>alert('Update was successful');</script>";
    }

    
    function deleteUser($id) {
        $conn = $this->connection;

      
        $sql = "DELETE FROM users WHERE id=?";

        $statement = $conn->prepare($sql); 

       
        $statement->execute([$id]);

       
        echo "<script>alert('Delete was successful');</script>";
    }

    function messageFromContactUs($name, $email, $message){
        $conn = $this->connection;

        $sql = "INSERT INTO messages(name,email,message) VALUES(?, ?, ?)";

        $statement = $conn->prepare($sql);
        $statement->execute([$name, $email, $message]);
    }
}

?>
