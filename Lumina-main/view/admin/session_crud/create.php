<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');

require '../../../config.php';

?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add new session</h5>
            <div class="card-body">
                <form action="store.php" onsubmit="return onSubmitForm()" method="post">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input required type="text" class="form-control" name="title">
                        <div class="form-text">Enter your formation name.</div>
                    </div>

                    <div class="row">
                        <div class="mb-3 w-50">
                            <label class="form-label">Start_Date</label>
                            <input required type="datetime-local" class="form-control" name="start_date"
                                id="start_date">
                        </div>

                        <div class="mb-3 w-50">
                            <label class="form-label">End_Date</label>
                            <input required type="datetime-local" class="form-control" name="end_date" id="end_date">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Level</label>
                        <select name="niveau" class="form-control">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                        <div class="form-text">Please select your level from the options provided.</div>
                    </div>

                    <?php if (!isset($_GET["formation_id"])) { ?>

                        <div class="mb-3">
                            <label class="form-label">Formation</label>
                            <Select name="formation_id" class="form-control">
                                <?php
                                $sql = 'SELECT  title,formation_id FROM formation ';


                                $req = $conn->prepare($sql);
                                $req->execute();
                                while ($row = $req->fetch()) {
                                    $sql1 = 'SELECT count(*) as nb FROM module where formation_id=?';
                                    $req2 = $conn->prepare($sql1);
                                    $req2->execute([$row["formation_id"]]);
                                    $nb = $req2->fetch();
                                    if ($nb["nb"] == 0) {
                                    } else { ?>
                                        ?>
                                        <option value="<?php echo $row['formation_id']; ?>">
                                            <?php echo $row['title']; ?>
                                        </option>

                                        <?php
                                    }
                                }
                                ?>

                            </Select>
                            <div class="form-text">Please select the desired formation from the options provided.</div>
                        </div>

                        <?php
                    } else {
                        $req = $conn->prepare("select * from formation where formation_id=?");
                        $req->execute([$_GET["formation_id"]]);
                        $row = $req->fetch(); ?>
                        <div class="mb-3">
                            <label class="form-label">Formation</label>
                            <input required class="form-control" value="<?php echo $row['title']; ?>" readonly>
                            <input required name="formation_id" value="<?php echo $_GET["formation_id"] ?>" hidden>
                        </div>
                        <?php
                    } ?>
                    <div class="row">
                    <div class="mb-3 w-50">
                        <label class="form-label">Price</label>
                        <input required type="text" class="form-control" name="price">
                        <div class="form-text">Enter your price.</div>
                    </div>
                    <div class="mb-3 w-50">
                        <label class="form-label">Promotion</label>
                        <Select name="promotion_id" class="form-control">
                            <?php
                            $req = $conn->prepare("select * from promotion");
                            $req->execute();
                            while ($row = $req->fetch()) {
                                ?>
                                <option value="<?php echo $row['promotion_id']; ?>">
                                    <?php echo $row['title']; ?>
                                </option>

                                <?php
                            }
                            ?>
                        </Select>
                        <div class="form-text">Please select the desired promotion from the options provided.
                        </div>
                        </div>
                    </div>
                    <div class="mb-3 ">
                        <label class="form-label">Description</label>
                        <textarea type="text" class="form-control" name="description"></textarea>
                        <div class="form-text">Enter your description.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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