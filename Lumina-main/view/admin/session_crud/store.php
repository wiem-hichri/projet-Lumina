<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';
require '../../../model/uuid.php';

$sql = 'INSERT INTO session ( session_id,title,description,start_date,end_date,niveau,price,formation_id,promotion_id) VALUES (?,?,?,?,?,?,?,?,?)';

$req = $conn->prepare($sql);

$req->execute([
    Uuid::generate(),
    $_POST['title'],
    $_POST['description'],
    $_POST['start_date'],
    $_POST['end_date'],
    $_POST['niveau'],
    $_POST['price'],
    $_POST['formation_id'],
    $_POST['promotion_id'],


]);

header('location:index.php')
    ?>