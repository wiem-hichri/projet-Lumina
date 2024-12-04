<?php
session_start();

if (!isset($_SESSION['formateur'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
include ("../../../config.php");
?>

<div class="container-fluid">
    <div class="row">
        <form action="index.php" method="GET">
            <div class="d-sm-flex d-block align-items-center justify-content mb-9">
                <select class="form-control w-50 " name="filter">
                    <option value="encours">Pending</option>
                    <option value="refuse">Denied</option>
                    <option value="accepte">Accepted</option>
                </select>
                <button type="submit" class="btn btn-outline-primary m-3">Filter</button>
                <?php if (isset($_GET["filter"])) { ?>
                    <a href="index.php" class="btn btn-danger m-3">Undo filter</a>
                <?php } ?>
            </div>
        </form>

        <div class="d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Suggestion encours </h5>
                        </div>

                        <div>
                            <a href="create.php" class="btn btn-primary">Depot susgestion</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Title </h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Category</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Description</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                    </th>
                                    <th class="border-bottom-0">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!isset($_GET['filter'])) {
                                    $sql = "SELECT title, description, category_name,etat  from formation_suggestion 
                                     JOIN formation_category 
                                     ON formation_suggestion.formation_category_id = formation_category.formation_category_id 
                                     where formateur_id=? ";

                                    $req = $conn->prepare($sql);
                                    $req->execute([$_SESSION["formateur_id"]]);
                                    if ($req->rowCount() == 0) {
                                        ?>
                                        <tr>
                                            <td>No data in the table</td>
                                        </tr>
                                    <?php } ?>

                                    <?php while ($row = $req->fetch()) { ?>

                                        <tr>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    <?php echo $row["title"] ?>
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    <?php echo $row["category_name"] ?>
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    <?php echo $row["description"] ?>
                                                </p>
                                            </td>
                                            <?php if ($row["etat"] == "encours") { ?>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-warning rounded-3 fw-semibold">Pending</span>
                                                    </div>
                                                </td>
                                                <?php
                                            } ?>
                                            <?php if ($row["etat"] == "refuse") { ?>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-danger rounded-3 fw-semibold">Denied</span>
                                                    </div>
                                                </td>
                                                <?php
                                            } ?>
                                            <?php if ($row["etat"] == "accepte") { ?>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge bg-success rounded-3 fw-semibold">Accepted</span>
                                                    </div>
                                                </td>
                                                <?php
                                            } ?>

                                        </tr>
                                    <?php }
                                } else if (isset($_GET["filter"])) {
                                    $sql = 'SELECT title, description, category_name,etat 
                                     from formation_suggestion  JOIN formation_category 
                                     ON formation_suggestion.formation_category_id = formation_category.formation_category_id
                                      where formation_suggestion.etat=?  and formateur_id=? ';

                                    $req = $conn->prepare($sql);
                                    $req->execute([$_GET["filter"],$_SESSION["formateur_id"]]);
                                    if ($req->rowCount() == 0) {
                                        ?>
                                            <tr>
                                                <td>No data found</td>
                                            </tr>
                                    <?php } ?>

                                    <?php while ($row = $req->fetch()) { ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                    <?php echo $row["title"] ?>
                                                    </p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                    <?php echo $row["category_name"] ?>
                                                    </p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                    <?php echo $row["description"] ?>
                                                    </p>
                                                </td>
                                            <?php if ($row["etat"] == "encours") { ?>
                                                    <td class="border-bottom-0">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-warning rounded-3 fw-semibold">Pending</span>
                                                        </div>
                                                    </td>
                                                <?php
                                            } ?>
                                            <?php if ($row["etat"] == "refuse") { ?>
                                                    <td class="border-bottom-0">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-danger rounded-3 fw-semibold">Denied</span>
                                                        </div>
                                                    </td>
                                                <?php
                                            } ?>
                                            <?php if ($row["etat"] == "accepte") { ?>
                                                    <td class="border-bottom-0">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-success rounded-3 fw-semibold">Accepted</span>
                                                        </div>
                                                    </td>
                                                <?php
                                            } ?>
                                            </tr>
                                    <?php }
                                } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ('../layouts/footer.php'); ?>