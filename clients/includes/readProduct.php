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
		<?php echo $row["ProdName"];?>
	</li>
	<?php }} 
	$connection->close();
	?>
</ul>
