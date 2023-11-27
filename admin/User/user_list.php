<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                   <script>
                    $(document).ready(function() {
                        $(".txtSearch").keyup( function() {
                            // Lấy giá trị từ trường input
                            var inputValue = $(".txtSearch").val();
                        // Sử dụng Ajax để gửi giá trị về máy chủ PHP
                        $.ajax({
                            type: "GET",
                            url: "", // Đường dẫn đến chính tệp PHP hiện tại
                            data: { input_value: inputValue },
                            success: function(response) {
                                // Xử lý phản hồi từ máy chủ và cập nhật nội dung trong bảng
                                var limitedContent = $(response).find('.highlight');
                                $("#user_table").html(limitedContent);
                            },
                            error: function(error) {
                                // Xử lý lỗi nếu có
                                console.error(error);
                    }
                });
            });
        });
        
    </script>
<div class="container-fluid px-4">
    <div class="float-end">
                <form style="display: inline-flex;" name=f method="get">
                    <input class="form-control txtSearch" name="" type="text" required style="margin-left:0;"  placeholder="Tìm kiếm..."  />
                                            
            </form></div>
    <ol class="breadcrumb mt-5">
        <li class="breadcrumb-item active">User</li>
        <li class="breadcrumb-item active">Danh sách thành viên</li>
    </ol>
    <div class="Prod highlight" id="user_table" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Danh sách thành viên</h4>
                    <?php if (checkPrivilege('user_add.php')) { ?>
                        <a href="user_add.php" class="btn btn-primary float-end"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Thêm</a>
                    <?php } ?>
                </div>
                <div class="card-body highlight">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Họ và Tên</th>
                            <th>Email</th>
                            <th>Ngày sinh</th>
                            <th>Địa chỉ</th>
                            <th>Giới tính</th>
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
                        if ($_SERVER["REQUEST_METHOD"] === "GET") {
                
                                // Xử lý Ajax request
                            $search = isset($_GET["input_value"]) ? $_GET["input_value"] : '';
                            include("../pagination/offset.php");
                            $sql = "Select * from user 
                                    where UserEmail like '%".$search."%'
                                    order by UserId desc
                                    limit ".$item_per_page." offset ".$offset." ";
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
                                <td><?= $row['HoTen']; ?></td>
                                <td><?= $row['UserEmail']; ?></td>
                                <td><?= $row['UserBirthday']; ?></td>
                                <td><?= $row['UserAddress']; ?></td>
                                <td><?php
                                    if ($row['UserGender'] == 0) {
                                    ?>
                                        <span>Nam</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span>Nữ</span>
                                    <?php
                                    }
                                    ?>
                                </td>
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
                        }}
                        ?>
                    </table>
                    <?php include("../pagination/pagination.php") ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php');
?>