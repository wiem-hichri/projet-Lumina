<?php
session_start();

if (!isset ($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
require '../../../config.php';

$sql = 'select * from formation_category where formation_category_id=?';

$req = $conn->prepare($sql);
$req->execute([$_GET["formation_category_id"]]);
$row = $req->fetch();

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">update category</h5>
                <div class="card-body">
                    <form action="update.php" method="post">
                        
                            <input required type="text" class="form-control" name="formation_category_id" style="visibility:hidden"
                                value="<?php echo $row['formation_category_id'] ?>">

                            <div class="mb-3 w-50">
                                <label  class="form-label">Category name</label>
                                <input required type="text" class="form-control" name="category_name"
                                    value="<?php echo $row['category_name'] ?>">
                            </div>
                         
                        <button  onclick="return confirm('Are you sure you want to update?')" type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
    </div>
</div>

<?php include ('../layouts/footer.php'); ?>