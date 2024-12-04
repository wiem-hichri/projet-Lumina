<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
    exit;
}

include ("../../../config.php");

$fiche_demande_id = $_POST['fiche_demande_id'];

// Begin transaction
$conn->beginTransaction();

try {
    // Get session_id from fiche_demande
    $sql = 'SELECT session_id FROM fiche_demande WHERE fiche_demande_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$fiche_demande_id]);
    $session = $stmt->fetch();
    $session_id = $session['session_id'];

    // Update status of the accepted fiche_demande
    $sql = 'UPDATE fiche_demande SET status = "accepte" WHERE fiche_demande_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$fiche_demande_id]);

    // Reset all modules to 'refuse' for the accepted fiche_demande
    $sql = 'UPDATE ligne_fiche SET etat = "refuse" WHERE fiche_demande_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$fiche_demande_id]);

    // Update etat of selected modules to 'accepte' for the accepted fiche_demande
    if (isset($_POST['module_ids']) && is_array($_POST['module_ids'])) {
        foreach ($_POST['module_ids'] as $module_id) {
            $sql = 'UPDATE ligne_fiche SET etat = "accepte" WHERE fiche_demande_id = ? AND module_id = ?';
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fiche_demande_id, $module_id]);
        }
    }

    // Update status of all other fiche_demandes for the same session to "refuse"
    $sql = 'UPDATE fiche_demande SET status = "refuse" WHERE session_id = ? AND fiche_demande_id != ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$session_id, $fiche_demande_id]);

    // Commit the transaction
    $conn->commit();

    // Redirect or display success message
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