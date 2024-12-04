<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';

$req = $conn->prepare(
    "update formation_suggestion set etat='refuse',updated_at=? where formation_suggestion_id=?"
);
$currentDateTime = date("Y-m-d H:i:s");
$req->execute([
    $currentDateTime,
    $_GET['suggestion'],
]);

header('location:index.php');

?>