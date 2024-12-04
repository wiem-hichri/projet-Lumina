<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
include ("../../../config.php");


?>

<div class="container-fluid">
    <?php include ('../layouts/message.php'); ?>

    <div class="row">
        <form action="index.php" method="GET">
            <div class="d-sm-flex d-block align-items-center justify-content mb-9">
                <input type="text" class="form-control w-50" name="search" placeholder="Filter by search">
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
                            <h5 class="card-title fw-semibold">Admin Table</h5>
                        </div>

                        <div>
                            <a href="create.php" class="btn btn-primary">Add new admin</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Name & poste</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Email</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">CIN</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Phone Number</h6>
                                    </th>
                                    
                                    <th class="border-bottom-0">
                                    </th>
                                    <th class="border-bottom-0">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!isset($_GET['search'])) {
                                    // Pagination configuration
                                    $recordsPerPage = 5; // Number of records to display per page
                                
                                    // Determine current page
                                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                    $startFrom = ($page - 1) * $recordsPerPage;

                                    // Fetch records for the current page
                                    $sql = "SELECT * FROM admin LIMIT :startFrom, :recordsPerPage";
                                    $req = $conn->prepare($sql);
                                    $req->bindParam(':startFrom', $startFrom, PDO::PARAM_INT);
                                    $req->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
                                    $req->execute();

                                    // Display records
                                    if ($req->rowCount() > 0) {
                                        while ($row = $req->fetch()) {
                                            ?>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"><?= $row["first_name"] ?>             <?= $row["last_name"] ?>
                                                    </h6>
                                                    <span class="fw-normal"><?= $row["poste"] ?></span>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["email"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["cin"] ?></p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal"><?= $row["tel"] ?></p>
                                                </td>
                                                
                                                <td class="border-bottom-0">
                                                    <a href="edit.php?admin_id=<?= $row["admin_id"] ?>"
                                                        class="btn btn-outline-warning m-1">Edit</a>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a onclick="return confirm('Are you sure you want to delete?')"
                                                        href="delete.php?admin_id=<?= $row["admin_id"] ?>"
                                                        class="btn btn-outline-danger m-1">Delete</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="7">No data in the table</td>
                                        </tr>
                                        <?php
                                    }

                                    // Pagination links
                                    $totalRecords = $conn->query("SELECT COUNT(*) AS total FROM admin")->fetch()['total'];
                                    $totalPages = ceil($totalRecords / $recordsPerPage);

                                    if ($totalPages > 1) {
                                        ?>
                                        <ul class="pagination">
                                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                                <li class="page-item<?= ($i == $page) ? ' active' : '' ?>">
                                                    <a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a>
                                                </li>
                                            <?php endfor; ?>
                                        </ul>
                                        <?php
                                    }
                                } else if (isset($_GET["search"])) {
                                    // Pagination configuration
                                    $recordsPerPage = 1; // Number of records to display per page
                                
                                    // Determine current page
                                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                    $startFrom = ($page - 1) * $recordsPerPage;

                                    // Fetch records for the current page
                                    $search = '%' . $_GET["search"] . '%';

                                    $sql = 'SELECT * FROM admin 
                                        WHERE first_name LIKE :search 
                                        OR last_name LIKE :search 
                                        OR email LIKE :search 
                                        OR poste LIKE :search 
                                        OR tel LIKE :search 
                                        OR cin LIKE :search 
                                        LIMIT :startFrom, :recordsPerPage';


                                    $req = $conn->prepare($sql);
                                    $req->bindParam(':search', $search);
                                    $req->bindParam(':startFrom', $startFrom, PDO::PARAM_INT);
                                    $req->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
                                    $req->execute();

                                    // Display records
                                    if ($req->rowCount() > 0) {
                                        while ($row = $req->fetch()) {
                                            ?>
                                                <tr>
                                                    <td class="border-bottom-0">
                                                        <h6 class="fw-semibold mb-1"><?= $row["first_name"] ?>             <?= $row["last_name"] ?>
                                                        </h6>
                                                        <span class="fw-normal"><?= $row["poste"] ?></span>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"><?= $row["email"] ?></p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"><?= $row["cin"] ?></p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal"><?= $row["tel"] ?></p>
                                                    </td>
                                                   
                                                    <td class="border-bottom-0">
                                                        <a href="edit.php?admin_id=<?= $row["admin_id"] ?>"
                                                            class="btn btn-outline-warning m-1">Edit</a>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <a onclick="return confirm('Are you sure you want to delete?')"
                                                            href="delete.php?admin_id=<?= $row["admin_id"] ?>"
                                                            class="btn btn-outline-danger m-1">Delete</a>
                                                    </td>
                                                </tr>
                                        <?php }
                                    } else {
                                        ?>
                                            <tr>
                                                <td colspan="7">No data in the table</td>
                                            </tr>
                                        <?php
                                    }

                                    // Pagination links
                                    $countSql = 'SELECT COUNT(*) AS total FROM admin 
                                            WHERE first_name LIKE :search 
                                            OR last_name LIKE :search 
                                            OR email LIKE :search 
                                            OR poste LIKE :search 
                                            OR tel LIKE :search 
                                            OR cin LIKE :search';
                                    $totalRecords = $conn->prepare($countSql);
                                    $totalRecords->bindParam(':search', $search);
                                    $totalRecords->execute();
                                    $totalRecordsCount = $totalRecords->fetchColumn();
                                    $totalPages = ceil($totalRecordsCount / $recordsPerPage);
                                    if ($totalPages > 1) {
                                        ?>
                                            <ul class="pagination">
                                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                                    <li class="page-item<?= ($i == $page) ? ' active' : '' ?>">
                                                        <a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a>
                                                    </li>
                                            <?php endfor; ?>
                                            </ul>
                                        <?php
                                    }
                                }
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