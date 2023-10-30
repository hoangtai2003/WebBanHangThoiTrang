<?php 
	session_start();
	
	include('../includes/header.php'); 
    include_once('../includes/navbar_top.php');
    include_once('../includes/sidebar.php');
    include("../../config/config.php");
	$menuid =$_REQUEST["MenuId"];
	
	$sql = "select * from menu where MenuId = ".$menuid;
	
	$result = $connection->query($sql) or die($connection->error);
	if ($result->num_rows==0){
		$_SESSION["menu_error"]="Data not exist!";
		header("Location:menu_view.php");
	} else {
		$row = $result->fetch_assoc();
?>
<div class="container-fluid px-4">
	<ol class="breadcrumb mt-5">
	</ol>
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h4>Sửa Menu</h4>
				</div>
				<div class="card-body">
					<form method=POST action="menu_edit_action.php?MenuId=<?php echo $menuid;?>">
						<div class="form-group" style="margin-bottom: 15px;">
							<label>Tên Menu</label>
							<input type="text" name="txtMenuname" class="form-control" value="<?= $row['MenuName'] ?>">
						</div>
						<div class="form-group" style="margin-bottom: 15px;">
							<label>Link</label>
							<input type="text" name="txtMenuLink" class="form-control" value="<?= $row['MenuLink'] ?>">
						</div>
						<button name="update_menu" class="btn btn-primary mt-2">Cập nhật</button>
						<a href="menu_view.php" class="btn btn-danger mt-2">Quay lại</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	}
	$connection->close();
	unset($_SESSION["menu_edit_error"]);
?>