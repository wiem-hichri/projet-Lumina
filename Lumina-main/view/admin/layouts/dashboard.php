<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:../auth/login.php");
}
include ('header.php');
include ('../../../config.php');

?>

<div class="container-fluid">
    <!--  Row 1 -->
    <?php include ('../layouts/message.php'); ?>

    <div class="row">
        <div class=" d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">
                        Table Overview
                    </h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">My tables</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Admin</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Trainer</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Participant</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Formation Category</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Formation</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr><td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Number of rows</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">
                                            <?php $sql = "SELECT count(*) as nb from admin";
                                            $req = $conn->prepare($sql);
                                            $req->execute();
                                            $row = $req->fetch();
                                            echo $row["nb"]; ?>
                                        </p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">
                                            <?php $sql = "SELECT count(*) as nb from formateur";
                                            $req = $conn->prepare($sql);
                                            $req->execute();
                                            $row = $req->fetch();
                                            echo $row["nb"]; ?>
                                        </p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">
                                            <?php $sql = "SELECT count(*) as nb from participant";
                                            $req = $conn->prepare($sql);
                                            $req->execute();
                                            $row = $req->fetch();
                                            echo $row["nb"]; ?>
                                        </p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">
                                            <?php $sql = "SELECT count(*) as nb from formation_category";
                                            $req = $conn->prepare($sql);
                                            $req->execute();
                                            $row = $req->fetch();
                                            echo $row["nb"]; ?>
                                        </p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">
                                            <?php $sql = "SELECT count(*) as nb from formation";
                                            $req = $conn->prepare($sql);
                                            $req->execute();
                                            $row = $req->fetch();
                                            echo $row["nb"]; ?>
                                        </p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">
            Design and Developed by
            <a href="https://github.com/nermine-ouada/Lumina " target="_blank"
                class="pe-1 text-primary text-decoration-underline">Lumina</a>
        </p>
    </div>
</div>
<?php include ('footer.php'); ?>