<?php
session_start();
session_destroy();
header("Location: LogIn-form.php"); // Redirect to login page after logout
exit;
?>
