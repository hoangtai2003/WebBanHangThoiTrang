<?php
session_start();
include("../../config/config.php");
if (!isset($_SESSION["cus_loggedin"])) {
    header("Location: ../authen/login.php");
}
include('../../helpers/function.php');
?>
<head>
    <title>Colo Shop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/styles/bootstrap4/bootstrap.min.css">
    <link href="../assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../assets/styles/categories_styles.css">
    <link rel="stylesheet" type="text/css" href="../assets/styles/categories_responsive.css">
	<link rel="stylesheet" type="text/css" href="../assets/styles/profile.css">
	<link href="../../admin/assets/css/toastr.min.css" rel="stylesheet">
</head>

<body>

<div class="super_container">

	<!-- Header -->
    <?php include_once("../includes/header.php") ?>

	<div class="fs_menu_overlay"></div>
	<?php include_once("../includes/hamburger_menu.php") ?>
	<div class="container product_section_container">
		<div class="row">
			<div class="col product_section clearfix">
				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li>Trang chủ</a></li>
						<li class="active"><i class="fa fa-angle-right" aria-hidden="true"></i>Tài khoản của tôi</a></li>
					</ul>
                </div>
				<div class="row">
					<div class="col-md-12">
						<h3>Hồ sơ của tôi</h3>
						<p>Quản lý thông tin hồ sơ để bảo mật tài khoản </p>
						<div class="cut"></div>
							<?php
							if(isset( $_SESSION['cusid'])){
								$CusId = $_SESSION['cusid'];
								$sql = "select * from customer where CusId = '$CusId'";
								$result = mysqli_query($connection, $sql);
							}
							if(mysqli_num_rows($result) > 0){
								$row = $result->fetch_assoc();
							}
							?>
							<form action="profile_edit_action.php" method="post"  id="profileForm" enctype="multipart/form-data">
								<input type="hidden" name="CusId" value="<?=$row['CusId']?>" >
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<label style="opacity: 0.5;">Tên đăng nhập</label>
											<?php
												if ($row['ChangeUserName'] == 0) {
													?>
														<label class="profile_show" style="margin-left: 16px;; font-size: 1rem;">
															<input type="text" class="form-control" name="new_username" value="<?=$row['CusUserName']?>">
														</label>
													<?php
												} else {
													?> 
														<label style="margin-left: 16px; font-size: 1rem;"><?=$row['CusUserName'] ?> </label>
													<?php
												}
											?>
										</div>
										<div class="form-group">
											<label class="profile_name">Tên</label>
											<label style="margin-left: 95px;" class="profile_show"><input type="text" name="CusName" class="form-control" value="<?=$row['CusName']?>"></label>
										</div>
										<div class="form-group">
											<label style="opacity: 0.5;" class="profile_name">Số điện thoại</label>
											<label style="margin-left: 31px;" class="profile_show"><input type="text" name="CusPhone" class="form-control" value="<?=$row['CusPhone']?>"></label>
										</div>
										<div class="form-group">
											<label class="profile_name">Email</label>
											<label style="margin-left: 78px;" class="profile_show"><input type="text" name="CusEmail" class="form-control" value="<?=$row['CusEmail']?>"></label>
										</div>
										<div class="form-group" style="margin-bottom: 15px;">
											<label class="profile_name">Giới tính</label>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="CusGender" id="rdGender0" value=0 <?= $row['CusGender'] == 0  ? 'checked' : '' ?>>
												<label class="form-check-label" for="rdGender0">Nam</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="CusGender" id="rdGender1" value=1 <?= $row['CusGender'] == 1 ? 'checked' : '' ?>>
												<label class="form-check-label" for="rdGender1">Nữ</label>
											</div>
										</div>
										<div class="form-group">
											<label class="profile_name">Ngày sinh</label>
											<label style="margin-left: 43px;" class="profile_show"><input type="date" name="CusBirthday" class="form-control" value="<?= $row['CusBirthday']?>"></label>
										</div>
									</div>
									<div class="col-md-4">
										<div>
										<?php
											if($row['ChangeImage'] == 1){
												?>
													<img style="margin-top: 14px;
														border-radius: 50%;
														margin-left: 98px;
														max-width: 182px;
														max-height: 182px;"
														src="../upload/<?= $row['CusImage'] ?>" width="760" class="img_preview">
												<?php
											} else {
												?>
													<img style="margin-top: 14px;
														border-radius: 50%;
														margin-left: 98px;
														max-width: 182px;
														max-height: 182px;" src="<?= $row['CusImage']?>" class="img_preview">
												<?php
											}
										?>
										</div>
										<style>
											.upload:hover{
												background: rgba(0,0,0,.02);
												cursor: pointer;
												opacity: 0.5;
											}
											
										</style>
										<div class="form-control image upload">
											<label  for="fileInput" aria-label="Chọn ảnh" style="margin: 8px;">Chọn Ảnh</label>
											<input type="file" hidden id="fileInput" class="input-img" name="fimage" value="<?= $row['CusImage'] ?>" >
										</div>
									</div>
								</div>
								<button style="cursor: pointer;" type="submit" name="update_customer" class="btn btn-sm btn-danger p-2" id="saveButton" >Lưu</button>
							</form>
					</div>
				</div>
			
			</div>
		</div>
	</div>

    <?php include_once("../includes/benefit.php") ?>
    <?php include_once("../includes/newsletter.php") ?>
    <?php include_once("../includes/footer.php") ?>

</div>
<script src="../assets/js/jquery-3.2.1.min.js"></script>
<script src="../assets/styles/bootstrap4/popper.js"></script>
<script src="../assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="../assets/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="../assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="../assets/plugins/easing/easing.js"></script>
<script src="../assets/js/custom.js"></script>
<script src="../assets/js/handlebutton.js"></script>
<script src="../assets/js/show_image.js"></script>
<script src="../../admin/assets/js/toastr.min.js"></script>
<script src="../../admin/assets/js/toastr.js"></script>
<script>
	<?php if (isset($_SESSION['message'])) : ?>
		<?php
			$message = flash('message');
			$message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'success';
		?>
		toastr.<?php echo $message_type; ?>("<?php echo $message; ?>");
	<?php endif; ?>
</script>
</body>

</html>
