<?php
session_start();
include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
require_once('../../config/config.php');

?>
    <!-- container-category-->
<div class="container-fluid px-4">
    <ol class="breadcrumb mt-5">
        <li class="breadcrumb-item active">Danh mục</li>
        <li class="breadcrumb-item active">Danh sách danh mục</li>
    </ol>
    <div class="Prod">
        <?php include('../authen/message.php'); ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Danh sách danh mục</h4>
                    <?php if (checkPrivilege('createCategory.php')) { ?>
                    <a 
                        href="createCategory.php" 
                        class="btn btn-primary float-end">
                        <i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Thêm danh mục
                    </a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Miêu tả</th>
                                <th scope="col">Trạng thái</th>
                                <?php if (checkPrivilege('editCategory.php?CateId=0')) { ?>
                                <th scope="col">Sửa</th>
                                <?php } ?>
                                <?php if (checkPrivilege('deleteCategoryAction.php?CateId=0')) { ?>
                                <th scope="col">Xóa</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include("../OffsetPagination/offset.php");
                            $result = $connection->query("select * from categories order by CateId asc limit ".$item_per_page." offset ".$offset."");
                            $totalRecords = mysqli_query($connection, "select * from categories");
                            $totalRecords = $totalRecords->num_rows;
                            // Tổng số trang = tổng số sản phẩm / tổng số sản phẩm một trang
                            $totalPage = ceil($totalRecords / $item_per_page);
                            while ($row = $result->fetch_assoc()){
                                ?>
                                    <tr>
                                        <td><?= $row['CateId']; ?></td>
                                        <td><?= $row['CateName']; ?></td>
                                        <td style="width: 150px"><img style="width: 150px;" src="../upload/<?= $row['CateImage']; ?>" alt=""></td>
                                        <td><?= $row['CateDescription']; ?></td>
                                        <td><?= $row['CateStatus']; ?></td>
                                        <?php if (checkPrivilege('editCategory.php?CateId=0')) { ?>
                                            <td>
                                                <a 
                                                    href="editCategory.php?CateId=<?=$row['CateId'] ?>" 
                                                    class="btn btn-success">
                                                    <i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Sửa
                                                </a>
                                            </td>
                                        <?php } ?>
                                        <?php if (checkPrivilege('deleteCategoryAction.php?CateId=0')) { ?>
                                        <td>
                                            <a 
                                                href="deleteCategoryAction.php?CateId=<?=$row['CateId']?>"
                                                class="btn btn-danger action_delete" 
                                                value="<?= $row['CateId']; ?>"><i class="fa-solid fa-trash" 
                                                style="margin-right: 5px;"></i>Xóa
                                            </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php include("../../pagination/pagination.php") ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once('../includes/footer.php');
?>