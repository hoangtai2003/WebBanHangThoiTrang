<?php 
session_start();
require_once('../../config/config.php');
if (isset($_POST['slCid'])) {
    $CateId = $_POST['slCid'];
    $userid = $_SESSION["UserId"];
    $pname = $_POST['pname'];
    $pdesc = $_POST['pdesc'];
    $pquantity = $_POST['pquantity'];
    $pprice = $_POST['pprice'];
    $ppricesale = $_POST['ppricesale'];
    if (isset($_FILES['pimage'])) {
        $file = $_FILES['pimage'];
        $file_name = $file['name'];
        if($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' ||  $file['type'] == 'image/png') {
            move_uploaded_file($file['tmp_name'], '../../images/' . $file_name);
        } else {
            echo"Không đúng định dạng";
            $file_name = '';
        }
    }
    if (isset($_FILES['pimages'])) {
        $files = $_FILES['pimages'];
        $file_names = $files['name'];
        foreach($file_names as $key => $value) {
            move_uploaded_file($files['tmp_name'][$key], '../../images/' . $value);
        }
    }
    $sqlinsert = "insert into Product(ProdName, ProdDescription, ProdImage, ProdPrice, ProdPriceSale, ProdQuantity, CateId, UserId) values('" . $pname . "','" . $pdesc . "','" . $file_name . "'," . $pprice . "," . $ppricesale . "," . $pquantity . "," . $CateId . "," . $userid . ")";
    $query = mysqli_query($connection, $sqlinsert);
    $ProdId = mysqli_insert_id($connection);
    foreach ($file_names as $key => $value) {
        mysqli_query($connection, "insert into productimage(ProdId, Image) values ('$ProdId', '$value') ");
    }
    if ($query) {
        echo "Thêm sản phẩm thành công";
        header("Location: ./myProduct.php");
    } else {
        echo "Lỗi thêm sản phẩm";
    }
   
}
?>