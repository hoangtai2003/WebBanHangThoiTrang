<?php
include("../../config/config.php"); 
if (isset($_SESSION['UserId'])){
	$Userid = $_SESSION['UserId'];
	$sql = "select * from user where UserId = '$Userid'";
	$result = mysqli_query($connection, $sql);
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
	}
}        
?>
<style>
	.account_img{
	width: 22px;
	height: 22px;
	border-radius: 50%;
	margin-bottom: -3px;
	margin-right: 10px;
}
.navbar-expand .navbar-nav .dropdown-menu {
    margin-top: 8px !important;
}
</style>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
	<!-- Navbar Brand-->
	<?php
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
		?>
			<a href="#" class="navbar-brand ps-3">
			<?php
				if($row['ChangeImage'] == 1){
					?>
						<img class="account_img" src="../upload/<?= $row['UserImage']?>">
					<?php
				} else {
					?>
						<img class="account_img" src="<?= $row['UserImage']?>">
					<?php
				}
			?>
				<?= $row['HoTen']?>
			</a>
		<?php } else {
			header('Location: ../authen/login.php');
		}
	?>
	<!-- Sidebar Toggle-->
	<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
	<!-- Navbar Search-->
	<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
		<!-- <div class="input-group">
			<input class="form-control" type="text" placeholder="Tìm kiếm..." aria-describedby="btnNavbarSearch" />
			<button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
		</div> -->
	</form>
	<!-- Navbar-->
	<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i style="margin-right: 10px;" class="fas fa-user"></i>My Account</a>
			<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
				<li><a class="dropdown-item" href="../information/profile.php">Thông tin cá nhân</a></li>
				<li><hr class="dropdown-divider" /></li>
				<li>
					<form action="../authen/logout_action.php" method="POST">
						<button type="submit" name="logout_btn" class="dropdown-item">Đăng xuất</button>
					</form>
				</li>
			</ul>
		</li>
	</ul>
</nav>