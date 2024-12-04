<?php session_start();
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Courses | Education</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/dashboard/images/logos/light-bulb.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="../../assets/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/home/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/home/css/slicknav.css">
    <link rel="stylesheet" href="../../assets/home/css/flaticon.css">
    <link rel="stylesheet" href="../../assets/home/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="../../assets/home/css/gijgo.css">
    <link rel="stylesheet" href="../../assets/home/css/animate.min.css">
    <link rel="stylesheet" href="../../assets/home/css/animated-headline.css">
    <link rel="stylesheet" href="../../assets/home/css/magnific-popup.css">
    <link rel="stylesheet" href="../../assets/home/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../assets/home/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/home/css/slick.css">
    <link rel="stylesheet" href="../../assets/home/css/nice-select.css">
    <link rel="stylesheet" href="../../assets/home/css/style.css">

</head>

<body>
    <!-- ? Preloader Start -->
    <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../../assets/home/img/logo/light-bulb.png" alt="">
                </div>
            </div>
        </div>
    </div> -->
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="home.php"><img src="../../assets/home/Lumina__2_-removebg-preview.png"
                                            width="200px"></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">
                                                <li class="active"><a href="home.php">Home</a></li>
                                                <li><a href="session.php">Sessions</a></li>
                                                <li><a href="about.php">About</a></li>
                                                <li><a href="contact.php">Contact</a></li>
                                                                                               <li><a href="../participant/participations.php">My sessions</a></li>

                                                <!-- Button -->
                                                <?php if (!isset($_SESSION['participant'])) { ?>
                                                    <li class="button-header margin-left "><a href="../participant/auth/register1.php"
                                                            class="btn">Join</a>
                                                    </li>
                                                    <li class="button-header"><a href="../participant/auth/login.php" class="btn btn3">Log
                                                            in</a></li>
                                                    <?php
                                                } else { ?>

                                                    <li class="button-header margin-left "><a href="../participant/profile1.php"
                                                            class="btn">My profile</a>
                                                    </li>
                                                    <li class="button-header"><a href="../participant/auth/logout.php" class="btn btn3">Log
                                                            out</a></li>
                                                    <?php
                                                } ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>