<?php 

$id=$_POST['id'];
session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin_login']) and !isset($_SESSION['leader_login'])  and !isset($_SESSION['technician_login']) and !isset($_SESSION['user_login']) ) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: signin');
} 

$select_stmt = $conn->query("SELECT * FROM tbl_case 
INNER JOIN tbl_status ON status = sid Where case_id = '$id' ");
$select_stmt->execute();
$cases = $select_stmt->fetchAll();

foreach($cases as $row) { ?>

<div class="form-group">
    <div class="row mb-1 mt-2">
        <label for="case_id" class="col-sm-3 col-form-label">เลขที่ใบแจ้งซ่อม
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="case_id" name="case_id" readonly value="<?php echo $row['case_id']; ?>">
        </div>
        <label for="date_start" class="col-sm-3 col-form-label">วันที่แจ้งซ่อม
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="date_start" name="date_start" readonly
                value="<?php echo $row['date_start']; ?>">
        </div>

    </div>

    <div class="row mb-1 mt-2">
        <label for="equipment" class="col-sm-3 col-form-label">อุปกรณ์
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="equipment" name="equipment" readonly
                value="<?php echo $row['equipment']; ?>">
        </div>
        <label for="problem" class="col-sm-3 col-form-label">อาการเบื้องต้น
            :</label>
        <div class="col-sm-3">
            <textarea class="form-control" rows="2" id="problem" name="problem"
                readonly><?php echo $row['problem']; ?></textarea>

        </div>

    </div>

    <div class="row mb-1 mt-2">
        <label for="place_name" class="col-sm-3 col-form-label">สถานที่
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="place_name" name="place_name" readonly
                value="<?php echo $row['place_name']; ?>">
        </div>

        <label for="urgency" class="col-sm-3 col-form-label">ความเร่งด่วน
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="urgency" name="urgency" readonly value="<?php echo $row['urgency']; ?>">
        </div>
    </div>

    <div class="row mb-1 mt-2">
        <label for="username" class="col-sm-3 col-form-label">คนแจ้งซ่อม
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="username" name="username" readonly value="<?php echo $row['username']; ?> ">
        </div>
        <label for="status_name" class="col-sm-3 col-form-label">สถานะ
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="status_name" name="status_name" readonly
                value="<?php echo $row['status_name']; ?> ">
        </div>
    </div>

    <div class="row mb-1 mt-2">
        <label for="status_name" class="col-sm-3 col-form-label">รูป 1 :</label>
        <div class="col-sm-3">
            <img class="rounded" width="100%" src="uploads/<?php echo $row['img']; ?>">
        </div>

        
    </div>

    <div class="row mb-1 mt-2">
        <label for="date_of_operation" class="col-sm-3 col-form-label">วันที่ดำเนินงาน
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="date_of_operation" name="date_of_operation" readonly
                value="<?php echo $row['date_of_operation']; ?>">
        </div>
        <label for="date_completion" class="col-sm-3 col-form-label">วันที่แล้วเสร็จ
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="date_completion" name="date_completion" readonly
                value="<?php echo $row['date_completion']; ?>">
        </div>
    </div>

    <div class="row mb-1 mt-2">
        <label for="problems_found" class="col-sm-3 col-form-label">ปัญหาที่พบ
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="problems_found" name="problems_found" readonly
                value="<?php echo $row['problems_found']; ?>">
        </div>
        <label for="details" class="col-sm-3 col-form-label">รายละเอียดการซ่อม
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="details" name="details" readonly value="<?php echo $row['details']; ?>">
        </div>
    </div>

    <div class="row mb-1 mt-2">
        <label for="spare_part" class="col-sm-3 col-form-label">อะไหล่
            :</label>
        <div class="col-sm-3">
            <textarea class="form-control" rows="3" id="spare_part" name="spare_part"
                readonly><?php echo $row['spare_part']; ?></textarea>
        </div>
        <label for="note" class="col-sm-3 col-form-label">หมายเหตุ
            :</label>
        <div class="col-sm-3">
            <input class="form-control" id="note" name="note" readonly value="<?php echo $row['note']; ?> ">
        </div>
    </div>

</div>
<?php } ?>