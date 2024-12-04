<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';

$req = $conn->prepare(
    'UPDATE session SET title=?, description=?, start_date=?,end_date=?,niveau=?,price=?,formation_id=?,promotion_id=?,updated_at=? WHERE session_id=?'
);
$currentDateTime = date("Y-m-d H:i:s");
$success=$req->execute([
    $_POST['title'],
    $_POST['description'],
    $_POST['start_date'],
    $_POST['end_date'],
    $_POST['niveau'],
    $_POST['price'],
    $_POST['formation_id'],
    $_POST['promotion_id'],
    $currentDateTime,
    $_POST['session_id']
]);
if ($success) {
    $_SESSION['successUpdate'] = "Record updated successfully.";
} else {
    $_SESSION['errorUpdate'] = "Failed to update record.";
}

header('location:index.php');


?>