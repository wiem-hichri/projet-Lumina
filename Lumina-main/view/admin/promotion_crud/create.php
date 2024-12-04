<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add new Promotion</h5>
            <div class="card-body">
                <form action="store.php" method="post">
                    <div class="row">
                        <div class="mb-3 ">
                            <label class="form-label">Title</label>
                            <input required type="text" class="form-control" name="title" placeholder="Enter the title">
                           
                        </div>
                    </div>

                    <div class="row">

                        <div class="mb-3">
                            <label class="form-label">Taux de Réduction</label>
                            <input required type="text" class="form-control" name="taux_reduction" >
                            <div class="form-text">Enter the percentage of reduction(%)</div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="mb-3 ">
                            <label class="form-label">Description</label>
                            <textarea required type="text" class="form-control" name="description" placeholder="Enter the description" ></textarea>
                            
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>




<?php include ('../layouts/footer.php'); ?>