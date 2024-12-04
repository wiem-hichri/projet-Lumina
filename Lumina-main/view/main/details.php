<?php include ('header.php');
include ("../../config.php"); ?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }



    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        /* Center the cards horizontally */
    }

    .col-xl-4,
    .col-lg-4,
    .col-md-6 {
        padding: 15px;
        box-sizing: border-box;
        width: 100%;
        max-width: 350px;
        /* Increase the maximum width of the cards */
    }

    @media (min-width: 768px) {
        .col-md-6 {
            width: 50%;
        }
    }

    @media (min-width: 992px) {
        .col-lg-4 {
            width: 33.333%;
        }
    }

    @media (min-width: 1200px) {
        .col-xl-4 {
            width: 33.333%;
        }
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Added shadow effect */
        transition: transform 0.3s, box-shadow 0.3s;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        /* Increased shadow effect on hover */
    }

    .card-body {
        padding: 30px;
    }

    .card-title {
        font-size: 2rem;
        /* Increase the font size of the card title */
        margin-bottom: 20px;
        color: #007bff;
        font-weight: bold;
        text-align: center;
        /* Center the text horizontally */
    }

    .card-text {
        font-size: 1.25rem;
        /* Increase the font size of the card text */
        margin-bottom: 15px;
        color: #555555;
        text-align: center;
        /* Center the text horizontally */
    }

    .participate-button {
        display: block;
        width: 100%;
        padding: 10px 0;
        margin-top: 20px;
        text-align: center;
        background-color: #007bff;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .participate-button:hover {
        background-color: #0056b3;
    }
</style>
<?php


// Ensure the 'session' parameter is provided in the URL
if (!isset($_GET['session'])) {
    die('Session ID not provided.');
}

// Fetch data from the session table based on session ID
$session_id = $_GET['session'];
$sql = "SELECT session.title AS session_title, session.start_date, session.end_date,
                   formation.title AS formation_title, promotion.title AS promotion_title,
                   formateur.first_name AS formateur_name,session.session_id AS session_id
            FROM session
            JOIN formation ON session.formation_id = formation.formation_id 
            JOIN promotion ON session.promotion_id = promotion.promotion_id
            JOIN fiche_demande ON fiche_demande.session_id = session.session_id
            JOIN formateur ON fiche_demande.formateur_id = formateur.formateur_id
            WHERE session.session_id=? AND fiche_demande.status = 'accepte'";
$req = $conn->prepare($sql);
$req->execute([$session_id]);
$row = $req->fetch();
// Debug output
if ($req->rowCount() === 0) {
    die('No sessions found for the provided session ID or no accepted requests.');
}
?>
<main>
    <section class="slider-area slider-area2">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height1">
                <div class="container">
                    <div class="row">
                        <div class="col-m col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <!-- breadcrumb End -->
                                <h1 data-animation="bounceIn" data-delay="0.2s">
                                    <?php echo ($row['session_title']); ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Formation: <?php echo ($row['formation_title']); ?></h5>

                        <p class="card-text" style="font-size: 2rem;">Formateur:
                            <?php echo ($row['formateur_name']); ?>
                        </p>


                        <p class="card-text" style="font-size: 1.5rem;">Promotion Title:
                            <?php echo ($row['promotion_title']); ?>
                        </p>
                        <p class="card-text" style="font-size: 1.5rem;">Start Date:
                            <?php echo ($row['start_date']); ?>
                        </p>
                        <p class="card-text" style="font-size: 1.5rem;">End Date: <?php echo ($row['end_date']); ?>
                        </p>
                        <?php
                        $sqlParticipatedSessions = "SELECT session_id FROM fiche_suivi WHERE session_id = ?";
                        $reqParticipatedSessions = $conn->prepare($sqlParticipatedSessions);
                        $reqParticipatedSessions->execute([$row['session_id']]);
                        if ($reqParticipatedSessions->rowCount() == 0) {
                            ?>

                            <a href="../participant/participate.php?session=<?php echo ($row['session_id']); ?>"
                                onclick="confirmParticipate();" class="participate-button">Participate</a>
                            <?php
                        } else {
                            ?><a  class="participate-button disabled">Already enrolled</a>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    function confirmParticipate(sessionId) {
        var confirmation = confirm("Are you sure you want to participate?");
        if (confirmation) {
            window.location.href = "../participant/participate.php?session=" + sessionId;
        }
    }
</script>

<?php
include ('footer.php');
?>