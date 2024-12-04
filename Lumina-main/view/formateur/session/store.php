<?php
session_start();

if (!isset($_SESSION['formateur'])) {
    header("location:../auth/login.php");
}include ("../../../config.php");
require '../../../model/uuid.php';

$fiche_demande_id = Uuid::generate();
try {
    // Insert into fiche_demande
    $sql = "INSERT INTO fiche_demande (fiche_demande_id, session_id, formateur_id, status) VALUES (?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$fiche_demande_id, $_POST['session_id'], $_SESSION['formateur_id'], 'encours']);

    // Insert into ligne_fiche for each selected module
    if (isset($_POST['module_ids']) && is_array($_POST['module_ids'])) {
        foreach ($_POST['module_ids'] as $module_id) {
            $fiche_demande_row_id = Uuid::generate();
            $sql = "INSERT INTO ligne_fiche (ligne_fiche_id, fiche_demande_id, module_id, etat) VALUES (?, ?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fiche_demande_row_id, $fiche_demande_id, $module_id, 'encours']);
        }
    }

    $_SESSION["successAdd"] = "Record added successfully";
    header("location:index.php");
    exit;

} catch (Exception $e) {
    // Rollback transaction if an error occurs
    $conn->rollBack();
    $_SESSION["errorAdd"] = $e->getMessage();
    header("location:index.php");
    exit;
}
?>