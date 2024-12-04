<?php
session_start();

if (!isset ($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add new Category</h5>
                <div class="card-body">
                    <form action="store.php" method="post">
                       
                            <div class="mb-3 w-50">
                                <label  class="form-label">Category name</label>
                                <input required type="text" class="form-control" name="category_name">
                                <div class="form-text">Enter your category name
                                </div>
                            </div>
                         
                         <button type="submit" class="btn btn-primary">Submit</button>
                         
                    </form>
                </div>
            </div>

    </div>
</div>

<?php include ('../layouts/footer.php'); ?>