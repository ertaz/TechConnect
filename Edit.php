<?php
$userId = $_GET['id'];

include_once'userRepository';

$userRepository = new UserRepository();

$user  = $userRepository->getUserById($userId);

if(isset($_POST['editBtn'])){
    $id = $user['Id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userRepository->updateUser($id, $name, $surname, $email, $username, $password);

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
</head>
<body>
    <h3>Edit User</h3>
    <form action="" method="post">
        <input type="text" name="id" value="<?=$user['Id']?>" readonly> <br> <br>
        
        <input type="text" name="name" value="<?=$user['Name']?>"> <br> <br>
        
        <input type="text" name="surname" value="<?=$user['Surname']?>"> <br> <br>
        
        <input type="text" name="email" value="<?=$user['Email']?>"> <br> <br>
        
        <input type="text" name="username" value="<?=$user['Username']?>"> <br> <br>
        
        <input type="text" name="password" value="<?=$user['Password']?>"> <br> <br>

        <input type="submit" name="editBtn" value="Save Changes"> <br> <br>
    </form>
</body>
</html>
