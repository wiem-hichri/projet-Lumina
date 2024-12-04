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
        <div class="d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Suggestion pending suggestions</h5>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Frormateur & specialite</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Session</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Start date</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">End date</h6>
                                    </th>
<th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">status</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT formateur.first_name AS first_name, 
                                        formation.formation_id AS formation_id, 
                                        formateur.last_name AS last_name,
                                        session.title AS session, 
                                        fiche_demande.status AS status,
                                        fiche_demande.fiche_demande_id AS demande_id,
                                        formateur.specialite as specialite,
                                        session.start_date as start_date ,
                                        session.end_date as end_date

                                    FROM fiche_demande 
                                    JOIN session ON session.session_id = fiche_demande.session_id
                                    JOIN formation ON formation.formation_id = session.formation_id
                                    JOIN formateur ON formateur.formateur_id = fiche_demande.formateur_id
                                  "
                                   ;

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
                                                <h6 class="fw-semibold mb-1">
                                                    <?php echo $row["first_name"] ?>
                                                            <?php echo $row["last_name"] ?>
                                                
                                                        </h6>
                                                        <span class="fw-normal"><?= $row["specialite"] ?></span>
                                                
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">
                                                            <?php echo $row["session"] ?>
                                                        </p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">
                                                            <?php echo $row["start_date"] ?>
                                                        </p>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <p class="mb-0 fw-normal">
                                                            <?php echo $row["end_date"] ?>
                                                        </p>
                                                    </td>
                                                    
                                                <?php if ($row["status"] == "encours") { ?>
                                                    <td class="border-bottom-0">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-warning rounded-3 fw-semibold">Pending</span>
                                                        </div>
                                                    </td>
                                                    <?php
                                                } ?>
                                                <?php if ($row["status"] == "refuse") { ?>
                                                    <td class="border-bottom-0">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-danger rounded-3 fw-semibold">Denied</span>
                                                        </div>
                                                    </td>
                                                    <?php
                                                } ?>
                                                <?php if ($row["status"] == "accepte") { ?>
                                                    <td class="border-bottom-0">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="badge bg-success rounded-3 fw-semibold">Accepted</span>
                                                        </div>
                                                    </td>
                                                    <?php
                                                } ?>
                                                <?php if ($row["status"] == "encours") { ?>
                                                    <td class="border-bottom-0">
                                                        <a href="accept.php?demande=<?php echo $row["demande_id"] ?>"
                                                            class="btn btn-outline-warning m-1">Accept</a>
                                                    </td>
                                                    <td class="border-bottom-0">
                                                        <a onclick="return confirm('Are you sure you want to deny?')"
                                                            href="refus.php?demande=<?php echo $row["demande_id"] ?>"
                                                            class="btn btn-outline-danger m-1">Deny</a>
                                                    </td>
                                                    <?php
                                                } ?>
                                                
                                                </tr>  
                                    <?php }
                                 
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