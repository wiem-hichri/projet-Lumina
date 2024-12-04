<?php
session_start();

if (!isset($_SESSION['formateur'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
include ("../../../config.php");

$req = $conn->prepare('delete from formation_suggestion where formation_suggestion_id=?');

$req->execute([$_GET['formation_suggestion_id']]);

header('location:index.php');

?>