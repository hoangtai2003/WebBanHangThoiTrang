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
                    <h4>Sửa slider</h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['slid'])) {
                        $slider_id = $_GET['slid'];
                        $sql = "Select * from sliders where slid = '$slider_id'";
                        $result = mysqli_query($connection, $sql);
                        $connection->close();
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $slider) {
                    ?>
                        <form action="slider_edit_action.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input hidden type="text" name="slider_id" class="form-control" value="<?=$slider['slid'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" name="name" class="form-control" value="<?= $slider['slname']?>">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" rows="5" cols="90" name="sldescription"><?= $slider['sldescription']?> </textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" class="form-control" name="fimage" id="input-img">
                                <input type="hidden" name="current_image" value="<?= $slider['slimage'] ?>">
                                <img style="margin-top: 10px;" src="../upload/<?=$slider['slimage'] ?>" width="760" class="img_preview">
                                
                            </div>                          
                            <button name="update_slider" class="btn btn-primary mt-2">Cập nhật</button>
                            <a href="slider_list.php" class="btn btn-danger mt-2">Quay lại</a>
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