<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');

require '../../../config.php';

$sql = "select title,description,category_name ,formation_suggestion_id,formation_suggestion.formation_category_id from formation_suggestion 
        join formation_category on formation_suggestion.formation_category_id=formation_category.formation_category_id 
        where formation_suggestion_id=?";

$req = $conn->prepare($sql);
$req->execute([$_GET["suggestion"]]);
$row = $req->fetch();

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add new formation</h5>
            <div class="card-body">
                <form action="store.php" method="post">
                    <input required type="hidden" class="form-control" name="formation_suggestion_id"
                        value="<?php echo $row["formation_suggestion_id"]; ?>">

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input required type="text" class="form-control" name="title" value="<?php echo $row["title"]; ?>">
                        <div class="form-text">Enter your formation title.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <Select name="formation_category_id" class="form-control">
                            <option value="<?php echo $row['formation_category_id']; ?>" selcted>
                                <?php echo $row['category_name']; ?>
                            </option>
                            <?php
                            $req1 = $conn->prepare("select * from formation_category");
                            $req1->execute();
                            while ($row1 = $req1->fetch()) {
                                ?>
                                <option value="<?php echo $row1['formation_category_id']; ?>">
                                    <?php echo $row1['category_name']; ?>
                                </option>

                                <?php
                            }
                            ?>

                        </Select>
                        <div class="form-text">Please select your category from the options provided.</div>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea type="text" class="form-control"
                            name="description"><?php echo $row["description"]; ?></textarea>
                        <div class="form-text">Enter your description.</div>
                    </div>

                    <button  onclick="return confirm('Are you sure you want to proceed?')"  type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include ('../layouts/footer.php'); ?>