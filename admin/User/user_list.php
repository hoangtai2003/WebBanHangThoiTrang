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
                    <h4>Danh sách thành viên</h4>
                    <?php if (checkPrivilege('user_add.php')) { ?>
                        <a href="user_add.php" class="btn btn-primary float-end"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Thêm</a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Trạng thái</th>
                            <?php if (checkPrivilege('role.php?UserId=0')) { ?>
                                <th>Phân quyền</th>
                            <?php } ?>
                            <?php if (checkPrivilege('user_edit.php?UserId=0')) { ?>
                                <th>Sửa</th>
                            <?php } ?>
                            <?php if (checkPrivilege('user_delete.php?UserId=0')) { ?>
                                <th>Xóa</th>
                            <?php } ?>
                        </tr>
                        <?php
                            $item_per_page =!empty($_GET['per_page'])?$_GET['per_page']:4;
                            $current_page = !empty($_GET['page'])?$_GET['page']:1;
                            // offset  = (page - 1) * per_page
                            $offset = ($current_page - 1) * $item_per_page;
                            $sql = "Select * from user order by UserId asc limit ".$item_per_page." offset ".$offset." ";
                            $result = mysqli_query($connection, $sql);
                            $totalRecords = mysqli_query($connection, "select * from user");
                            $totalRecords = $totalRecords->num_rows;
                            // Tổng số trang = tổng số sản phẩm / tổng số sản phẩm một trang
                            $totalPage = ceil($totalRecords / $item_per_page);
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $row) {
                        ?>
                            <tr>
                                <th scope="row"><?= $row['UserId']; ?></th>
                                <td><?= $row['UserName']; ?></td>
                                <td><?= $row['UserEmail']; ?></td>
                                <td><?php
                                    if ($row['UserStatus'] == 1) {
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
                                <?php if (checkPrivilege('role.php?UserId=0')) { ?>
                                    <td><a href="role.php?UserId=<?= $row['UserId'] ?>" class="btn btn-info rounded-pill p-2">Phân quyền</a></td>
                                <?php } ?>
                                <?php if (checkPrivilege('user_edit.php?UserId=0')) { ?>
                                    <td>
                                        <a href="user_edit.php?UserId=<?= $row['UserId'] ?>" class="btn btn-success">
                                            <i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Sửa
                                        </a>
                                    </td>
                                <?php } ?>
                                <?php if (checkPrivilege('user_delete.php?UserId=0')) { ?>
                                    <td>
                                        <a 
                                            href="user_delete.php?UserId=<?=$row["UserId"]; ?>" 
                                            class="btn btn-danger action_delete" 
                                            value="<?= $row['UserId']; ?>"><i class="fa-solid fa-trash" 
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php');
?>