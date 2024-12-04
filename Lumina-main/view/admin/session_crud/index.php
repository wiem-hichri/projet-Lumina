<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
require '../../../config.php';
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
                            <h5 class="card-title fw-semibold">Session Table</h5>
                        </div>

                        <div>
                            <a href="create.php" class="btn btn-primary">Add new Session</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Title & formation</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Description</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Start_Date</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">End_Date</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Niveau</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Price</h6>
                                    </th>
                                 
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Promotion</h6>
                                    </th>

                                    <th class="border-bottom-0">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!isset($_GET['search'])) {
                                    $sql = 'SELECT session.title, session.description, session.start_date, session.end_date, session.niveau,session.price, 
                                    formation.title AS formation_title, promotion.title AS promotion_title, session.session_id 
                                    FROM session 
                                    JOIN formation ON session.formation_id = formation.formation_id 
                                    JOIN promotion ON session.promotion_id = promotion.promotion_id';
                    

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
                                                <p class="mb-0 fw-semibold">
                                                    <?php echo $row["title"] ?>
                                                </p>  <span class="fw-normal">
                                                <?php echo $row["formation_title"] ?>
                                                </span>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    <?php echo $row["description"] ?>
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    <?php echo $row["start_date"] ?>
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">
                                                    <?php echo $row["end_date"] ?>
                                                </h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">
                                                    <?php echo $row["niveau"] ?>
                                                </h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">
                                                    <?php echo $row["price"] ?>
                                                </h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">
                                                    <?php echo $row["promotion_title"] ?>
                                                </h6>
                                            </td>

                                            <td class="border-bottom-0">
                                                <a href="edit.php?session_id=<?php echo $row["session_id"] ?>"
                                                    class="btn btn-outline-warning m-1">Edit</a>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a onclick="return confirm('Are you sure you want to delete?')"  href="delete.php?session_id=<?php echo $row["session_id"] ?>"
                                                    class="btn btn-outline-danger m-1">Delete</a>
                                            </td>

                                        </tr>
                                    <?php }
                                } else if (isset($_GET["search"])) {
                                    $search = '%' . $_GET["search"] . '%';
                                    $sql = 'SELECT session.title, session.description, session.start_date, session.end_date, session.niveau,session.price, 
                                    formation.title AS formation_title, promotion.title AS promotion_title, session.session_id 
                            FROM session 
                            JOIN formation ON session.formation_id = formation.formation_id 
                            JOIN promotion ON session.promotion_id = promotion.promotion_id 
                            WHERE session.title LIKE ? 
                                OR session.description LIKE ? 
                                OR session.start_date LIKE ?';
                    

                                    $req = $conn->prepare($sql);
                                    $req->execute([$search, $search, $search]);

                                    if ($req->rowCount() == 0) {
                                        ?>
                                            <tr>
                                                <td>No data found</td>
                                            </tr>
                                    <?php } ?>

                                    <?php while ($row = $req->fetch()) { ?>
                                        <tr>

                                        <td class="border-bottom-0">
                                            <h6 class="mb-0 fw-semibold">
                                                <?php echo $row["title"] ?>
                                    </h6>
                                            <span class="fw-normal">
                                                <?php echo $row["formation_title"] ?>
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">
                                                <?php echo $row["description"] ?>
                                            </p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">
                                                <?php echo $row["start_date"] ?>
                                            </p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">
                                                <?php echo $row["end_date"] ?>
                                            </h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">
                                                <?php echo $row["niveau"] ?>
                                            </h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">
                                                <?php echo $row["price"] ?>
                                            </h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">
                                                <?php echo $row["promotion_title"] ?>
                                            </h6>
                                        </td>

                                        <td class="border-bottom-0">
                                            <a href="edit.php?session_id=<?php echo $row["session_id"] ?>"
                                                class="btn btn-outline-warning m-1">Edit</a>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a onclick="return confirm('Are you sure you want to delete?')"  href="delete.php?session_id=<?php echo $row["session_id"] ?>"
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