<?php
session_start();

session_destroy();
session_start();

$_SESSION['successLogout'] = "Logout successful.";

header("Location: login.php");
exit(); // Ensure that no other code is executed after the redirection
?>