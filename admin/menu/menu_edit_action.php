<?php 
	session_start();
	require("../../config/config.php");
	$menuid = $_REQUEST["MenuId"];
	$menuname = $_POST["txtMenuname"];
	
	$menulink=$_POST["txtMenuLink"];
	
	$sql = "select * from menu where MenuName like'$menuname' and MenuId <> '$menuid'";
	$result = $connection->query($sql) or die($connection->error);
	if ($result->num_rows>0){
		$_SESSION["menu_edit_error"]="$menuname exist!";
		header("Location:menu_edit.php? MenuId = $menuid");
	} else {
		$sql_update="UPDATE menu set 
						MenuName='$menuname',
						
						MenuLink='$menulink'
						
						where MenuId = '$menuid' ";
		$connection->query($sql_update) or die($connection->error);
		
		$_SESSION["menu_error"]="Cập nhật thành công!";
		header("Location:menu_view.php");
		$connection->close();
	}
?>