<?php 
    session_start();
    require_once 'config/db.php';
  

    if (isset($_POST['insert_department'])) {
        $department_name = $_POST['department_name'];
        if (empty($department_name)) {
            $_SESSION['error'] = 'กรุณากรอกแผนกงาน ';
            header("location: manage_department");
        } else {
            $check_department = $conn->prepare("SELECT department_name FROM tbl_department WHERE department_name = :department_name");
            $check_department->bindParam(":department_name", $department_name);
            $check_department->execute();
            $row = $check_department->fetch(PDO::FETCH_ASSOC);
            if ($row['department_name'] == $department_name) {
                $_SESSION['warning'] = "มีข้อมูลนี้อยู่ในระบบแล้ว";
                header("location:  manage_department");
            } else if (!isset($_SESSION['error'])) {
                   
                    $stmt = $conn->prepare("INSERT INTO tbl_department(department_name) 
                                            VALUES(:department_name)");
                    
                    $stmt->bindParam(":department_name", $department_name);
                    $stmt->execute();
                    $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อยแล้ว!";
                    header("location: manage_department");
                } 
            } 
    } else if (isset($_POST['insert_status'])) {
        $status_name = $_POST['status_name'];
        if (empty($status_name)) {
            $_SESSION['error'] = 'กรุณากรอกสถานะ';
            header("location: manage_status");
        } else {
            $check_status = $conn->prepare("SELECT status_name FROM tbl_status WHERE status_name = :status_name");
            $check_status->bindParam(":status_name", $status_name);
            $check_status->execute();
            $row = $check_status->fetch(PDO::FETCH_ASSOC);
            if ($row['status_name'] == $status_name) {
                $_SESSION['warning'] = "มีข้อมูลนี้อยู่ในระบบแล้ว";
                header("location:  manage_status");
            } else if (!isset($_SESSION['error'])) {
                   
                    $stmt = $conn->prepare("INSERT INTO tbl_status(status_name) 
                                            VALUES(:status_name)");
                    
                    $stmt->bindParam(":status_name", $status_name);
                    $stmt->execute();
                    $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อยแล้ว!";
                    header("location: manage_status");
                } 
            } 
    } else   if (isset($_POST['insert_report'])) {
        // $date_start = $_POST['date_start'];
        // $date_end = $_POST['date_end'];
        $username = $_POST['username'];
        $equipment = $_POST['equipment'];
        $problem = $_POST['problem'];
        $place_name =  $_POST['place_name'];
        $agency = $_POST['agency'];
        $urgency = $_POST['urgency'];
        $img = $_FILES['img'];
        
        $status = '1';
        $case_status = '0';

        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'uploads/'.$fileNew;

        $sToken = "8aMywVMbfQgEzKVDCChxrib6ZnYS3hnvB8FQuKxWjpF";
        $sMessage = "https://inwza007.com/sk-ga/ \n";
        $sMessage .= "ชื่ออุปกรณ์ : " . $equipment . "\n";
        $sMessage .= "อาการเบื้องต้น: " . $problem . "\n";
        $sMessage .= "สถานที่ : " . $place_name . "\n";
        $sMessage .= "ผู้แจ้ง : " . $username . "\n";

        $chOne = curl_init(); 
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt( $chOne, CURLOPT_POST, 1); 
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec( $chOne ); 


        if (in_array($fileActExt, $allow)) {
                    if ($img['size'] > 0 && $img['error'] == 0) {
                        if (move_uploaded_file($img['tmp_name'], $filePath)) {
     
                    $stmt = $conn->prepare("INSERT INTO tbl_case( username , equipment,problem, place_name, agency, urgency  , status ,case_status,img) 
                                            VALUES( :username , :equipment ,:problem, :place_name, :agency, :urgency ,:status , :case_status, :img)");
                  
                    $stmt->bindParam(":equipment", $equipment);
                    $stmt->bindParam(":problem", $problem);
                    $stmt->bindParam(":place_name", $place_name);
                    $stmt->bindParam(":agency", $agency);
                    $stmt->bindParam(":urgency", $urgency);
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":status", $status);
                    $stmt->bindParam(":img", $fileNew);
                    $stmt->bindParam(":case_status", $case_status);
                    $stmt->execute();
                    $_SESSION['success'] = "บันทึกข้อมูลเรียบร้อย";
                    header("location: report");

                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: report");
                }
            }
        } else {
            try {
              if (!isset($_SESSION['error'])) {
     
                $stmt = $conn->prepare("INSERT INTO tbl_case( username , equipment,problem, place_name, agency, urgency  , status ,case_status) 
                VALUES( :username , :equipment ,:problem, :place_name, :agency, :urgency ,:status , :case_status)");
                    $stmt->bindParam(":equipment", $equipment);
                    $stmt->bindParam(":problem", $problem);
                    $stmt->bindParam(":place_name", $place_name);
                    $stmt->bindParam(":agency", $agency);
                    $stmt->bindParam(":urgency", $urgency);
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":status", $status);
                  
                    $stmt->bindParam(":case_status", $case_status);
                    $stmt->execute();
                    $_SESSION['success'] = "บันทึกข้อมูลเรียบร้อย";
                    header("location: report");

                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: report");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
        }
    } 
} else   if (isset($_POST['update_status_maintenance'])) {
                $case_id = $_POST['case_id'];
                $status = $_POST['status'];
                $username = $_POST['username'];
                $equipment = $_POST['equipment'];
                $problem = $_POST['problem'];
                $place_name =  $_POST['place_name'];
                $agency = $_POST['agency'];
                $urgency = $_POST['urgency'];
                $agency = $_POST['agency'];
                $urgency = $_POST['urgency'];

                $sql = $conn->prepare("UPDATE tbl_case SET status=(SELECT sid FROM tbl_status WHERE sid = (SELECT sid FROM tbl_status WHERE status_name=:status))    WHERE case_id = $case_id ");
                $sql->bindParam(":status",  $status );
            
                $sql->execute();

                if ($sql) {
                    $_SESSION['success'] = "อัพเดทข้อมูลสำเร็จ";
                    header("location: manage_report");
                } else {
                    $_SESSION['error'] = "อัพเดทข้อมูลไม่สำเร็จ";
                    header("location: manage_report");
                }

            } else   if (isset($_POST['case_status'])) {
                $case_id = $_POST['case_id'];
                $case_status = $_POST['case_status'];
            

                $sql = $conn->prepare("UPDATE tbl_case SET case_status = :case_status  WHERE case_id = $case_id ");
                $sql->bindParam(":case_status",  $case_status );
                $sql->execute();

                if ($sql) {
                    $_SESSION['success'] = "อัพเดทข้อมูลสำเร็จ";
                    header("location: report_all");
                } else {
                    $_SESSION['error'] = "อัพเดทข้อมูลไม่สำเร็จ";
                    header("location: report_all");
                }
            }

            else if (isset($_POST['update_department'])) {
                $department_id = $_POST['department_id'];
                $department_name = $_POST['department_name'];
            
                $check_department_name = $conn->prepare("SELECT department_name FROM tbl_department WHERE department_name = :department_name");
                $check_department_name ->bindParam(":department_name", $department_name);
                $check_department_name->execute();
                $row = $check_department_name->fetch(PDO::FETCH_ASSOC);
                 
                if ($row['department_name'] == $department_name) {
                    $_SESSION['warning'] = "มีข้อมูลนี้อยู่ในระบบแล้ว";
                    header("location:  manage_department");
                } else {
                
                    $sql = $conn->prepare("UPDATE tbl_department SET department_name=:department_name   WHERE department_id = $department_id ");
                
                    $sql->bindParam(":department_name",  $department_name );
                    $sql->execute();
            
                        if ($sql) {
                            $_SESSION['success'] = "อัพเดทข้อมูลสำเร็จ";
                            header("location: manage_department");
                        } else {
                            $_SESSION['error'] = "อัพเดทข้อมูลไม่สำเร็จ";
                            header("location: manage_department");
                        }
                    }
                }
                else if (isset($_POST['update_status'])) {
                    $sid = $_POST['sid'];
                    $status_name = $_POST['status_name'];
                
                    $check_status_name = $conn->prepare("SELECT status_name FROM tbl_status WHERE status_name = :status_name");
                    $check_status_name ->bindParam(":status_name", $status_name);
                    $check_status_name->execute();
                    $row = $check_status_name->fetch(PDO::FETCH_ASSOC);
                    
                    if ($row['status_name'] == $status_name) {
                        $_SESSION['warning'] = "มีข้อมูลนี้อยู่ในระบบแล้ว";
                        header("location:  manage_status");
                    } else {
                    
                        $sql = $conn->prepare("UPDATE tbl_status SET status_name=:status_name   WHERE sid = $sid ");
                    
                        $sql->bindParam(":status_name",  $status_name );
                        $sql->execute();
                
                            if ($sql) {
                                $_SESSION['success'] = "อัพเดทข้อมูลสำเร็จ";
                                header("location: manage_status");
                            } else {
                                $_SESSION['error'] = "อัพเดทข้อมูลไม่สำเร็จ";
                                header("location: manage_status");
                            }
                        }
            } else   if (isset($_POST['update_maintenance'])) {
                $case_id = $_POST['case_id'];
                $status = $_POST['status'];
                $machine_name = $_POST['machine_name'];
                $date_of_operation = $_POST['date_of_operation'];
                $date_completion = $_POST['date_completion'];
                $problems_found = $_POST['problems_found'];
                $details = $_POST['details'];
                $spare_part = $_POST['spare_part'];
                $note = $_POST['note'];
                $tech = $_POST['tech'];
    
               
    
                $sql = $conn->prepare("UPDATE tbl_case SET status=(SELECT sid FROM tbl_status WHERE sid =
                
                (SELECT sid FROM tbl_status WHERE status_name=:status))  , date_of_operation = :date_of_operation , date_completion= :date_completion , problems_found= :problems_found , details= :details , spare_part= :spare_part , note= :note WHERE case_id = $case_id ");
                $sql->bindParam(":status",  $status);
                $sql->bindParam(":date_of_operation",  $date_of_operation );
                $sql->bindParam(":date_completion",  $date_completion );
                $sql->bindParam(":problems_found", $problems_found);
                $sql->bindParam(":details", $details);
                $sql->bindParam(":spare_part", $spare_part);
                $sql->bindParam(":note", $note);
                $sql->execute();
        
                if ($sql) {
                    $_SESSION['success'] = "อัพเดทข้อมูลสำเร็จ";
                    header("location: manage_report");
                } else {
                    $_SESSION['error'] = "อัพเดทข้อมูลไม่สำเร็จ";
                    header("location:  manage_report");
                }
            }

        
    
    

?>