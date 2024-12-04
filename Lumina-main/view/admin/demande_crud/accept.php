<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
    exit;
}
include ('../layouts/header.php');
include ("../../../config.php");

$sql = 'SELECT formateur.first_name AS first_name, 
               formation.formation_id AS formation_id, 
               formateur.last_name AS last_name,
               session.title AS session, 
               fiche_demande.status AS status,
               fiche_demande.fiche_demande_id AS demande_id
        FROM fiche_demande 
        JOIN session ON session.session_id = fiche_demande.session_id
        JOIN formation ON formation.formation_id = session.formation_id
        JOIN formateur ON formateur.formateur_id = fiche_demande.formateur_id
        WHERE fiche_demande.fiche_demande_id = ?';

$req = $conn->prepare($sql);
$req->execute([$_GET["demande"]]);
$row = $req->fetch();
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Demande session (<?php echo $row['session'] ?>)</h5>
            <div class="card-body">
                <form action="store.php" onsubmit="return validateForm();" method="post">
                    <input type="hidden" name="fiche_demande_id" value="<?php echo $row['demande_id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Session</label>
                        <input class="form-control" value="<?php echo $row['session']; ?>" readonly>
                        <div class="form-text">This is the session selected.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trainer</label>
                        <input class="form-control" value="<?php echo $row['first_name'] . " " . $row['last_name']; ?>"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Modules</label>
                        <?php
                        $req = $conn->prepare("SELECT module.* 
                                               FROM module 
                                               JOIN ligne_fiche ON module.module_id = ligne_fiche.module_id 
                                               WHERE module.formation_id = ? AND ligne_fiche.fiche_demande_id = ?");
                        $req->execute([$row['formation_id'], $_GET['demande']]);
                        while ($moduleRow = $req->fetch()) {
                            ?>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="module_ids[]"
                                    value="<?php echo $moduleRow['module_id']; ?>"
                                    id="module_<?php echo $moduleRow['module_id']; ?>">
                                <label class="form-check-label"
                                    for="module_<?php echo $moduleRow['module_id']; ?>"><?php echo $moduleRow['title'] ?></label>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <button
                        onclick="return confirm('Are you sure you want to accept this demande? \n the others demands will be permanently denied !!!')"
                        type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        const checkboxes = document.querySelectorAll('input[name="module_ids[]"]');
        let checkedCount = 0;
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                checkedCount++;
            }
        });
        if (checkedCount < 1 || checkedCount > 5) {
            alert('Please select between 1 and 5 checkboxes.');
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>

<?php include ('../layouts/footer.php'); ?>
