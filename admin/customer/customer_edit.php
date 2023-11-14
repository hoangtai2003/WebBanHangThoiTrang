<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php')
?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mt-5">
        <li class="breadcrumb-item active">Khách hàng</li>
        <li class="breadcrumb-item active">Sửa khách hàng</li>
    </ol>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Sửa khách hàng</h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['CusId'])) {
                        $cus_id = $_GET['CusId'];
                        $sql = "Select * from customer where CusId = '$cus_id'";
                        $result = mysqli_query($connection, $sql);
                        $connection->close();
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $cus) {
                    ?>
                        <form action="customer_edit_action.php" method="POST">
                            <div class="form-group">
                                <input hidden type="text" name="cus_id" class="form-control" value=<?= $cus['CusId'] ?>>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label>Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input"  type="radio" name="rdstatus" id="rdstatus1" value=1 <?= $cus['CusStatus'] == 1 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="rdstatus1">Hoạt động</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rdstatus" id="rdstatus0" value=0 <?= $cus['CusStatus'] == 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="rdstatus0">Ngừng hoạt động</label>
                                </div>
                            </div>
                            <button name="update_customer" class="btn btn-primary mt-2">Cập nhật</button>
                            <a href="customer_list.php" class="btn btn-danger mt-2">Quay lại</a>
                        </form>
                    <?php
                            }
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    include('../includes/footer.php');
?>