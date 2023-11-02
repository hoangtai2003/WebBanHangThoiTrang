<?php
session_start();
include("../../config/config.php");
if (!isset($_SESSION["cus_loggedin"])) {
    header("Location: ../authen/login.php");
}
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
						<li>Home</a></li>
						<li class="active"><i class="fa fa-angle-right" aria-hidden="true"></i>My Acount</a></li>
						<li class="active"><i class="fa fa-angle-right" aria-hidden="true"></i>Tài khoản của tôi</a></li>
					</ul>
                </div>
				<?php include("../authen/message.php") ?>
				<div class="row">
					<div class="col-md-12">
						<h3>Hồ sơ của tôi</h3>
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
							<style>
								.form-control{
									color: black !important;
								}
								.form-check{
									display: inline-block !important;
									margin-left: 65px;
								}
								.form-check-label{
									padding-left: 0 !important;
									font-size: 1rem;
									
								}
							</style>
							<form action="profile_edit_action.php" method="post">
								<input type="hidden" name="CusId" value="<?=$row['CusId']?>" >
								<div class="form-group">
									<label style="opacity: 0.5; ">Tên đăng nhập</label>
									<label style="margin-left: 16px;width: 40%; font-size: 1rem;"><?=$row['CusUserName'] ?></label>
								</div>
								<div class="form-group">
									<label style="opacity: 0.5; ">Tên</label>
									<label style="margin-left: 77px;width: 40%;"><input type="text" name="CusName" class="form-control" value="<?=$row['CusName']?>"></label>
								</div>
								<div class="form-group">
									<label style="opacity: 0.5; ">Số điện thoại</label>
									<label style="margin-left: 16px;width: 40%;"><input type="text" name="CusPhone" class="form-control" value="<?=$row['CusPhone']?>"></label>
								</div>
								<div class="form-group">
									<label style="opacity: 0.5; ">Email</label>
									<label style="margin-left: 63px;width: 40%;"><input type="text" name="CusEmail" class="form-control" value="<?=$row['CusEmail']?>"></label>
								</div>
								<div class="form-group" style="margin-bottom: 15px;">
									<label style="opacity: 0.5; ">Giới tính</label>
									<div class="form-check">
										<input class="form-check-input"  type="radio" name="CusGender" id="rdGender0" value=0 <?= $row['CusGender'] == 0  ? 'checked' : '' ?>>
										<label class="form-check-label" for="rdGender0">Nam</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="CusGender" id="rdGender1" value=1 <?= $row['CusGender'] == 1 ? 'checked' : '' ?>>
										<label class="form-check-label" for="rdGender1">Nữ</label>
									</div>
								</div>
								<div class="form-group">
									<label style="opacity: 0.5; ">Ngày sinh</label>
									<label style="margin-left: 32px;width: 40%;"><input type="date" name="CusBirthday" class="form-control" value="<?= $row['CusBirthday']?>"></label>
								</div>
								<button style="cursor: pointer;" type="submit" name="update_customer" class="btn btn-sm btn-danger">Lưu</button>
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
</body>

</html>
