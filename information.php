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
    <!-- cdn data table   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />


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
                        <a class="nav-link active" href="information"><i class="bi bi-text-left"></i> Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report"><i class="bi bi-tools"></i> Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sign-in"><i class="bi bi-box-arrow-right"></i> Administrator</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>


 
    <div class="container">
        <div class="row">

            <main class="col-md-12 ml-sm-auto col-lg-12 px-md-4 py-4">
                <div class="row">
                  
                        <div class="card">
                            
                            <div class="d-flex align-items-center p-3 my-3 text-white bg-danger rounded shadow-sm">

                                <h1 class="h6 mb-0 text-white lh-1">
                                    <i class="fas fa-tasks"></i>
                                    ข้อมูลการรายงานปัญหาการใช้พื้นที่และอุปกรณ์สิ่งอำนวยความสะดวกส่วนกลาง Report
                                    problems using space and equipment common facilities.
                                </h1>
                            </div>
                            <div class="row">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <!-- <button type="button" class="btn btn-success mb-3 ml-1 " data-toggle="modal"
                                            data-target="#exampleModalCenter">+ เพิ่มข้อมูลสถานะ</button> -->
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
                                        <?php if(isset($_SESSION['warning'])) { ?>
                                        <div class="alert alert-warning" role="alert">
                                            <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                                        </div>
                                        <?php } ?>
                                        <table class="table  table-striped table-bordered table-hover">
                                            <thead>
                                                <th>No</th>
                                                <th>วันที่แจ้ง</th>
                                                <th>ชื่ออุปกรณ์</th>
                                                <th>สถานที่</th>
                                                <th>อาการเบื้องต้น</th>
                                                <th>ความเร่งด่วน</th>
                                                <th>ผู้แจ้ง</th>


                                                <th>สถานะ</th>
                                                <!-- <th>รูป</th> -->

                                            </thead>
                                            <tbody>
                                                <?php
                                                    $select_stmt = $conn->query("SELECT * FROM tbl_case 
                                                   
                                                    INNER JOIN tbl_status ON status = sid 
                                                    where case_status = '0'
                                                    ");
                                                    $select_stmt->execute();
                                                    $cases = $select_stmt->fetchAll();
                                               
                                                    $sth = $conn->prepare("SELECT status_name FROM tbl_status");
                                                    $sth->execute();
                                               
                                                    /* Fetch all of the remaining rows in the result set */
                                                    $status = $sth->fetchAll(PDO::FETCH_COLUMN, 0);

                                                foreach($cases as $row) {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $row["case_id"]; ?></td>
                                                    <td><?php echo $row["date_start"]; ?></td>
                                                    <td><?php echo $row["equipment"]; ?></td>
                                                    <td><?php echo $row["place_name"]; ?></td>
                                                    <td><?php echo $row["problem"]; ?></td>
                                                    <td> <?php if($row["urgency"] == "ปกติ") {?>
                                                        <a style="color: #8ebf42"><?php echo $row["urgency"]; ?></a>
                                                    </td>
                                                    <?php } ?>
                                                    <?php if($row["urgency"] == "ด่วน") {?>
                                                    <a style="color: #FE820D"><?php echo $row["urgency"]; ?></a>
                                                    </td>
                                                    <?php } ?>
                                                    <?php if($row["urgency"] == "ด่วนที่สุด") {?>
                                                    <a style="color: #E90B0B"><?php echo $row["urgency"]; ?></a>
                                                    </td>
                                                    <?php } ?></td>
                                                    <td><?php echo $row["username"]; ?></td>
                                                    <?php
                                                    if ($row["status_name"] == $status[3]){  ?>
                                                    <td><a style="color: #8ebf42"><?php echo $row["status_name"]; ?></a>
                                                    </td>
                                                    <?php } ?>
                                                    <?php
                                                    if ($row["status_name"] == $status[4]){ ?>
                                                    <td><a style="color: #E90B0B"><?php echo $row["status_name"]; ?></a>
                                                    </td>
                                                    <?php } ?>
                                                    <?php
                                                    if ($row["status_name"] == $status[0]){ ?>
                                                    <td><a style="color: #8601AF"><?php echo $row["status_name"]; ?></a>
                                                    </td>
                                                    <?php } ?>
                                                    <?php
                                                    if ($row["status_name"] == $status[1]){ ?>
                                                    <td><a style="color: #0E90EA"><?php echo $row["status_name"]; ?></a>
                                                    </td>
                                                    <?php } ?>
                                                    <?php
                                                    if ($row["status_name"] == $status[2]){ ?>
                                                    <td><a style="color: #E9940B"><?php echo $row["status_name"]; ?></a>
                                                    </td>
                                                    <?php } ?>

                                                </tr>
                                                <?php } ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </main>
        </div>
    </div>
   
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

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- cdn bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>