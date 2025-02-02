<?php
$userId = $_GET['id'];

include_once'userRepository.php';

$userRepository = new UserRepository();

$user  = $userRepository->getUserById($userId);

if(isset($_POST['editBtn'])){
    $id = $user['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $userRepository->updateUser($id, $name, $surname, $email, $username, $password, $role);

    header("Location: Dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="Edit-css.css?v=1.0">
</head>
<body>
    <h3>Edit User</h3>
    <form action="" method="post">
        <input type="text" name="name" value="<?=$user['name']?>"> <br> <br>
        
        <input type="text" name="surname" value="<?=$user['surname']?>"> <br> <br>
        
        <input type="text" name="email" value="<?=$user['email']?>"> <br> <br>

        <input type="text" name="username" value="<?=$user['username']?>"> <br> <br>
        
        <input type="password" name="password"  placeholder="Enter a new password"> <br> <br>

        <input type="text" name="role" value="<?=$user['role']?>"> <br> <br>

        <input type="submit" name="editBtn" value="Save Changes"> <br> <br>
    </form>
</body>
</html>
