<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';
require '../../../model/uuid.php';

$sql = 'INSERT INTO formation (formation_id, title, description, formation_category_id) VALUES (?, ?, ?, ?)';

$req = $conn->prepare($sql);

$req->execute([
    Uuid::generate(),
    $_POST['title'],
    $_POST['description'],
    $_POST['formation_category_id'],
]);

$req1 = $conn->prepare(
    "UPDATE formation_suggestion SET etat='accepte', updated_at=? WHERE formation_suggestion_id=?"
);
$currentDateTime = date("Y-m-d H:i:s");
$req1->execute([
    $currentDateTime,
    $_POST['formation_suggestion_id'],
]);

header('location:index.php');
?>