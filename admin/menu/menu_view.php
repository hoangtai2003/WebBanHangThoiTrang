<?php
    session_start();
   
    if(!isset($_SESSION["menu_error"])){
        $_SESSION["menu_error"]="";
    }
    include('../includes/header.php'); 
    include_once('../includes/navbar_top.php');
    include_once('../includes/sidebar.php');
    include("../../config/config.php");
?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mt-5">
        <li class="breadcrumb-item active">Menu</li>
        <li class="breadcrumb-item active">Danh sách Menu</li>
    </ol>   
    <div class="row">
        <?php include('../authen/message.php'); ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Danh sách Menu</h4>
                    <?php if (checkPrivilege('menu_add.php')) { ?>
                    <a 
                        href="menu_add.php" 
                        class="btn btn-primary float-end">
                        <i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Thêm Menu
                    </a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Id</th>
                            <th>Tên Menu</th>
                            <th>Link</th>
                            <?php if (checkPrivilege('menu_edit.php?MenuId=0')) { ?>
                            <th>Sửa</th>
                            <?php } ?>
                            <?php if (checkPrivilege('menu_delete.php?MenuId=0')) { ?>
                            <th>Xóa</th>
                            <?php } ?>

                        </tr>
                            <?php
                            include("../OffsetPagination/offset.php");
                            $result= $connection->query("select * from menu order by MenuId asc limit ".$item_per_page." offset ".$offset."");
                            $totalRecords = mysqli_query($connection, "select * from menu");
                            $totalRecords = $totalRecords->num_rows;
                            // Tổng số trang = tổng số sản phẩm / tổng số sản phẩm một trang
                            $totalPage = ceil($totalRecords / $item_per_page);
                            while($row= $result->fetch_assoc()){
                                ?>
                        <tr>
                        <td><?php echo $row["MenuId"];?></td>
                        <td><?php echo $row["MenuName"];?></td>
                        <td><?php echo $row["MenuLink"];?></td>
                        <?php if (checkPrivilege('menu_edit.php?MenuId=0')) { ?>
                        <td>
                            <a 
                                class="btn btn-success" 
                                href="menu_edit.php?MenuId=<?php echo $row["MenuId"];?>"><i 
                                class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Sửa
                            </a>
                        </td>
                        <?php } ?>
                        <?php if (checkPrivilege('menu_delete.php?MenuId=0')) { ?>
                            <td>
                                <a 
                                    href="menu_delete.php?MenuId=<?php echo $row["MenuId"];?>"
                                    class="btn btn-danger action_delete" 
                                    value="<?= $row['MenuId']; ?>"><i class="fa-solid fa-trash" 
                                    style="margin-right: 5px;"></i>Xóa
                                </a>
                            </td>
                        <?php } ?>
                        </tr>
                        <?php
                            }
                            $connection->close();
                        ?>
                    </table>
                    <?php include("../../pagination/pagination.php") ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    unset($_SESSION["menu_error"]);
    include_once('../includes/footer.php');
?>

