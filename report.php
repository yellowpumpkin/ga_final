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
    <!--  jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    <!-- cdn feather icons   -->
    <script src="https://unpkg.com/feather-icons"></script>

    
    <!-- cdn data table   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />

    <!-- cdn feather icons   -->
    <script src="https://unpkg.com/feather-icons"></script>


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
                        <a class="nav-link active" href="report"><i class="bi bi-tools"></i> Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sign-in"><i class="bi bi-box-arrow-right"></i> Administrator</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>


    <section class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center p-3 my-3 text-white bg-danger rounded shadow-sm">
                    <h1 class="h6 mb-0 text-white lh-1">
                        <i class="fas fa-tasks"></i> แจ้งปัญหาการใช้พื้นที่/อุปกรณ์/สิ่งอำนวยความสะดวกส่วนกลาง Common
                        space and
                        facility problem report
                    </h1>
                </div>


                <form name="form_repair" id="my_form1" action="db_general.php" method="post"
                    enctype="multipart/form-data" novalidate>
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
                    <div class="form-group row">
                        <label for="date_start" class="col-sm-2 col-form-label">วันที่แจ้งซ่อม</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control" id="date_start" name="date_start"
                                value="<?php echo date("Y-m-d") ;?>">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="username" class="col-sm-2 col-form-label">ชื่อผู้แจ้ง</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="username" name="username" " required>
                        </div>
                    </div>
                    <div class=" form-group row mt-2">
                            <label for="agency" class="col-sm-2 col-form-label">หน่วยงาน/แผนก</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="agency" name="agency" required>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="equipment" class="col-sm-2 col-form-label">อุปกรณ์ที่พบปัญหา</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="equipment" name="equipment" required>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="place_name" class="col-sm-2 col-form-
                            label">สถานที่ที่พบปัญหา</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="place_name" name="place_name" required>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="problem" class="col-sm-2 col-form-label">ปัญหาที่พบ</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="problem" name="problem" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="img" class="col-sm-2 col-form-label">Image:</label>
                            <div class="col-sm-6">

                                <input type="file" class="form-control" id="imgInput" name="img">
                                <img loading="lazy" width="100%" id="previewImg" alt="">
                            </div>
                        </div>
                        
                        <div class="form-group row mt-2">
                            <label for="urgency" class="col-sm-2 col-form-label">ความเร่งด่วน</label>
                            <div class="col-sm-6">
                                <select name="urgency" id="urgency" class="form-control form-control-sm" required>
                                    <option value="" selected disabled>-- กรุณาเลือก --</option>
                                    <option>ปกติ</option>
                                    <option>ด่วน</option>
                                    <option>ด่วนที่สุด</option>
                                </select>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-danger btn-sm" href="index">ยกเลิกการแจ้ง</a>
                                </div>
                                <div class="col ">
                                    <button type="submit" name="insert_report" class="btn btn-success "
                                        style="float: right;" onclick="return confirm('กรุณาตรวจสอบความถูกต้อง')">บันทึก
                                    </button>
                                </div>
                            </div>
                        </div>
                </form>



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

    <script>
    $(document).ready(function() {
        $("#myTable").DataTable();
    });
    </script>



    <script type="text/javascript">
    $(function() {
        $("#my_form1").on("submit", function() {
            var form = $(this)[0];
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
    </script>

    <script>
    $(document).ready(function() {

        var date_closed = $('input[name="date_end"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {

            format: 'yyyy-mm-dd ',
            container: container,
            orientation: 'auto top',
            todayHighlight: true,
            setDate: new Date(),
            autoclose: true,
        };
        date_closed.datepicker(options);

    })
    </script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
    let imgInput = document.getElementById('imgInput');
    let previewImg = document.getElementById('previewImg');

    imgInput.onchange = evt => {
        const [file] = imgInput.files;
        if (file) {
            previewImg.src = URL.createObjectURL(file)
        }
    }
    </script>
</body>

</html>