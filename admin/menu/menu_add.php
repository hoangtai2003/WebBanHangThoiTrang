<?php 
	session_start();
	
	include('../includes/header.php'); 
    include_once('../includes/navbar_top.php');
    include_once('../includes/sidebar.php');
    include("../../config/config.php");
?>
<html>
	<head>
		<meta charset="utf-8">
		
	</head>
	<body>
	<div class="container-fluid px-4">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">User</li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
        <div class="row">
		<div class="col-md-6">
                <div class="card">
                    <div class="card-header">
						<h4 >Add new menu</h4>
					</div>
					<div class="card-body">
		<form method=POST action="menu_add_action.php">
		<table align=center border=0>
			<tr>
				<td align=right>Menu Name:</td>
				<td><input type=text name=txtMenuname class="form-control"></td>
			</tr>
			

			<tr>
				<td align=right>Menu Link:</td>
				<td>
					<input type=text name=txtMenuLink class="form-control">
				
				</td>
			</tr>
			
			<tr>
				<td align=right><input type=submit value="Add new" class="btn btn-primary mt-2"></td>
				<td><input type=reset class="btn btn-primary mt-2"></td>
			</tr>
		</table>
		</form>
					</div>
				</div>
		</div>
	</body>
</html>
<?php 
	unset($_SESSION["menu_add_error"]);
?>