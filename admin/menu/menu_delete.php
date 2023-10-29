<?php 
	session_start();
	require("../../config/config.php");
	$menuid = $_GET["MenuId"];
	$sql = "delete from menu where MenuId=$menuid";
	$connection->query($sql) or die($connection->error);
	$connection->close();
	$_SESSION["menu_error"]="Delete success!";
	//echo "test";
	header("Location:menu_view.php");
?>

<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	</body>
</html>