<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
require_once '../../../config.php';


$sql = 'select * from module where module_id=?';


$req = $conn->prepare($sql);
$req->execute([$_GET["module_id"]]);
$row = $req->fetch();

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update Module</h5>
            <div class="card-body">
                <form action="update.php" method="post">
                    <div class="row">
                        <input required type="text" class="form-control" name="module_id" style="visibility:hidden"
                            value="<?php echo $row['module_id'] ?>">
                        <div class="row">
                        <div class="mb-3 w-50">
                            <label class="form-label">Title </label>
                            <input required type="text" class="form-control" name="title" value="<?php echo $row['title'] ?>">
                        </div>
                       <div class="mb-3 w-50">
                            <label class="form-label">Formation</label>
                            <select name="formation_id" class="form-control">
                                <?php
                                $req = $conn->prepare("SELECT * FROM formation");
                                $req->execute();
                                while ($rowFormation = $req->fetch()) {
                                    $selected = ($rowFormation['formation_id'] == $row['formation_id']) ? 'selected' : '';
                                    echo "<option value='" . $rowFormation['formation_id'] . "' " . $selected . ">" . $rowFormation['title'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                     </div>
                     </div>
                    <div class="row">
                        <div class="mb-3 w-50">
                            <label class="form-label">Volume Cours</label>
                            <input required type="number" class="form-control" name="volume_cours" aria-describedby="emailHelp"
                                value="<?php echo $row['volume_cours'] ?>">
                            <div class="form-text">Enter only number.</div>
                        </div>
                        <div class="mb-3 w-50">
                            <label class="form-label">Volume TP</label>
                            <input required type="number" class="form-control" name="volume_tp" aria-describedby="emailHelp"
                                value="<?php echo $row['volume_tp'] ?>">
                            <div class="form-text">Enter only number.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 w-50">
                            <label class="form-label">Volume TD</label>
                            <input required type="number" class="form-control" name="volume_td" aria-describedby="emailHelp"
                                value="<?php echo $row['volume_td'] ?>">
                            <div class="form-text">Enter only number.</div>
                        </div>
                        <div class="mb-3 w-50">
                                <label  class="form-label">Description</label>
                                <textarea required type="text" class="form-control" name="description">
                                    <?php echo $row['description'] ?></textarea>
                            </div>
                    </div>
                    <button  onclick="return confirm('Are you sure you want to update?')"  type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include ('../layouts/footer.php');
?>