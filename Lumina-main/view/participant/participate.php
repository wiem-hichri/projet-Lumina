<?php 
include('../../config.php');
require '../../model/uuid.php';

session_start();

if (!isset($_SESSION['participant'])) {
    header("Location: auth/login.php");
    exit();
}


$sql = 'INSERT INTO fiche_suivi (fiche_suivi_id,participant_id,session_id,etat_paiement) VALUES (?, ?, ?, ?)';

$req = $conn->prepare($sql);

$req->execute([
    Uuid::generate(),
    $_SESSION['participant_id'],
    $_GET['session'],
    'encours'

]);

header('location:../main/success.php')
    ?>