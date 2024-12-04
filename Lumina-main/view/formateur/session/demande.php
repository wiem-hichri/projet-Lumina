<?php
session_start();

if (!isset($_SESSION['formateur'])) {
    header("location:../auth/login.php");
    exit;
}
include ('../layouts/header.php');
include ("../../../config.php");

$sql = 'SELECT * FROM session WHERE session_id = ?';
$req = $conn->prepare($sql);
$req->execute([$_GET["session"]]);
$sessionRow = $req->fetch();

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Demande session (<?php echo $sessionRow['title'] ?>)</h5>
            <div class="card-body">
                <form action="store.php" onsubmit="return validateForm();" method="post">
                    <input required type="hidden" class="form-control" name="session_id"
                        value="<?php echo $sessionRow['session_id'] ?>">
                    <input required type="hidden" class="form-control" name="formation_id"
                        value="<?php echo $sessionRow['formation_id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Session</label>
                        <input required class="form-control" value="<?php echo $sessionRow['title']; ?>" readonly>
                        <div class="form-text">This is the session selected.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Modules</label>
                        <?php
                        $moduleReq = $conn->prepare("SELECT * FROM module WHERE formation_id = ?");
                        $moduleReq->execute([$sessionRow['formation_id']]);

                        while ($moduleRow = $moduleReq->fetch()) {
                            ?>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="module_ids[]"
                                    value="<?php echo $moduleRow['module_id']; ?>" id="<?php echo $moduleRow['title'] ?>">
                                <label class="form-check-label"
                                    for="<?php echo $moduleRow['title'] ?>"><?php echo $moduleRow['title'] ?></label>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <button onclick="return confirm('Are you sure you want to submit?')" type="submit"
                        class="btn btn-primary">Submit</button>
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
        } else {
            return true; // Allow form submission
        }
    }
</script>

<?php include ('../layouts/footer.php'); ?>