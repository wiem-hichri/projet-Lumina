<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ("../../../config.php");

$req = $conn->prepare('delete from admin where admin_id=?');

$success=$req->execute([$_GET['admin_id']]);
if ($success) {
    $_SESSION['successDelete'] = "Record deleted successfully.";
} else {
    $_SESSION['errorDelete'] = "Failed to delete record.";
}

header('location:index.php');

?>