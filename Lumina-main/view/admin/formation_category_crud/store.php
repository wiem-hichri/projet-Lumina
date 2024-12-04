<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';
require '../../../model/uuid.php';

$sql = 'INSERT INTO formation_category ( formation_category_id,category_name) VALUES (?,?)';

$req = $conn->prepare($sql);

$req->execute([
    Uuid::generate(),
    $_POST['category_name'],
 
]);

header('location:index.php')
    ?>