<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: sign-in');
    }

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];

        $select_stmt = $conn->prepare("SELECT * FROM tbl_users WHERE id = :id");
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // Delete an original record from db
        $delete_stmt = $conn->prepare('DELETE FROM tbl_users WHERE id = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header('Location:manage_users');
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siam Kyohwa Seisakusho</title>
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
    <?php 
        if (isset($_SESSION['admin_login'])) {
            $admin_id = $_SESSION['admin_login'];
            $stmt = $conn->query("SELECT * FROM tbl_users WHERE id = $admin_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    ?>


    <div class="modal fade bd-example-modal-lg" id="view_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        ข้อมูลสมาชิก</h5>
                </div>
                <form id="myform1" name="form1" method="post" class="row g-3" action=db_signup.php>
                    <div class="modal-body" id="detail">

                    </div>

                    <div class="modal-footer">
                        <a href="manage_users" class="btn btn-secondary">กลับ</a>
                        <button type="submit" name="update_users" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                                <span class="ml-2">ข้อมูลแจ้งซ่อม</span>
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
                            <a class="nav-link active" aria-current="page" data-toggle="collapse" href="manage_users">
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
                <div class="container">
                    <div class="main-panel">
                        <div class="content">
                            <div class="container-fluid">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title text-center">SK - Signup</h4>
                                        </div>
                                        <div class="form-row card-body justify-content-center">
                                            <form id="my_form1" name="form1" method="post" class="row g-3"
                                                action=db_sign-up.php novalidate>
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
                                                <div class="col-md-4">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="username"
                                                        aria-describedby="username" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please enter your Username .
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="password" class="form-label">Password </label>
                                                    <input type="password" class="form-control" name="password" value=""
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Please enter your Password .
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="confirm password" class="form-label">Confirm
                                                        Password</label>
                                                    <input type="password" class="form-control" name="c_password"
                                                        value="" required>
                                                    <div class="invalid-feedback">
                                                        Please confirm your password.
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="first_name" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" name="first_name"
                                                        aria-describedby="first_name" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please enter your First Name .
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="last_name" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" name="last_name"
                                                        aria-describedby="last_name" value="" required>
                                                    <div class="invalid-feedback">
                                                        Please enter your Last Name .
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="phone" class="form-label">Phone Number</label>
                                                    <input type="tel" class="form-control" name="phone"
                                                        pattern="^0([8|9|6])([0-9]{8}$)" autocomplete="off" value=""
                                                        required>
                                                    <div class="invalid-feedback">
                                                        Please enter your Phone Number .
                                                    </div>
                                                </div>
                                                <?php 
                                        $select_department = $conn->prepare("SELECT department_name FROM tbl_department");
                                        $select_department->execute();                                                        
                                    ?>
                                                <div class="col-md-4">
                                                    <label for="department" class="form-label">Department</label>
                                                    <select name="department" class="form-select" name="department"
                                                        required>
                                                        <option selected></option>
                                                        <?php 
                                                while($row = $select_department->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <option><?php echo $row['department_name'] ?></option>
                                                        <?php
                                                }?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please enter your Department .
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="u_role" class="form-label">u_role</label>
                                                    <select id="u_role" class="form-select" name="u_role" required>
                                                        <option selected></option>
                                                        <option>Admin</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please enter your Role .
                                                    </div>

                                                </div>

                                                <div class="col-md-12">
                                                    <br>
                                                    <br>
                                                    <button type="submit" name="sign_up" class="btn btn-primary "
                                                        style="float: right;">Sig up
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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

    <script type="text/javascript">
    $(function() {
        $("#myform1").on("submit", function() {
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
        $("#myTable").DataTable();
    });
    </script>

    <script>
    $(document).on('click', '.view_data', function() {
        var case_id = $(this).attr("id")

        $.ajax({
            url: "fetch_data.php",
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