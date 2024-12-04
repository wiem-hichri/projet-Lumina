<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
include ('../../../config.php');
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add new module</h5>
            <form action="store.php" method="post">
                <div class="mb-3 ">
                    <label class="form-label">Module Title</label>
                    <input type="text" class="form-control" name="title">
                    <div class="form-text">Enter your module title.</div>

                </div>
                <div class="row">
                    <?php if (!isset($_GET["formation_id"])) { ?>

                        <div class="mb-3 w-50">
                            <label class="form-label">Formation</label>
                            <select name="formation_id" class="form-control">
                                <?php
                                $req = $conn->prepare("select * from formation");
                                $req->execute();
                                while ($row = $req->fetch()) {
                                    ?>
                                    <option value="<?php echo $row['formation_id']; ?>">
                                        <?php echo $row['title']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                            <div class="form-text">Please select the desired formation from the options provided.</div>

                        </div><?php
                    } else {
                        $req = $conn->prepare("select * from formation where formation_id=?");
                        $req->execute([$_GET["formation_id"]]);
                        $row = $req->fetch(); ?>
                        <div class="mb-3 w-50">
                            <label class="form-label">Formation</label>
                            <input class="form-control" value="<?php echo $row['title']; ?>" readonly>
                            <input required name="formation_id" value="<?php echo $_GET["formation_id"] ?>" hidden>

                        </div>
                        <?php
                    } ?>
                    <div class="mb-3 w-50">
                        <label class="form-label">Volume TD</label>
                        <input required type="number" class="form-control" name="volume_td" aria-describedby="emailHelp" >
                        <div class="form-text">Enter only number.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 w-50">
                        <label class="form-label">Volume Cours</label>
                        <input required type="number" class="form-control" name="volume_cours" aria-describedby="emailHelp">
                        <div class="form-text">Enter only number.</div>
                    </div>
                    <div class="mb-3 w-50">
                        <label class="form-label">Volume TP</label>
                        <input type="number" class="form-control" name="volume_tp" aria-describedby="emailHelp">
                        <div class="form-text">Enter only number.</div>
                    </div>
                </div>


                <div class="row">

                    <div class="mb-3 ">
                        <label class="form-label">Description</label>
                        <textarea required class="form-control" name="description"></textarea>
                        <div class="form-text"> Enter your description.</div>

                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include ('../layouts/footer.php'); ?>