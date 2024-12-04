<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';

$req = $conn->prepare(
    'update formateur set first_name=?,last_name=?,email=?,password=?,tel=?,cin=?,rib=?,specialite=?,banque=?,updated_at=? where formateur_id=?'
);
$currentDateTime = date("Y-m-d H:i:s");
$success=$req->execute([
    $_POST['first_name'],
    $_POST['last_name'],
    $_POST['email'],
    $_POST['password'],
    $_POST['tel'],
    $_POST['cin'],
    $_POST['rib'],
    $_POST['specialite'],
    $_POST['banque'],
    $currentDateTime,
    $_POST['formateur_id'],
]);
if ($success) {
    $_SESSION['successUpdate'] = "Record updated successfully.";
} else {
    $_SESSION['errorUpdate'] = "Failed to update record.";
}

header('location:index.php');

?>