<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: sign-in');
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siam Kyohwa Seisakusho</title>
    <link rel="icon" type="image/x-icon" href="skicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">

    <!-- cdn data table   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />

    <!-- cdn feather icons   -->
    <script src="https://unpkg.com/feather-icons"></script>


    <style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 90px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        z-index: 99;
    }

    @media (max-width: 767.98px) {
        .sidebar {
            top: 11.5rem;
            padding: 0;
        }
    }

    .navbar {
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
    }

    @media (min-width: 767.98px) {
        .navbar {
            top: 0;
            position: sticky;
            z-index: 999;
        }
    }

    .sidebar .nav-link {
        color: #333;
    }

    .sidebar .nav-link.active {
        color: #0d6efd;
    }
    </style>
</head>

<body>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="view_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        รายละเอียด</h5>
                </div>
                <form id="myform1" name="form1" method="post" class="row g-3" novalidate>
                    <div class="modal-body" id="detail">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" href="maintenance_view">close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php 
        if (isset($_SESSION['admin_login'])) {
            $admin_id = $_SESSION['admin_login'];
            $stmt = $conn->query("SELECT * FROM tbl_users WHERE id = $admin_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    ?>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <h3><?php echo $row['u_role'] ?></h3>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse"
                data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-12 col-md-4 col-lg-2">
            <h3> Dashboard</h3>
        </div>
        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-expanded="false">
                    Hello, <?php echo $row['first_name'] . ' ' . $row['last_name'] ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="sign-out">Sign out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="admin">
                                <i data-feather="folder"></i>
                                <span class="ml-2">ข้อมูลงานแจ้งซ่อม</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" data-toggle="collapse" href="#Adepartment">
                                <i data-feather="list"></i>
                                <span class="ml-2">จัดการข้อมูลพื้นฐาน</span>
                            </a>
                            <div class="collapse in" id="Adepartment">
                                <ul id="">
                                    <li id="" class="nav-item">
                                        <a class="nav-link" href="manage_department">
                                            <span class="link-collapse">ข้อมูลแผนกงาน</span>
                                        </a>
                                    </li>
                                    <li id="" class="nav-item">
                                        <a class="nav-link" href="manage_status">
                                            <span class="link-collapse">ข้อมูลสถานะ</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" data-toggle="collapse" href="manage_users">
                                <i data-feather="users"></i>
                                <span class="ml-2">จัดการข้อมูลผู้ใช้งาน</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" data-toggle="collapse" href="#manage_report">
                                <i data-feather="settings"></i>
                                <span class="ml-2">จัดการข้อมูลแจ้งซ่อม</span>
                            </a>
                            <div class="collapse in" id="manage_report">
                                <ul id="">
                                    <li id="" class="nav-item">
                                        <a class="nav-link" href="manage_report">
                                            <span class="link-collapse">งานแจ้งซ่อม (new)</span>
                                        </a>
                                    </li>
                                    <li id="" class="nav-item">
                                        <a class="nav-link" href="follow_report">
                                            <span class="link-collapse">ติดตามงานแจ้งซ่อม</span>
                                        </a>
                                    </li>
                                    <li id="" class="nav-item">
                                        <a class="nav-link" href="report_all">
                                            <span class="link-collapse">งานแจ้งซ่อมทั้งหมด</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <div class="row">
                    <div class="col-12 ">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title text-center">
                                    ข้อมูลรายงานปัญหาการใช้พื้นที่และอุปกรณ์สิ่งอำนวยความสะดวกส่วนกลาง </h5>
                            </div>

                            <div class="card-body">
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
                                <div class="table-responsive">
                                    <table id="myTable" class="display" style="width: 100%;">
                                        <thead>
                                            <th>No</th>
                                            <th>วันที่แจ้ง</th>
                                            <th>ชื่ออุปกรณ์</th>
                                            </th>
                                            <th>สถานที่</th>
                                            <th>อาการเบื้องต้น</th>
                                            <th>ความเร่งด่วน</th>
                                            <th>ผู้แจ้ง</th>


                                            <th>สถานะ</th>
                                            <!-- <th>รูป</th> -->
                                            <th></th>
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
                                                <!-- <td width="250px"><img class="rounded" width="100%" src="uploads/<?php echo $row['img']; ?>" alt=""></td> -->
                                                <td> <button type="button" data-feather="eye" data-toggle="modal"
                                                        class="view_data" id="<?php echo $row["case_id"]; ?>"></button>
                                                </td>
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
    <script>
    feather.replace()
    </script>
    <script>
    $(document).ready(function() {
        $("#myTable").DataTable();
    });
    </script>
    <script>
    $(document).on('click', '.view_data', function() {
        var case_id = $(this).attr("id")
        $.ajax({
            url: "display_report.php",
            method: "post",
            data: {
                id: case_id
            },
            success: function(data) {
                $('#detail').html(data);
                $('#view_modal').modal('show');
            }
        });
    });
    </script>
</body>

</html>