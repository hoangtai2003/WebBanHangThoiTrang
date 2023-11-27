<?php 
	require("../../config/config.php");
	$keyword = $_REQUEST["keyword"];
	if($keyword==""){

	}else{
	$sql = "select * from Product where ProdName like '%".$keyword."%' or ProdDescription like '%".$keyword."%'";
	$result = $connection->query($sql) or die($connection->error);
?>

<ul id="product-list">
	<?php while ($row=$result->fetch_assoc()){
	?>
	<li onClick="selectProduct('<?php echo $row["ProdName"];?>');">
	<a style="width:100%;" href="../categories/categories.php?ProdId=<?php echo $row["ProdId"] ?>" >
	
		<?php echo $row["ProdName"];?>
	</a>
	</li>
	<?php }} 
	$connection->close();
	?>
</ul>
