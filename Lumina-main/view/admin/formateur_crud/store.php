<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';
require '../../../model/uuid.php';

$sql = 'INSERT INTO formateur (  formateur_id,cin,first_name,last_name,email,password,tel,rib,specialite,banque) VALUES (?,?,?,?,?,?,?,?,?,?)';

$req = $conn->prepare($sql);

$req->execute([
    Uuid::generate(),
    $_POST['cin'],
    $_POST['first_name'],
    $_POST['last_name'],
    $_POST['email'],
    $_POST['password'],
    $_POST['tel'],
    $_POST['rib'],
    $_POST['specialite'],
    $_POST['banque'],
]);

header('location:index.php')
    ?>