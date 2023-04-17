<?php 
    session_start();
    require_once 'config/db.php';
  
    if (isset($_POST['sign_up'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone =  $_POST['phone'];
        $department = $_POST['department'];
        $u_role = $_POST['u_role'];
        $status = '0';

        if (empty($username)) {
            $_SESSION['error'] = 'Please enter your  Username. !';
            header("location: sign-up");
        } else if (empty($password)) {
            $_SESSION['error'] = 'Please enter your  Password. !';
            header("location: sign-up");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'Password (must be between 5-20 characters) !';
            header("location: sign-up");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'Please confirm enter your Password';
            header("location: sign-up");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'Passwords do not match. !';
            header("location: sign-up");
        } else if (strlen($_POST['phone']) > 10) {
            $_SESSION['error'] = 'The phone number must be 10 characters long. !';
            header("location: sign-up");
        } else if (empty($u_role)) {
            $_SESSION['error'] = 'Please enter your Role. !';
            header("location: sign-up");
        } else {
            try {
                $check_username = $conn->prepare("SELECT username FROM tbl_users WHERE username = :username");
                $check_username->bindParam(":username", $username);
                $check_username->execute();
                $row = $check_username->fetch(PDO::FETCH_ASSOC);
                
                if ($row['username'] == $username) {
                    $_SESSION['warning'] = "This username is already in the system. !";
                    header("location: signup");
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO tbl_users(username, password, first_name, last_name, phone, department, u_role, status) 
                                            VALUES(:username , :password, :first_name, :last_name, :phone, (SELECT department_id FROM tbl_department WHERE department_id = (SELECT department_id FROM tbl_department WHERE department_name=:department)), :u_role, :status)");
                    
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":first_name", $first_name);
                    $stmt->bindParam(":last_name", $last_name);
                    $stmt->bindParam(":phone", $phone);
                    $stmt->bindParam(":department", $department);
                    $stmt->bindParam(":u_role", $u_role);
                    $stmt->bindParam(":status", $status);
                    $stmt->execute();
                    $_SESSION['success'] = "You have successfully registered.!";
                    header("location: sign-up");
                } else {
                    $_SESSION['error'] = "something went wrong";
                    header("location: sign-up");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        
    } else if (isset($_POST['reset_password'])) {
        $uid = $_POST['uid'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];

        if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: resetpassword");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: resetpassword");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: resetpassword");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกันค่ะ';
            header("location: resetpassword");
        }  else {
            try {
                if (!isset($_SESSION['error'])){

                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = $conn->prepare("UPDATE tbl_users SET password=:password  WHERE id = $uid ");                      
                    $sql->bindParam(":password",  $passwordHash );                                
                    $sql->execute();           
                    $_SESSION['success'] = "รีเซ็ตรหัสผ่านสำเร็จ";
                    header("location: manage_users");
                        
                } 
            
                else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: manage_users");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    } else if (isset($_POST['update_users'])) {
        $uid = $_POST['uid'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone =  $_POST['phone'];
        $department = $_POST['department'];
        $u_role = $_POST['u_role'];
        $status = $_POST['status'];

        try {
            if (!isset($_SESSION['error'])){       
                $sql = $conn->prepare("UPDATE tbl_users SET username=:username , first_name=:first_name , last_name=:last_name  , department=(SELECT department_id FROM tbl_department WHERE department_id = (SELECT department_id FROM tbl_department WHERE department_name=:department)),phone=:phone , u_role=:u_role , status=
                :status  WHERE id = $uid ");
                $sql->bindParam(":username",  $username );
                $sql->bindParam(":first_name",  $first_name );
                $sql->bindParam(":last_name",  $last_name );
                $sql->bindParam(":department",  $department );
                $sql->bindParam(":phone",  $phone);
                $sql->bindParam(":u_role",  $u_role);
                $sql->bindParam(":status", $status);        
                $sql->execute();           
                $_SESSION['success'] = "อัพเดทข้อมูลสำเร็จ";
                header("location: manage_users");
            } 
        } catch(PDOException $e) {
            echo $e->getMessage();
            }
        }


   
?>