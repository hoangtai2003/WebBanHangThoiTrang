<?php
session_start();
require_once('../../config/config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['slCid'])) {
        $CateId = $_POST['slCid'];
        $userid = $_SESSION['UserId'];
        $pname = $_POST['product_name'];
        $pdesc = $_POST['product_desc'];
        $pquantity = $_POST['product_quantity'];
        $pprice = $_POST['product_price'];
        $ppricesale = $_POST['product_sale_price'];
        if (isset($_FILES['txtPimage']) && $_FILES['txtPimage']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["txtPimage"]["tmp_name"];
            $ext = pathinfo($_FILES["txtPimage"]["name"], PATHINFO_EXTENSION);
            $pimage = uniqid() . '.' . $ext;
            move_uploaded_file($tmp_name, "../../images/" . $pimage);
            echo "Cate:" .$CateId;
            echo "<br>User: $userid";
            $sqlinsert = "insert into Product(ProdName, ProdDescription, ProdImage, ProdPrice, ProdPriceSale, ProdQuantity, CateId, UserId) values('" . $pname . "','" . $pdesc . "','" . $pimage . "'," . $pprice . "," . $ppricesale . "," . $pquantity . ",".$CateId.",". $userid . ")";
            $connection->query($sqlinsert) or die($connection->connect_error);
            echo "Thêm sản phẩm thành công";
            header("Location: ../myProduct/myProduct.php");
        }
    }
}
