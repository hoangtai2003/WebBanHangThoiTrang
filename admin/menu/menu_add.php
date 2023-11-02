<?php 
	session_start();
	
	include('../includes/header.php'); 
    include_once('../includes/navbar_top.php');
    include_once('../includes/sidebar.php');
    include("../../config/config.php");
?>
<div class="container-fluid px-4">
	<ol class="breadcrumb mt-5">
		<li class="breadcrumb-item active">Menu</li>
		<li class="breadcrumb-item active">Thêm Menu</li>
	</ol>
	<div class="row">
		<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h4 >Thêm Menu</h4>
					</div>
					<div class="card-body">
						<form method=POST action="menu_add_action.php">
							<div class="form-group" style="margin-bottom: 15px;">
								<label>Tên Menu</label>
								<input type="text" name="txtMenuname" class="form-control" value="">
							</div>
							<div class="form-group" style="margin-bottom: 15px;">
								<label>Link</label>
								<input type="text" name="txtMenuLink" class="form-control" value="">
							</div>
							<button name="add_menu" class="btn btn-primary mt-2">Gửi đi</button>
							<a href="menu_view.php" class="btn btn-danger mt-2">Quay lại</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
	unset($_SESSION["menu_add_error"]);
?>