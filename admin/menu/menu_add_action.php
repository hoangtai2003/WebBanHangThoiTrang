
<?php 
	session_start();
	$menuid=$_POST["MenuId"];
	$menuname=$_POST["txtMenuname"];
	
	$menulink= $_POST["txtMenuLink"];
	
	//  var_dump($menuname);
	// var_dump($menucreatedate);
	// var_dump($menumodifieddate);
	require_once("../../config/config.php");
	
	$sql = "select * from menu where MenuName like '".$menuname."'";
	
	$result = $connection->query($sql) ;
	echo "".$result->num_rows."";
	// if ($result->num_rows > 0){
	// 	$_SESSION["menu_add_error"]="Menu name: $menuname exist!";
	// 	header("Location:menu_addC.php");
	// } else {
		
		$sqlinsert = "INSERT INTO menu ( MenuName,  MenuLink) VALUES ( '$menuname' ,'$menulink')";
		$connection->query($sqlinsert) or die($connection->error);
		if($connection->error==""){
			$_SESSION["message"]="Thêm thành công";
			$_SESSION['message_type'] = 'success';
				
				header("Location:menu_view.php");
			}else {
				$_SESSION["message"]="Đã có lỗi xảy ra";
				$_SESSION['message_type'] = 'error';
				header("Location:menu_add.php");
		
	}
// }
