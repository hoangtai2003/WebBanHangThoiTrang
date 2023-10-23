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
                    <h4>Slider</h4>
                    <?php if (checkPrivilege('slider_add.php')) { ?>
                        <a href="slider_add.php" class="btn btn-primary float-end"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Thêm</a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <form method="POST"></form>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th>Hình ảnh</th>
                            <?php if (checkPrivilege('slider_edit.php?slid=0')) { ?>
                                <th>Sửa</th>
                            <?php } ?>
                            <?php if (checkPrivilege('slider_delete.php?slid=0')) { ?>
                                <th>Xóa</th>
                            <?php } ?>
                        </tr>
                        <?php
                        $sql = "Select * from sliders";
                        $result = mysqli_query($connection, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $row) {
                        ?>
                                <tr>
                                    <th scope="row"><?= $row['slid']; ?></th>
                                    <td><?= $row['slname']; ?></td>
                                    <td><?= $row['sldescription']; ?></td>
                                    <td><img width=300 src="../../images/<?= $row["slimage"];?>"></td>
                                    <?php if (checkPrivilege('slider_edit.php?slid=0')) { ?>
                                        <td>
                                            <a href="slider_edit.php?slid=<?= $row['slid'] ?>" class="btn btn-success">
                                                <i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Sửa
                                            </a>
                                        </td>
                                    <?php } ?>
                                    <?php if (checkPrivilege('slider_delete.php?slid=0')) { ?>
                                        <td>
                                            <a 
                                                href="slider_delete.php?slid=<?php echo $row["slid"]; ?>" 
                                                onclick="return confirm('Are you sure delete <?= $row['slid']; ?>?');" 
                                                class="btn btn-danger" 
                                                value="<?= $row['slid']; ?>"><i class="fa-solid fa-trash" 
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php');
?>