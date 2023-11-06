<?php
require_once('../../config/config.php');
$pid = $_REQUEST['ProdId'];
$sqldelete = "update product set ProdStatus = 0 where ProdId = '$pid'";
$query = mysqli_query($connection, $sqldelete);
if ($query) {
    header("Location: ./myProduct.php");
}
?>