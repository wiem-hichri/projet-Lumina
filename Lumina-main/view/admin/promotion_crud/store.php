<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';
require '../../../model/uuid.php';

$sql = 'INSERT INTO promotion (  promotion_id,title,taux_reduction,description) VALUES (?,?,?,?)';

$req = $conn->prepare($sql);

$req->execute([
    Uuid::generate(),
    $_POST['title'],
    $_POST['taux_reduction'],
    $_POST['description'],
   
]);

header('location:index.php')
    ?>