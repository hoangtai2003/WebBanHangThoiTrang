<?php
require_once('../../config/config.php');
$pid = $_REQUEST['ProdId'];
$sql_delete_product = "update product set ProdStatus = 0 where ProdId = '$pid'";
$result_detete = mysqli_query($connection, $sql_delete_product);
if ($result_detete) {
    header("Location: ./myProduct.php");
}
?>