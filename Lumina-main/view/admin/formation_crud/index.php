<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
    exit();
}

include ('../layouts/header.php');
require '../../../config.php';
?>

<div class="container-fluid">
    <?php include ('../layouts/message.php'); ?>
    <div class="row">
        <form action="index.php" method="GET">
            <div class="d-sm-flex d-block align-items-center justify-content mb-9">
                <input type="text" class="form-control w-50" name="search" placeholder="Filter by search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit" class="btn btn-outline-primary m-3">Filter</button>
                <?php if (isset($_GET["search"])) { ?>
                    <a href="index.php" class="btn btn-danger m-3">Undo search</a>
                <?php } ?>
            </div>
        </form>

        <div class="d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Formation Table</h5>
                        </div>
                        <div>
                            <a href="create.php" class="btn btn-primary">Add new formation</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Title & Category</h6></th>
                                    <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Description</h6></th>
                                    <th class="border-bottom-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = 'SELECT title, description, category_name, formation.formation_id 
                                        FROM formation 
                                        JOIN formation_category ON formation.formation_category_id = formation_category.formation_category_id';
                                
                                $params = [];
                                if (isset($_GET['search'])) {
                                    $search = '%' . $_GET["search"] . '%';
                                    $sql .= ' WHERE title LIKE ? OR description LIKE ? OR category_name LIKE ?';
                                    $params = [$search, $search, $search];
                                }

                                $req = $conn->prepare($sql);
                                $req->execute($params);

                                if ($req->rowCount() == 0) {
                                    echo '<tr><td colspan="3">No data found</td></tr>';
                                } else {
                                    while ($row = $req->fetch()) {
                                        $formation_id = $row["formation_id"];
                                        $sql1 = 'SELECT count(*) as nb FROM module WHERE formation_id=?';
                                        $req2 = $conn->prepare($sql1);
                                        $req2->execute([$formation_id]);
                                        $nb = $req2->fetch();

                                        $title = htmlspecialchars($row['title']);
                                        $category_name = htmlspecialchars($row['category_name']);
                                        $description = htmlspecialchars($row['description']);
                                        ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="mb-0 fw-semibold"><?= $title ?></h6>
                                                <span class="fw-normal"><?= $category_name ?></span>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $description ?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a onclick="return confirm('Are you sure you want to add a new module to <?= $title ?>?')"
                                                    href="../module_crud/create.php?formation_id=<?= $formation_id ?>"
                                                    class="btn btn-primary m-1">Add module</a>
                                            </td>
                                            <td class="border-bottom-0">
                                                <?php if ($nb["nb"] != 0) { ?>
                                                    <a onclick="return confirm('Are you sure you want to add <?= $title ?> to a new session?')"
                                                        href="../session_crud/create.php?formation_id=<?= $formation_id ?>"
                                                        class="btn btn-outline-primary m-1">Add to a session</a>
                                                <?php } else { ?>
                                                    <a class="btn btn-outline-danger disabled m-1">Cannot add to session</a>
                                                <?php } ?>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a href="edit.php?formation_id=<?= $formation_id ?>"
                                                    class="btn btn-outline-warning m-1">Edit</a>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a onclick="return confirm('Are you sure you want to delete?')"
                                                    href="delete.php?formation_id=<?= $formation_id ?>"
                                                    class="btn btn-outline-danger m-1">Delete</a>
                                            </td>
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
