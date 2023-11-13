<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
require_once('../../config/config.php');
if (isset($_GET["CateId"])){
    $CateId = $_REQUEST['CateId'];
    $sql = "select * from categories where CateId = ".$CateId;
	$result = $connection->query($sql) or die($connection->error);
	if ($result->num_rows==0){
		header("Location: myCategory.php");
	} else {
		$row = $result->fetch_assoc();
}

?>
<div class="container-fluid px-4">
    <ol class="breadcrumb mt-5">
    </ol>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Sửa danh mục</h4>
                </div>
                <div class="card-body">
                    <form action="editCateGoryAction.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input hidden type="text" name="category_id" class="form-control" value="<?=$row['CateId'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" name="txtCateName" class="form-control" value="<?= $row['CateName']?>">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" rows="5" cols="90" name="taCatedesc"><?= $row['CateDescription']?> </textarea>
                        </div>
                        <div class="form-group" style="margin-bottom: 15px;">
                                <label>Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input"  type="radio" name="rdstatus" id="rdstatus1" value=1 <?= $row['CateStatus'] == 1 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="rdstatus1">Hoạt động</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rdstatus" id="rdstatus0" value=0 <?= $row['CateStatus'] == 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="rdstatus0">Ngừng hoạt động</label>
                                </div>
                            </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control" name="fimage" id="input-img">
                            <input type="hidden" name="current_image" value="<?= $row['CateImage'] ?>">
                            <img style="margin-top: 10px;" src="../upload/<?=$row['CateImage'] ?>" width="300px" class="img_preview">
                        </div>                          
                        <button name="update_category" class="btn btn-primary mt-2">Cập nhật</button>
                        <a href="myCategory.php" class="btn btn-danger mt-2">Quay lại</a>
                        <?php }?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php');
?>