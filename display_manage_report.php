<?php 


session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin_login']) and !isset($_SESSION['leader_login']) ) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: signin');
} 

$id=$_POST['id'];
$select_stmt = $conn->query("SELECT * FROM tbl_case 

INNER JOIN tbl_status ON status = sid 
Where case_id = '$id' ");
$select_stmt->execute();
$cases = $select_stmt->fetchAll();

foreach($cases as $row) { ?>
<div class="form-group">
    <div class="row">
        <div class="col-md-4 mt-1">
            <label for="case_id" class="form-label">เลขที่</label>
            <input class="form-control" name="case_id" value="<?php  echo $row["case_id"]; ?>" required readonly>
        </div>
        <div class="col-md-4 mt-1">
            <!-- Date input -->
            <label class="form-label" for="date">วันที่แจ้งซ่อม</label>
            <fieldset disabled>
                <input type="text" id="username_case" class="form-control"
                    placeholder="<?php echo $row["date_start"]; ?>">
            </fieldset>
        </div>

        <div class="col-md-4 mt-1">
            <label for="urgency" class="form-label">ความเร่งด่วน</label>
            <input type="text" class="form-control" name="urgency" aria-describedby="urgency"
                value=" <?php  echo $row["urgency"]; ?>" required readonly>
        </div>

        <div class="col-md-4 mt-1">
            <label for="equipment" class="form-label">ชื่อเครื่องจักร</label>
            <input type="text" class="form-control" name="equipment" value="<?php echo $row["equipment"]; ?>" required
                readonly>
        </div>
        <div class="col-md-4 mt-1">
            <label for="place_name" class="form-label">สถานที่</label>
            <input type="text" class="form-control" name="place_name" aria-describedby="place_name"
                value="<?php echo $row["place_name"]; ?>" required readonly>
        </div>
        <div class="col-md-4 mt-1">
            <label for="problem" class="form-label">อาการเบื้องต้น</label>
            <textarea class="form-control" name="problem" id="problem" rows="1" required
                readonly><?php echo $row["problem"]; ?></textarea>
        </div>
        <div class="col-md-4 mt-1">
            <label for="username" class="form-label">พนักงานแจ้งซ่อม
            </label>
            <input id="username" class="form-control" name="username" value="<?php echo $row['username'] ?>" readonly>
        </div>
        <div class="col-md-4 mt-1">
            <label for="agency" class="form-label">หน่วยงาน</label>
            <input type="text" class="form-control" name="agency" aria-describedby="agency"
                value="<?php echo $row["agency"]; ?>" required readonly>
        </div>
        <div class="col-md-5 mt-1">
            <label for="status_name" class="col-sm-3 col-form-label">รูป</label>
            <img class="rounded" width="100%" src="uploads/<?php echo $row['img']; ?>">
        </div>
 
    <h5 class="mt-4">รายละเอียดการซ่อม</h5>
        <hr>
        <div class="col-md-6 mt-1">
            <!-- Date input -->
            <label class="form-label" for="date">วันที่ดำเนินงาน</label>
            <input class="form-control" id="date_of_operation" name="date_of_operation" placeholder="YYYY-MM-DD"
                type="text" value="" required>
        </div>
        <div class="col-md-6 mt-1">
            <!-- Date input -->
            <label class="form-label" for="date">วันที่แล้วเสร็จ</label>
            <input class="form-control" id="date_completion" name="date_completion" placeholder="YYYY-MM-DD" type="text"
                value="" required>
        </div>

        <div class="col-md-6 mt-1">
            <label for="problems_found" class="form-label">ปัญหาที่พบ</label>
            <textarea class="form-control" id="problems_found" name="problems_found"
                rows="2"><?php echo $row['problems_found'] ?></textarea>
        </div>

        <div class="col-md-6 mt-1">
            <label for="details" class="form-label">รายละเอียดการซ่อม</label>
            <textarea class="form-control" id="details" name="details" rows="2"><?php echo $row['details'] ?></textarea>
        </div>

        <div class="col-md-6 mt-1">
            <label for="spare_part" class="form-label">อะไหล่ที่เปลี่ยน</label>
            <textarea class="form-control" name="spare_part" rows="2"><?php echo $row['spare_part'] ?></textarea>

        </div>
        <div class="col-md-6 mt-1">
            <label for="note" class="form-label">หมายเหตุ</label>
            <textarea class="form-control" id="note" name="note" rows="2"> <?php echo $row['note'] ?></textarea>
        </div>

  
    <div class="col-md-6 mt-1">
        <?php                                                                  
                $select_status = $conn->query("SELECT * FROM tbl_status Where sid > '1' ");
                $select_status->execute();                                                                                          
            ?>
        <label for="status" class="form-label">สถานะ</label>
        <select name="status" class="form-select" required>
            <option selected> <?php echo $row['status_name'] ?></option>
            <?php 
                    while($rows = $select_status->fetch(PDO::FETCH_ASSOC)) { ?>
            <option>
                <?php echo $rows['status_name'] ?>
            </option>
            <?php
            }?>
        </select>
    </div>
</div>
</div>
<?php } ?>

<script>
$(document).ready(function() {
    var date_completion = $('input[name="date_completion"]');
    var date_of_operation = $('input[name="date_of_operation"]'); //our date input has the name "date"
    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
    var options = {

        format: 'yyyy-mm-dd ',
        container: container,
        orientation: 'auto top',
        todayHighlight: true,
        setDate: new Date(),
        autoclose: true,
    };
    date_completion.datepicker(options);
    date_of_operation.datepicker(options);

})
</script>