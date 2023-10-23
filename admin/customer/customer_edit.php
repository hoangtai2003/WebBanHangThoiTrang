<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php')
?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mt-5">
    </ol>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Sửa thông tin khách hàng</h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['CusId'])) {
                        $cus_id = $_GET['CusId'];
                        $sql = "Select * from customers where CusId = '$cus_id'";
                        $result = mysqli_query($connection, $sql);
                        $connection->close();
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $customer) {
                    ?>
                        <form action="customer_edit_action.php" method="POST">
                            <div class="form-group">
                                <input hidden type="text" name="CusId" class="form-control" value=<?= $customer['CusId'] ?>>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label>Tên khách hàng</label>
                                <input type="text" name="CusName" class="form-control" value="<?= $customer['CusName'] ?>">
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label>Mã khách hàng</label>
                                <input type="text" class="form-control" name="CusCode" value=<?= $customer['CusCode'] ?>>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label>Phone number</label>
                                <input type="text" class="form-control" name="CusPhone" value=<?= $customer['CusPhone'] ?>>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label>Email khách hàng</label>
                                <input type="email" class="form-control" name="CusEmail" value=<?= $customer['CusEmail'] ?>>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label>Địa chỉ khách hàng</label>
                                <input type="text" class="form-control" name="CusAddress" value="<?= $customer['CusAddress'] ?>">
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label>Ngày sinh</label>
                                <input type="date" class="form-control" name="CusBirthday" value=<?= $customer['CusBirthday'] ?>>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label>Giới tính</label>
                                <div class="form-check">
                                    <input class="form-check-input"  type="radio" name="rdGender" id="rdGender1" value=1 <?= $customer['CusGender'] == 1 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="rdGender1">Nam</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rdGender" id="rdGender0" value=0 <?= $customer['CusGender'] == 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="rdGender0">Nữ</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rdGender" id="rdGender2" value=2 <?= $customer['CusGender'] == 2 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="rdGender2">Khác</label>
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

<?php include('../includes/footer.php');
?>