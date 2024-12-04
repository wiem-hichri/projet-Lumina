<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';

$req = $conn->prepare(
    'update participant set first_name=?,last_name=?,email=?,password=?,tel=?,adress=?,cin=?,profession=?,updated_at=? where participant_id=?'
);
$currentDateTime = date("Y-m-d H:i:s");
$success=$req->execute([
    $_POST['first_name'],
    $_POST['last_name'],
    $_POST['email'],
    $_POST['password'],
    $_POST['tel'],
    $_POST['address'],
    $_POST['cin'],
    $_POST['profession'],
    $currentDateTime,
    $_POST['participant_id'],
]);
if ($success) {
    $_SESSION['successUpdate'] = "Record updated successfully.";
} else {
    $_SESSION['errorUpdate'] = "Failed to update record.";
}
header('location:index.php');

?>