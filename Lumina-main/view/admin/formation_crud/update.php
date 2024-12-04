<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';

$req = $conn->prepare(
    'UPDATE formation SET title=?, description=?, formation_category_id=? WHERE formation_id=?'
);
$currentDateTime = date("Y-m-d H:i:s");
$success=$req->execute([
    $_POST['title'],
    $_POST['description'],
    $_POST['formation_category_id'],
    $_POST['formation_id']
]);
if ($success) {
    $_SESSION['successUpdate'] = "Record updated successfully.";
} else {
    $_SESSION['errorUpdate'] = "Failed to update record.";
}

header('location:index.php');


?>