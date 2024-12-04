<?php

session_start();

if (!isset($_SESSION['participant'])) {
    header("Location: auth/login.php");
    exit();
}include ('../../config.php');

include ('header.php');
?>

<main>
    <!--? slider Area Start-->
    <section class="slider-area slider-area2">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">My sessions</h1>
                                <!-- breadcrumb Start-->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">My sessions</a></li>
                                    </ol>
                                </nav>
                                <!-- breadcrumb End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Courses area start -->
    <div class="courses-area section-padding40 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>My sessions</h2>
                    </div>
                </div>
            </div>
              <div class="courses-actives">
                <!-- Single -->
                <?php
                // Get today's date
                $today = date("Y-m-d");

                // SQL query to select sessions
                $sql = "SELECT session.title, session.description, session.start_date, session.end_date, session.niveau, session.price, 
            formation.title AS formation_title, promotion.title AS promotion_title, session.session_id AS session_id
        FROM session 
        JOIN formation ON session.formation_id = formation.formation_id 
        JOIN promotion ON session.promotion_id = promotion.promotion_id
        JOIN fiche_suivi ON fiche_suivi.session_id = session.session_id
        WHERE fiche_suivi.participant_id = ?";


                $req = $conn->prepare($sql);
                $req->execute([$_SESSION['participant_id']]);
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
                    <div class="properties pb-20">
            
            
                        <div class="properties__card">
                            <div class="properties__img overlay1">
                                <a href="#"><img src="../../assets/home/img/gallery/featured5.png" alt=""></a>
                            </div>
                            <div class="properties__caption">
                                <p><?php echo $row["formation_title"] ?></p>
                                <h3><a href="#"><?php echo $row["title"] ?></a></h3>
                                <p><?php echo $row["niveau"] ?></p>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="price">
                                        <p>price:</p>
                                        $<?php echo $row["price"] ?>
                                    </div>
                                </div>
                                <?php if ($row["start_date"] > $today) { ?>
            
                                    <a href="../main/details.php?session=<?php echo $row['session_id'] ?>"
                                        class="border-btn border-btn border-btn2 ">Enroll now</a>
                                <?php } else { ?>
            
                                    <a class="border-btn border-btn border-btn2 disabled">Session started</a>
                                    <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
    <!-- Courses area End -->

</main>


<?php include ('footer.php') ?>