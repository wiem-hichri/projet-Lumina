<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
include ("../../../config.php");
?>

<div class="container-fluid">
    <div class="row">
        <?php if (isset($_GET["show"])) { ?>

            <form action="index.php" method="GET">
                
                <div class="d-sm-flex d-block align-items-center justify-content mb-9">
                    <select class="form-control w-50 " name="show">
                        <option value="refuse">Denied</option>
                        <option value="accepte">Accepted</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary m-3">Filter</button>
                    <?php if (isset($_GET["show"])&& $_GET["show"]!="all") { ?>
                        <a href="index.php?show=all" class="btn btn-danger m-3">Undo filter</a>
                    <?php } ?>
                </div>
            </form>
        <?php } ?>
        <div class="d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Suggestion pending suggestions</h5>
                        </div>

                        <div>
                            <?php if (!isset($_GET["show"])) { ?>
                                    <input type="hidden" class="form-control w-50" name="show_all"
                                        placeholder="Filter by search" value="set">
                                    <a href="index.php?show=all" class="btn btn-danger m-3">Show all</a>

                            <?php } else { ?>
                                <a href="index.php" class="btn btn-danger m-3">Show Pending</a>
                                <?php
                            } ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Frormateur</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Title</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Description</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Category</h6>
                                    </th>

                                    <th class="border-bottom-0">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!isset($_GET['show'])) {
                                    $sql = 'SELECT title, description, category_name, first_name ,etat,formation_suggestion_id FROM formation_suggestion 
                                    JOIN formation_category ON formation_suggestion.formation_category_id = formation_category.formation_category_id
                                    join formateur on  formation_suggestion.formateur_id=formateur.formateur_id 
                                    where formation_suggestion.etat="encours"';

                                    // Prepare and execute the statement
                                    $req = $conn->prepare($sql);
                                    $req->execute();
                                    if ($req->rowCount() == 0) {
                                        ?>
                                        <tr>
                                            <td>No data in the table</td>
                                        </tr>
                                    <?php } ?>

                                    <?php while ($row = $req->fetch()) { ?>

                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">
                                                    <?php echo $row["first_name"] ?>
                                                </h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    <?php echo $row["title"] ?>
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    <?php echo $row["description"] ?>
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    <?php echo $row["category_name"] ?>
                                                </p>
                                            </td>

                                            <td class="border-bottom-0">
                                                <a href="accept.php?suggestion=<?php echo $row["formation_suggestion_id"] ?>"
                                                    class="btn btn-outline-warning m-1">Accept</a>
                                            </td>
                                            <td class="border-bottom-0">
                                                 <a onclick="return confirm('Are you sure you want to deny?')"  href="refus.php?suggestion=<?php echo $row["formation_suggestion_id"] ?>"
                                                    class="btn btn-outline-danger m-1">Deny</a>
                                            </td>

                                        </tr>
                                    <?php }
                                } else if (isset($_GET["show"])&& $_GET["show"]!="all") {
                                    
                                        $sql = "SELECT title, description, category_name,etat,first_name,formation_suggestion_id  from formation_suggestion 
                                     JOIN formation_category 
                                     ON formation_suggestion.formation_category_id = formation_category.formation_category_id
                                     join formateur on formation_suggestion.formateur_id=formateur.formateur_id where etat=?";

                                        // Prepare and execute the statement
                                        $req = $conn->prepare($sql);
                                        $req->execute([$_GET["show"]]);
                                        if ($req->rowCount() == 0) {
                                            ?>
                                                <tr>
                                                    <td>No data in the table</td>
                                                </tr>
                                        <?php } ?>

                                        <?php while ($row = $req->fetch()) { ?>

                                                <tr>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-0">
                                                        <?php echo $row["first_name"] ?>
                                                        </h6>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">
                                                        <?php echo $row["title"] ?>
                                                        </p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">
                                                        <?php echo $row["description"] ?>
                                                        </p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">
                                                        <?php echo $row["category_name"] ?>
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
                                                <?php if ($row["etat"] == "encours") { ?>
                                                        <td class="border-bottom-0">
                                                            <a href="accept.php?suggestion=<?php echo $row["formation_suggestion_id"] ?>"
                                                                class="btn btn-outline-warning m-1">Accept</a>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                             <a onclick="return confirm('Are you sure you want to deny?')"  href="refus.php?suggestion=<?php echo $row["formation_suggestion_id"] ?>"
                                                                class="btn btn-outline-danger m-1">Deny</a>
                                                        </td>
                                                    <?php
                                                } ?>
                                                </tr>
                                        <?php 
                                    } }else { 
                                            $sql = "SELECT title, description, category_name,etat,first_name,formation_suggestion_id
                                            from formation_suggestion
                                            JOIN formation_category
                                            ON formation_suggestion.formation_category_id = formation_category.formation_category_id
                                            join formateur on formation_suggestion.formateur_id=formateur.formateur_id ";

                                            // Prepare and execute the statement
                                            $req = $conn->prepare($sql);
                                            $req->execute();
                                            if ($req->rowCount() == 0) {
                                            ?>
                                            <tr>
                                                <td>No data in the table</td>
                                            </tr>
                                    <?php } ?>

                                    <?php while ($row = $req->fetch()) { ?>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                    <?php echo $row["first_name"] ?>
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                    <?php echo $row["title"] ?>
                                                    </p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                    <?php echo $row["description"] ?>
                                                    </p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                    <?php echo $row["category_name"] ?>
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
                                            <?php if ($row["etat"] == "encours") { ?>
                                                    <td class="border-bottom-0">
                                                        <a href="accept.php?suggestion=<?php echo $row["formation_suggestion_id"] ?>"
                                                            class="btn btn-outline-warning m-1">Accept</a>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                         <a onclick="return confirm('Are you sure you want to deny?')"  href="refus.php?suggestion=<?php echo $row["formation_suggestion_id"] ?>"
                                                            class="btn btn-outline-danger m-1">Deny</a>
                                                    </td>
                                                <?php
                                            } ?>
                                            </tr>

                                        <?php
                                    }}
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ('../layouts/footer.php'); ?>