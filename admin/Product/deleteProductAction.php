<?php
require_once('../../config/config.php');
$pid = $_REQUEST['ProdId'];
$sqldelete = "delete from product where ProdId = '$pid'";
$query = mysqli_query($connection, $sqldelete);
if ($query) {
    header("Location: ./myProduct.php");
}
?>