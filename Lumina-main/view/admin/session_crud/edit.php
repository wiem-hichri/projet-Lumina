<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
    exit();
}
include ('../layouts/header.php');
require '../../../config.php';

// Vérifiez si le paramètre session_id est passé dans l'URL
if (!isset($_GET["session_id"])) {
    die("Session ID is required.");
}

$session_id = $_GET["session_id"];

$sql = 'SELECT * FROM session WHERE session_id = ?';
$req = $conn->prepare($sql);
$req->execute([$session_id]);
$session = $req->fetch();

if (!$session) {
    die("Session not found.");
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update Session</h5>
            <div class="card-body">
                <form action="update.php" onsubmit="return onSubmitForm();" method="post">
                    
                        <input required type="text" class="form-control" name="session_id" style="visibility:hidden" value="<?php echo $session['session_id'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input required type="text" class="form-control" name="title" value="<?php echo $session['title'] ?>">
                        </div>
                        <div class="row">
                            <div class="mb-3 w-50">
                                <label class="form-label">Start Date</label>
                                <input required type="datetime-local" class="form-control" name="start_date" id="start_date" value="<?php echo $session['start_date']; ?>">
                            </div>
                            <div class="mb-3 w-50">
                                <label class="form-label">End Date</label>
                                <input required type="datetime-local" class="form-control" name="end_date" id="end_date" value="<?php echo $session['end_date']; ?>">
                            </div>
                        </div>
                        <div class="row">
                        <div class="mb-3 w-50">
                            <label class="form-label">Niveau</label>
                            <select name="niveau" class="form-control">
                                <option value="Beginner" <?php echo $session['niveau'] == 'Beginner' ? 'selected' : ''; ?>>Beginner</option>
                                <option value="Intermediate" <?php echo $session['niveau'] == 'Intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                                <option value="Advanced" <?php echo $session['niveau'] == 'Advanced' ? 'selected' : ''; ?>>Advanced</option>
                            </select>
                        </div>
                        <div class="mb-3 w-50">
                            <label class="form-label">Formation</label>
                            <select name="formation_id" class="form-control">
                                <option value="nopromo">No discount</option>
                                <?php
                                $formationReq = $conn->prepare("SELECT * FROM formation");
                                $formationReq->execute();
                                while ($formation = $formationReq->fetch()) {
                                    ?>
                                    <option value="<?php echo $formation['formation_id']; ?>" <?php echo $session['formation_id'] == $formation['formation_id'] ? 'selected' : ''; ?>>
                                        <?php echo $formation['title']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 w-50">
                                <label class="form-label">Price</label>
                                <input required type="text" class="form-control" name="price" value="<?php echo $session['price'] ?>">
                            </div>
                            <div class="mb-3 w-50">
                                <label class="form-label">Promotion</label>
                                <select name="promotion_id" class="form-control">
                                    <?php
                                    $promotionReq = $conn->prepare("SELECT * FROM promotion");
                                    $promotionReq->execute();
                                    while ($promotion = $promotionReq->fetch()) {
                                        ?>
                                        <option value="<?php echo $promotion['promotion_id']; ?>" <?php echo $session['promotion_id'] == $promotion['promotion_id'] ? 'selected' : ''; ?>>
                                            <?php echo $promotion['title']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 ">
                            <label class="form-label">Description</label>
                            <input required type="text" class="form-control" name="description" value="<?php echo $session['description'] ?>">
                        </div>
                        <button onclick="return confirm('Are you sure you want to update?')" type="submit" class="btn btn-primary">Update</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function validateDates() {
    var startDate = new Date(document.getElementById("start_date").value);
    var endDate = new Date(document.getElementById("end_date").value);
    var errorMessage = "";

    if (endDate <= startDate) {
        errorMessage = "End date must be after start date.";
    }
    return errorMessage;
}

function onSubmitForm() {
    var errorMessage = validateDates();

    if (errorMessage) {
        alert(errorMessage);
        return false;
    } else {
        return true;
    }
}
</script>
<?php include ('../layouts/footer.php'); ?>
