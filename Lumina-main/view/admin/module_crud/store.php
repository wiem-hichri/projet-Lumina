<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
require '../../../config.php';
require '../../../model/uuid.php';
if (isset($_POST['title'], $_POST['description'], $_POST['formation_id'], $_POST['volume_cours'], $_POST['volume_tp'], $_POST['volume_td'])) {

    $sql = 'INSERT INTO module (module_id,title,description,formation_id,volume_cours,volume_tp,volume_td) VALUES (?,?,?,?,?,?,?)';

    $req = $conn->prepare($sql);

    $req->execute([
        Uuid::generate(),
        $_POST['title'],
        $_POST['description'],
        $_POST['formation_id'],
        $_POST['volume_cours'],
        $_POST['volume_tp'],
        $_POST['volume_td'],

    ]);
}
header('location:index.php')
    ?>