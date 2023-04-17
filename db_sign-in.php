<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['sign_in'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username)) {
            $_SESSION['error'] = 'Please fill out. !';
            echo "<script type='text/javascript'>alert('uyuyuu');</script>";
        } else if (empty($password)) {
            $_SESSION['error'] = 'Please fill out. !';
            header("location: sign-in");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'The password must be between 5 and 20 characters long. !';
            header("location: sign-in");
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM tbl_users WHERE username = :username");
                $check_data->bindParam(":username", $username);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {
                    if ($username == $row['username']) {
                        if (password_verify($password, $row['password'])) {
                            if ($row['u_role'] == 'Admin') {
                                $_SESSION['admin_login'] = $row['id'];
                                header("location: admin");
                            } else if ($row['u_role'] == 'Leader'){
                                $_SESSION['leader_login'] = $row['id'];
                                header("location: leader");
                            } else if ($row['u_role'] == 'Officer GA'){
                                $_SESSION['officer-ga_login'] = $row['id'];
                                header("location: officer-ga");
                            } else if ($row['u_role'] == 'Users'){
                                $_SESSION['user_login'] = $row['id'];
                                header("location: users");
                            }
                        } else {
                            $_SESSION['error'] = 'password not valid';
                            header("location: sign-in");
                        }
                    } else {
                        $_SESSION['error'] = 'username not valid';
                        header("location: sign-in");
                    }
                } else {
                    $_SESSION['error'] = "There is no information in the system.";
                    header("location: sign-in");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>