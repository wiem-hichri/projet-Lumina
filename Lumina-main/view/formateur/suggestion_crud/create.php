<?php
session_start();

if (!isset($_SESSION['formateur'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');

require '../../../config.php';

?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add new formation suggestion</h5>
            <div class="card-body">
                <form action="store.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input required type="text" class="form-control" name="title">
                        <div class="form-text">Enter your formation title.</div>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <Select name="formation_category_id" class="form-control">
                            <?php
                            $req = $conn->prepare("select * from formation_category");
                            $req->execute();
                            while ($row = $req->fetch()) {
                                ?>
                                <option value="<?php echo $row['formation_category_id']; ?>">
                                    <?php echo $row['category_name']; ?>
                                </option>

                                <?php
                            }
                            ?>

                        </Select>
                        <div class="form-text">Please select your category from the options provided.</div>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea type="text" class="form-control" name="description"></textarea>
                        <div class="form-text">Enter your description. </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include ('../layouts/footer.php'); ?>