<?php
session_start();

include('../../config/config.php');
include('../includes/header.php');
include_once('../includes/navbar_top.php');
include_once('../includes/sidebar.php');
?>
<style>
    .form-check{
    display: inline-block !important;
    margin-left: 62px;
}
</style>
<div class="container-fluid px-4">
    <ol class="breadcrumb mt-5">
    </ol>
    <div class="row">
        <div class="col-md-12">
            <h3>Thay đổi thông tin cá nhân</h3>
            <div class="cut_1"></div>
            <?php
                if(isset( $_SESSION['UserId'])){
                    $UserId = $_SESSION['UserId'];
                    $sql = "select * from user where UserId = '$UserId'";
                    $result = mysqli_query($connection, $sql);
                }
                if(mysqli_num_rows($result) > 0){
                    $row = $result->fetch_assoc();
                }
			?>
                <form action="profile_edit_action.php" method="post"  id="profileForm" enctype="multipart/form-data">
                    <input type="hidden" name="UserId" value=<?=$row['UserId'] ?> >
                    <div class="row">
                        <div style="border-right:solid 1px #ebebeb;" class="col-md-8">
                            <div class="form-group">
                                <label>Tên đăng nhập</label>
                                <label style="margin-left: 14px;" class="profile_show"><input type="text" name="UserName" class="form-control" value=<?=$row['UserName'] ?>></label>
                            </div>
                            <div class="form-group">
                                <label>Tên</label>
                                <label style="margin-left: 95px;" class="profile_show"><input type="text" name="Name" class="form-control" value="<?=$row['HoTen'] ?>"></label>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <label style="margin-left: 26px;" class="profile_show"><input type="text" name="Phone" class="form-control" value=<?=$row['UserPhone'] ?>></label>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <label style="margin-left: 81px;" class="profile_show"><input type="text" name="Email" class="form-control" value=<?=$row['UserEmail'] ?>></label>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <label style="margin-left: 73px;" class="profile_show"><input type="text" name="Address" class="form-control" value="<?=$row['UserAddress'] ?>"></label>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px;">
                                <label>Giới tính</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="UserGender" id="rdGender0" value=0 <?= $row['UserGender'] == 0  ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="rdGender0">Nam</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="UserGender" id="rdGender1" value=1 <?= $row['UserGender'] == 1 ? 'checked' : '' ?> >
                                    <label class="form-check-label" for="rdGender1">Nữ</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <label style="margin-left: 48px;" class="profile_show"><input type="date" name="UserBirthday" class="form-control" value=<?=$row['UserBirthday'] ?>></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <?php
                                    if($row['ChangeImage'] == 1){
                                        ?>
                                            <img style="margin-top: 90px;
                                                border-radius: 50%;
                                                margin-left: 111px;
                                                width: 160px;
                                                height: 140px;"
                                                src="../upload/<?= $row['UserImage'] ?>" width="760" class="img_preview">
                                        <?php
                                    } else {
                                        ?>
                                            <img style="margin-top: 90px;
                                                border-radius: 50%;
                                                margin-left: 111px;
                                                max-width: 182px;
                                                max-height: 182px;" src="<?= $row['UserImage']?>" class="img_preview">
                                        <?php
                                    }
                                ?>
							</div>
                            <div class="form-control image upload">
                                <label  for="fileInput" aria-label="Chọn ảnh" style="margin: 8px;">Chọn Ảnh</label>
                                <input type="file" hidden id="fileInput" class="input-img" name="fimage" value="<?= $row['UserImage'] ?>" >
                            </div>
                        </div>
                    </div>
                    <button name="update_user" class="btn btn-success mt-2">Cập nhật</button>
                    <a href="../User/user_list.php" class="btn btn-danger mt-2">Hủy bỏ</a>
                </form>
            </div>
            <div class="cut_2"></div>
            <h3 style="margin-top: 15px;">Thay đổi mật khẩu</h3>
            <form method="POST" action="change_password_action.php">
            <input type="hidden" name="UserId" value=<?=$row['UserId'] ?> >
                <div class="row">
                    <div class="col-md-12 change_password">
                        <div class="form-group change_margin ">
                            <label>Nhập mật khẩu cũ</label>
                            <input required type="password" name="password_old" class="form-control" >
                        </div>
                        <div class="form-group change_margin ">
                            <label>Nhập mật khẩu mới</label>
                            <input required type="password" name="password_new" class="form-control">
                        </div>
                        <div class="form-group change_margin">
                            <label>Xác nhận mật khẩu</label>
                            <input required type="password" name="cpassword_new" class="form-control">
                        </div>
                    </div>
                </div>
                <button name="change_btn" class="btn btn-success mt-2">Thay đổi</button>
                <a href="../User/user_list.php" class="btn btn-danger mt-2">Hủy bỏ</a>
            </form>
    </div>
</div>
<script>
    const inputImg = document.querySelector('.input-img')
    inputImg.addEventListener('input', (e) => {
        let file = e.target.files[0]
        if (!file) return
        document.querySelector(".img_preview").src = URL.createObjectURL(file)
        document.querySelector("#avt_link_img").value = inputImg.value.substring(inputImg.value.lastIndexOf('\\') + 1);
        document.querySelector('.preview').appendChild(img)
    })

    window.onload = function() {
        openModal();
    }
</script>
<?php 
    include('../includes/footer.php');
?>
