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
<html>
	<head>
		<meta charset="utf-8">
		
	</head>
	<body>
	<div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">User</li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
						<h4>Sửa Menu</h4>
					</div>
					<div class="card-body">
		<form method=POST action="menu_edit_action.php?MenuId=<?php echo $menuid;?>">
			<table border=0 align=center cellspacing=10>
				<tr>
					<td align=right>Menu Name:</td>
					<td><input type=text name=txtMenuname class="form-control" value="<?php echo $row["MenuName"]?>"></td>
				<tr>
				
				<tr>
					<td align=right valign=top>Menu Link:</td>
					<td><input type=text name=txtMenuLink class="form-control" value="<?php echo $row["MenuLink"]?>"></td>
				</tr>
				
				<tr>
					<td align=right><input type=submit value="Update" class="btn btn-primary mt-2"></td>
					<td><input type=reset class="btn btn-primary mt-2">
				</tr>
			</table>
		</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php 
	}
	$connection->close();
	unset($_SESSION["menu_edit_error"]);
?>