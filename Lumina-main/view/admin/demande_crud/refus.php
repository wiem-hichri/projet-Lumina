<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
    exit;
}

include ("../../../config.php");

$fiche_demande_id = $_GET['demande'];

// Begin transaction
$conn->beginTransaction();

try {
    // Update the selected fiche_demande to "refused"
    $sql = 'UPDATE fiche_demande SET status = "refuse" WHERE fiche_demande_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$fiche_demande_id]);

    // Update all related rows in ligne_fiche to "refused"
    $sql = 'UPDATE ligne_fiche SET etat = "refuse" WHERE fiche_demande_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$fiche_demande_id]);

    // Commit transaction
    $conn->commit();

    // Redirect or display success message
    $_SESSION["successAdd"] = "Record updated  successfully";
    header("location:index.php");

    // Redirect to a success page
    exit;

} catch (Exception $e) {
    // Rollback transaction if an error occurs
    $conn->rollBack();
    $_SESSION["errorAdd"] = $e->getMessage();

}
?>