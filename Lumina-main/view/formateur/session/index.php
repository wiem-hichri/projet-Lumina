<?php
session_start();

if (!isset($_SESSION['formateur'])) {
    header("location:../auth/login.php");
}
include ('../layouts/header.php');
include ("../../../config.php");
?>

<div class="container-fluid">
    <h5 class="card-title fw-semibold mb-4">Sessions</h5>

    <div class="row"> <?php
    // Get today's date
    $today = date("Y-m-d");

    // SQL query to select sessions
    $sql = "SELECT session.title, session.description, session.start_date, session.end_date, session.niveau, 
            formation.title AS formation_title, promotion.title AS promotion_title, session.session_id as session_id
            FROM session 
            JOIN formation ON session.formation_id = formation.formation_id 
            JOIN promotion ON session.promotion_id = promotion.promotion_id
            
            WHERE session.session_id NOT IN (
                SELECT DISTINCT session_id FROM fiche_demande WHERE status = 'accepte' or formateur_id= ?
            )";

    $req = $conn->prepare($sql);
    $req->execute([$_SESSION["formateur_id"]]);
    if ($req->rowCount() == 0) { ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">No sessions found</h5>
                    </div>
                </div>
            </div>

        <?php }
    while ($row = $req->fetch()) {

        ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["title"] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $row["formation_title"] ?></h6>
                        <p class="card-text"><?php echo $row["description"] ?></p>



                        <p class="card-text">
                            <strong>Start Date:</strong> <?php echo ($row["start_date"]); ?><br>
                            <strong>End Date:</strong> <?php echo ($row["end_date"]); ?>
                        </p>
                        <p class="card-text">
                            <strong>Niveau:</strong> <?php echo ($row["niveau"]); ?><br>
                        </p>

                        <a href="demande.php?session=<?php echo $row["session_id"] ?>"
                            onclick="return confirm('are you sure you wanna teach this session ?')"
                            class="btn btn-outline-warning">Depot de demande</a>
                        <!-- <?php if ($row["start_date"] > $today) { ?> -->
                            <!-- <?php } else { ?>
                            <a class="btn btn-success disabled">Session started</a>
                            <?php
                        } ?> -->

                    </div>
                </div>
            </div>
            <?php
    } ?>
    </div>


</div>
<?php include ('../layouts/footer.php'); ?>