<?php include ('header.php');
include ("../../config.php"); ?>
<main>
    <!--? slider Area Start-->
    <section class="slider-area ">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-12">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay="0.2s">Online learning<br> platform</h1>
                                <p data-animation="fadeInLeft" data-delay="0.4s">Build skills with courses,
                                    certificates, and degrees online from world-class universities and companies</p>
                                <a href="../participant/auth/register1.php"  class="btn hero-btn"
                                    data-animation="fadeInLeft" data-delay="0.7s">Join for
                                    Free</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ? services-area -->
    <div class="services-area">
        <div class="container">
            <div class="row justify-content-sm-center">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="../../assets/home/img/icon/icon1.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>60+ UX courses</h3>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="../../assets/home/img/icon/icon2.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>Expert instructors</h3>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30">
                        <div class="features-icon">
                            <img src="../../assets/home/img/icon/icon3.svg" alt="">
                        </div>
                        <div class="features-caption">
                            <h3>Life time access</h3>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Courses area start -->
    <div class="courses-area section-padding40 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Our featured courses</h2>
                    </div>
                </div>
            </div>

            <div class="courses-actives">
                <!-- Single -->
                <?php
                // Get today's date
                $today = date("Y-m-d");

                // SQL query to select sessions
                $sql = "SELECT session.title, session.description, session.start_date, session.end_date, session.niveau,session.price, 
            formation.title AS formation_title, promotion.title AS promotion_title, session.session_id AS session_id
            FROM session 
            JOIN formation ON session.formation_id = formation.formation_id 
            JOIN promotion ON session.promotion_id = promotion.promotion_id
            JOIN fiche_demande ON fiche_demande.session_id = session.session_id
            WHERE session.end_date >= :today AND status='accepte' ";


                $req = $conn->prepare($sql);
                $req->bindParam(':today', $today);
                $req->execute();

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

                                    <a href="details.php?session=<?php echo $row['session_id'] ?>"
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
    <!--? About Area-1 Start -->
    <section class="about-area1 fix pt-10">
        <div class="support-wrapper align-items-center">
            <div class="left-content1">
                <div class="about-icon">
                    <img src="../../assets/home/img/icon/about.svg" alt="">
                </div>
                <!-- section tittle -->
                <div class="section-tittle section-tittle2 mb-55">
                    <div class="front-text">
                        <h2 class="">Learn new skills online with top educators</h2>
                        <p>The automated process all your website tasks. Discover tools and
                            techniques to engage effectively with vulnerable children and young
                            people.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="../../assets/home/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Techniques to engage effectively with vulnerable children and young people.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="../../assets/home/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Join millions of people from around the world learning together.</p>
                    </div>
                </div>

                <div class="single-features">
                    <div class="features-icon">
                        <img src="../../assets/home/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Join millions of people from around the world learning together. Online learning is as easy
                            and natural.</p>
                    </div>
                </div>
            </div>
            <div class="right-content1">
                <!-- img -->
                <div class="right-img">
                    <img src="../../assets/home/img/gallery/video1.jpg" alt="">

                    <div class="video-icon">
                        <a class="popup-video btn-icon" href="https://www.youtube.com/watch?v=eNvuZW7Gp5w"><i
                                class="fas fa-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->
    <!--? top subjects Area Start -->
    <div class="topic-area section-padding40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Explore top subjects</h2>
                    </div>
                </div>
            </div>
            <?php $sql = "select * from formation_category limit 8";
            $req = $conn->prepare($sql);
            $req->execute();
            ?>

            <div class="row">
                <?php while ($row = $req->fetch()) { ?>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="../../assets/home/img/gallery/topic5.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="#"><?php echo $row["category_name"]; ?></a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="section-tittle text-center mt-20">
                        <a href="courses.html" class="border-btn">View More Subjects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top subjects End -->
    <!--? About Area-3 Start -->
    <section class="about-area3 fix">
        <div class="support-wrapper align-items-center">
            <div class="right-content3">
                <!-- img -->
                <div class="right-img">
                    <img src="../../assets/home/img/gallery/about3.png" alt="">
                </div>
            </div>
            <div class="left-content3">
                <!-- section tittle -->
                <div class="section-tittle section-tittle2 mb-20">
                    <div class="front-text">
                        <h2 class="">Learner outcomes on courses you will take</h2>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="../../assets/home/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Techniques to engage effectively with vulnerable children and young people.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="../../assets/home/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Join millions of people from around the world
                            learning together.</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="features-icon">
                        <img src="../../assets/home/img/icon/right-icon.svg" alt="">
                    </div>
                    <div class="features-caption">
                        <p>Join millions of people from around the world learning together.
                            Online learning is as easy and natural.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->
    <!--? Team -->
    <section class="team-area section-padding40 fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Community experts</h2>
                    </div>
                </div>
            </div>
            <div class="team-active">
                <div class="single-cat text-center">
                    <div class="cat-icon">
                        <img src="../../assets/dashboard/images/profile/nermine.jpg" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Miss. Nermine Ouada</a></h5>
                        <p>IT Student and CO founder of Lumina</p>
                    </div>
                </div>
                <div class="single-cat text-center">
                    <div class="cat-icon">
                        <img src="../../assets/dashboard/images/profile/ons.jpg" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Miss. Ons ben Amara</a></h5>
                        <p>IT Student and CO founder of Lumina</p>
                    </div>
                </div>
                <div class="single-cat text-center">
                    <div class="cat-icon">
                        <img src="../../assets/dashboard/images/profile/tesnim.jpg" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Miss. Tesnim Rhaiem</a></h5>
                        <p>IT Student and CO founder of Lumina</p>
                    </div>
                </div>
                <div class="single-cat text-center">
                    <div class="cat-icon">
                        <img src="../../assets/dashboard/images/profile/wiem1.jpg" alt="">
                    </div>
                    <div class="cat-cap">
                        <h5><a href="services.html">Miss. Wiem Hichri</a></h5>
                        <p>IT Student and CO founder of Lumina</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Services End -->
    <!--? About Area-2 Start -->
    <section class="about-area2 fix pb-padding">
        <div class="support-wrapper align-items-center">
            <div class="right-content2">
                <!-- img -->
                <div class="right-img">
                    <img src="../../assets/home/img/gallery/about2.png" alt="">
                </div>
            </div>
            <div class="left-content2">
                <!-- section tittle -->
                <div class="section-tittle section-tittle2 mb-20">
                    <div class="front-text">
                        <h2 class="">Take the next step
                            toward your personal
                            and professional goals
                            with us.</h2>
                        <p>The automated process all your website tasks. Discover tools and techniques to engage
                            effectively with vulnerable children and young people.</p>
                        <a href="#" class="btn">Join now for Free</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Area End -->
</main>

<?php include ('footer.php') ?>