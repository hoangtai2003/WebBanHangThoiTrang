<?php
require_once('../../config/config.php');
$pid = $_REQUEST['ProdId'];
$pname = $_POST["pname"];
$pquantity = $_POST["pquantity"];
$pprice = $_POST["pprice"];
$ppricesale = $_POST["ppricesale"];
$pdesc = $_POST["pdesc"];
$pissale = $_POST["rdProdIsSale"];
$pstatus = $_POST["rdProdStatus"];
$CateId = $_POST["slCid"];


$sqlProd = "SELECT * from  product where product.ProdId = $pid";
$product = mysqli_query($connection, $sqlProd);
$dataProduct = mysqli_fetch_assoc($product);

// ảnh đại diện
if (isset($_FILES['pimage'])) {
    $file = $_FILES['pimage'];
    $file_name = $file['name'];
    if (empty($file_name)) {
        $file_name = $dataProduct['ProdImage'];
    } else {
        if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' ||  $file['type'] == 'image/png') {
            move_uploaded_file($file['tmp_name'], '../../images/' . $file_name);
        } else {
            $_SESSION['message'] = "Không đúng định dạng";
            $_SESSION['message_type'] = 'error';
            $file_name = '';
        }
    }
}

/// ảnh mô tả
if (isset($_FILES['pimages'])) {
    $files = $_FILES['pimages'];
    $file_names = $files['name'];
    if (!empty($file_names[0])) {
        mysqli_query($connection, "delete from productimage where ProdId = $pid");

        foreach ($file_names as $key => $value) {
            move_uploaded_file($files['tmp_name'][$key], '../../images/' . $value);
        }
        foreach ($file_names as $key => $value) {
            $sqlInsertImage = "INSERT INTO productimage(ProdId, Image) values (" . $pid . ",  '" . $value . "' ) ";
            mysqli_query($connection,  $sqlInsertImage);
        }
    }
}

$sqlupdate = "update Product set ProdName = '$pname', ProdDescription = '$pdesc', ProdImage = '$file_name', ProdPrice = '$pprice', ProdPriceSale = '$ppricesale', ProdQuantity = '$pquantity',ProdIsSale = '$pissale',ProdStatus = '$pstatus',CateId = '$CateId' where ProdId = $pid";
$query = mysqli_query($connection, $sqlupdate);
if ($query) {
    $_SESSION['message'] = "Thêm sản phẩm thành công";
    $_SESSION['message_type'] = 'success';
    header("Location: ./myProduct.php");
} else {
    $_SESSION['message'] = "Lỗi thêm sản phẩm";
    $_SESSION['message_type'] = 'error';
}
