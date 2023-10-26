<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mt-5">
    </ol>
    <div class="row">
        <?php include('../authen/message.php'); ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Danh sách khách hàng</h4>
                    <?php if (checkPrivilege('customer_add.php')) { ?>
                        <a href="customer_add.php" class="btn btn-primary float-end"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Thêm</a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <form method="POST"></form>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Tên khách hàng</th>
                            <th>Tên người dùng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Địa chỉ khách hàng</th>
                            <th>Ngày Sinh</th>
                            <th>Giới tính</th>
                            <?php if (checkPrivilege('customer_edit.php?CusId=0')) { ?>
                                <th>Sửa</th>
                            <?php } ?>
                            <?php if (checkPrivilege('customer_delete.php?CusId=0')) { ?>
                                <th>Xóa</th>
                            <?php } ?>
                        </tr>
                        <?php
                            $item_per_page =!empty($_GET['per_page'])?$_GET['per_page']:4;
                            $current_page = !empty($_GET['page'])?$_GET['page']:1;
                            // offset  = (page - 1) * per_page
                            $offset = ($current_page - 1) * $item_per_page;
                            $sql = "Select * from customers order by CusId asc limit ".$item_per_page." offset ".$offset." ";
                            $result = mysqli_query($connection, $sql);
                            $totalRecords = mysqli_query($connection, "select * from customers");
                            $totalRecords = $totalRecords->num_rows;
                            // Tổng số trang = tổng số sản phẩm / tổng số sản phẩm một trang
                            $totalPage = ceil($totalRecords / $item_per_page);
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $row) {
                        ?>
                                <tr>
                                    <th scope="row"><?= $row['CusId']; ?></th>
                                    <td><?= $row['CusName']; ?></td>
                                    <td><?= $row['CusUserName']; ?></td>
                                    <td><?= $row['CusPhone']; ?></td>
                                    <td><?= $row['CusEmail']; ?></td>
                                    <td><?= $row['CusAddress']; ?></td>
                                    <td><?= $row['CusBirthday']; ?></td>
                                    <td><?= $row['CusGender']; ?></td>
                                    <?php if (checkPrivilege('customer_edit.php?CusId=0')) { ?>
                                        <td>
                                            <a href="customer_edit.php?CusId=<?= $row['CusId'] ?>" class="btn btn-success">
                                                <i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Sửa
                                            </a>
                                        </td>
                                    <?php } ?>
                                    <?php if (checkPrivilege('customer_delete.php?CusId=0')) { ?>
                                        <td>
                                            <a 
                                                href="customer_delete.php?CusId=<?php echo $row["CusId"]; ?>" 
                                                class="btn btn-danger action_delete" 
                                                value="<?= $row['CusId']; ?>"><i class="fa-solid fa-trash" 
                                                style="margin-right: 5px;"></i>Xóa
                                            </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                    <?php include("../../pagination/pagination.php") ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php');
?>