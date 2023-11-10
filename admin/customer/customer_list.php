<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mt-5">
        <li class="breadcrumb-item active">Khách hàng</li>
        <li class="breadcrumb-item active">Danh sách khách hàng</li>
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
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Trạng thái</th>
                            <th>Chăm sóc khách hàng</th>
                        </tr>
                        <?php
                        include("../OffsetPagination/offset.php");
                        $sql = "Select * from customer order by CusId desc limit " . $item_per_page . " offset " . $offset . " ";
                        $result = mysqli_query($connection, $sql);
                        $totalRecords = mysqli_query($connection, "select * from customer");
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
                                    <td><?= $row['CusBirthday'] ?></td>
                                    <td><?php
                                        if ($row['CusGender'] == 1) {
                                        ?>
                                            <p>Nữ</p>
                                        <?php
                                        } else {
                                        ?>
                                            <p>Nam</p>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php
                                        if ($row['CusStatus'] == 1) {
                                        ?>
                                            <span class="badge rounded-pill bg-success p-3">Hoạt động</span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="badge rounded-pill bg-success p-3">Ngừng hoạt động</span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td style="position:relative">
                                        <a href="customer_support.php?CusId=<?php echo $row["CusId"]; ?>" class="btn btn-primary" value="<?= $row['CusId']; ?>"><i style="margin-right: 10px;" class="fa-brands fa-facebook-messenger">
                                            </i>Nhắn tin
                                        </a>
                                        <span 
                                            style="border-radius: 50%;
                                            position: absolute;
                                            top: 12%;
                                            font-size: 12px;
                                            left: 16%;
                                            background-color: red;
                                            color: #fff;
                                            padding: 0 6px;" class="number-mess"
                                            >0
                                        </span>
                                    </td>
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