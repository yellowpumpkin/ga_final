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
                        <a class="nav-link" href="index"><i class="bi bi-house"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="information"><i class="bi bi-text-left"></i> Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report"><i class="bi bi-tools"></i> Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  active" href="sign-in"><i class="bi bi-box-arrow-right"></i> Administrator</a>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>

    <section id="about">
        <div class="container">
            <?php if(isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
            </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
            </div>
            <?php } ?>

            <h3>Log in</h3>
            <hr>
            <form action="db_sign-in.php" method="post">
              
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" aria-describedby="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <!-- <a class="btn btn-secondary" href="sign-up">Sign-Up</a> -->
                <button type="submit" name="sign_in" class="btn btn-brand ms-lg-3" style="float: right;">Sign
                    In</button>
            </form>

        </div>

    </section>

    <footer>
        <div class="footer-top text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 ">
                        <h4 class="navbar-brand">Siam Kyohwa Seisakusho</h4>
                        <p> Factory : 727/7 Moo 1, Tambol Klong Kiew, Ampur Ban Bung, Chonburi.
                            Tel.  +66-38-158439-41  Fax.  +66-38-158437, +66-38-26351</p>
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