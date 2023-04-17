<?php 

    session_start();
    require_once 'config/db.php';

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="skicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <title>Siam Kyohwa Seisakusho</title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">


    <!-- TOP NAV -->
    <div class="top-nav" id="home">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <p> <i class='bx bxs-envelope'></i> sale@siamkyohwa.co.th</p>
                    <p> <i class='bx bxs-phone-call'></i> 064 159 1177</p>

                </div>
                <div class="col-auto social-icons">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-pinterest'></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#"><span class="dot"></span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home"><i class="bi bi-house"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="information"><i class="bi bi-text-left"></i> Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report"><i class="bi bi-tools"></i> Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sign-in"><i class="bi bi-box-arrow-right"></i> Administrator</a>
                    </li>
                </ul>
                <!-- <a href="sign-in" 
                    class="btn btn-brand ms-lg-3">Sign-in</a> -->
            </div>
        </div>
    </nav>

    <!-- SLIDER -->
    <div class="owl-carousel owl-theme hero-slider">
        <div class="slide slide1">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 text-white">

                        <h1 class="display-3 my-4">Report problems using space and equipment common facilities System
                        </h1>
                        <a href="report" class="btn btn-brand">Report</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide slide2">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 text-white">
                        <!-- <h1 class="text-white text-uppercase">
                            ระบบรายงานปัญหาการใช้พื้นที่และอุปกรณ์สิ่งอำนวยความสะดวกส่วนกลาง </h1> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ABOUT -->
    <!-- <section id="about">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-5 py-5">
                    <div class="row"> -->

    <!-- <div class="col-12">
                            <div class="info-box">
                                <img src="img/icon6.png" alt="">
                                <div class="ms-4">
                                    <h5>Digital Marketing</h5>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a page </p>
                                </div>
                            </div>
                        </div> -->
    <!-- <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="img/icon4.png" alt="">
                                <div class="ms-4">
                                    <h5>E-mail Marketing</h5>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a page </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="img/icon5.png" alt="">
                                <div class="ms-4">
                                    <h5>Buisness Marketing</h5>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a page </p>
                                </div>
                            </div>
                        </div> -->
    <!-- </div> -->
    <!-- </div> -->
    <!-- <div class="col-lg-5">
                    <img src="img/about.png" alt="">
                </div> -->
    <!-- </div>
        </div>
    </section> -->


    <section class="bg-light" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <!-- <h6>PRODUCT</h6> -->
                        <h1>Activities</h1>
                        <!-- <p class="mx-auto">Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                            roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p> -->
                    </div>
                </div>
            </div>
        </div>
        <div id="projects-slider" class="owl-theme owl-carousel">
            <div class="project">
                <div class="overlay"></div>
                <img src="img/ga1.jpg" alt="">
                <div class="content">
                    <!-- <h2>PALLET</h2>
                    <h6>We produce all types of standard woodenpallets and special designs according to customers’
                        requirements.</h6> -->
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/ga2.jpg" alt="">
                <div class="content">
                    <!-- <h2>PALLET</h2>
                    <h6>High quality wood. / Strong and durable.</h6> -->
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/ga3.jpg" alt="">
                <div class="content">
                    <!-- <h2>WOODEN BOXES</h2>
                    <h6>We produce alltypes of wooden boxes made of various types of wood such as plywood, pine wood, eucalyptus wood, etc.</h6> -->
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/ga4.jpg" alt="">
                <div class="content">
                    <!-- <h2>WOODEN BOXES</h2>
                    <h6>To prevent products from being broken . / Suitable for specific lengths of products. </h6> -->
                </div>
            </div>

        </div>
    </section>
    <!-- MILESTONE -->
    <section id="milestone">
        <div class="container">
            <div class="row text-center justify-content-center gy-4">
                <!-- <div class="col-lg-2 col-sm-6"
                >
                    <h1 class="display-4">90K+</h1>
                    <p class="mb-0">Happy Clients</p>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <h1 class="display-4">45M</h1>
                    <p class="mb-0">Lines of code</p>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <h1 class="display-4">190</h1>
                    <p class="mb-0">Total Downloads</p>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <h1 class="display-4">380K</h1>
                    <p class="mb-0">YouTube Subscribers</p>
                </div> -->
            </div>
        </div>
    </section>


    <section id="team">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h1>Team Members (GA)</h1>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="team-member">
                        <div class="image">
                            <img src="img/s.jpg" alt="">
                            <div class="social-icons">
                                <a href="#"><i class='bx bxl-facebook'></i></a>
                                <a href="#"><i class='bx bxl-twitter'></i></a>
                                <a href="#"><i class='bx bxl-instagram'></i></a>
                                <a href="#"><i class='bx bxl-pinterest'></i></a>
                            </div>
                            <div class="overlay"></div>
                        </div>

                        <h5>Sorapong Chatarerk</h5>
                        <p>GA</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="team-member">
                        <div class="image">
                            <img src="img/a.jpg" alt="">
                            <div class="social-icons">
                                <a href="#"><i class='bx bxl-facebook'></i></a>
                                <a href="#"><i class='bx bxl-twitter'></i></a>
                                <a href="#"><i class='bx bxl-instagram'></i></a>
                                <a href="#"><i class='bx bxl-pinterest'></i></a>
                            </div>
                            <div class="overlay"></div>
                        </div>

                        <h5>Tunpitcha Veeradeeranon</h5>
                        <p>GA</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="team-member">
                        <div class="image">
                            <img src="img/m.jpg" alt="">
                            <div class="social-icons">
                                <a href="#"><i class='bx bxl-facebook'></i></a>
                                <a href="#"><i class='bx bxl-twitter'></i></a>
                                <a href="#"><i class='bx bxl-instagram'></i></a>
                                <a href="#"><i class='bx bxl-pinterest'></i></a>
                            </div>
                            <div class="overlay"></div>
                        </div>
                        <h5>Chanon Tanmoun</h5>
                        <p>GA</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-top text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 ">
                        <h4 class="navbar-brand">Siam Kyohwa Seisakusho</h4>
                        <p> Factory : 727/7 Moo 1, Tambol Klong Kiew, Ampur Ban Bung, Chonburi.
                            Tel. +66-38-158439-41 Fax. +66-38-158437, +66-38-26351</p>
                        <div class="col-auto social-icons">
                            <a href="https://www.facebook.com/skpallet2539"><i class='bx bxl-facebook'></i></a>
                            <a href="#"><i class='bx bxl-twitter'></i></a>
                            <a href="#"><i class='bx bxl-instagram'></i></a>
                            <a href="#"><i class='bx bxl-pinterest'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <p class="mb-0">Copyright © 2015 Siam Kyohwa Seisakusho Co., Ltd., </p>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>