<?php
session_start();
require_once('../../config/config.php');
if (isset($_POST['slCid'])  && $_POST['slCid'] !== "") {
    $CateId = $_POST['slCid'];
    $userid = $_SESSION["UserId"];
    $pname = $_POST['pname'];
    $pdesc = $_POST['pdesc'];
    $pquantity = $_POST['pquantity'];
    $pprice = $_POST['pprice'];
    $ppricesale = $_POST['ppricesale'];
    // kiểm tra tên sản phẩm đã tồn tại chưa
    $sql_check_product = "select * from product where ProdName like '" . $pname . "'";
    $rerult_check_product = $connection->query($sql_check_product) or die($conn->connect_error);
    if ($rerult_check_product->num_rows > 0) {
        $_SESSION["message"] = "Sản phẩm: $pname đã tồn tại!";
        $_SESSION['message_type'] = 'error';
        header("Location: ./myProduct.php");
    } else {
        // ảnh sản phẩm
        if (isset($_FILES['pimage'])) {
            $file = $_FILES['pimage'];
            $file_name = $file['name'];
            if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' ||  $file['type'] == 'image/png') {
                move_uploaded_file($file['tmp_name'], '../../images/' . $file_name);
            } else {
                $_SESSION['message'] = "Không đúng định dạng";
                $_SESSION['message_type'] = 'error';
                $file_name = '';
            }
        }
        // ảnh mô tả
        if (isset($_FILES['pimages'])) {
            $files = $_FILES['pimages'];
            $file_names = $files['name'];
            foreach ($file_names as $key => $value) {
                move_uploaded_file($files['tmp_name'][$key], '../../images/' . $value);
            }
        }
        if ($ppricesale < $pprice) {
            $sqlinsert = "insert into Product(ProdName, ProdDescription, ProdImage, ProdPrice, ProdPriceSale, ProdQuantity, CateId, UserId) values('" . $pname . "','" . $pdesc . "','" . $file_name . "'," . $pprice . "," . $ppricesale . "," . $pquantity . "," . $CateId . "," . $userid . ")";
            $query = mysqli_query($connection, $sqlinsert);
            $ProdId = mysqli_insert_id($connection);
            foreach ($file_names as $key => $value) {
                mysqli_query($connection, "insert into productimage(ProdId, Image) values ('$ProdId', '$value') ");
            }
            if ($query) {
                $_SESSION['message'] = "Thêm sản phẩm thành công";
                $_SESSION['message_type'] = 'success';
                header("Location: ./myProduct.php");
            } else {
                $_SESSION['message'] = "Lỗi thêm sản phẩm";
                $_SESSION['message_type'] = 'error';
            }
        } else {
            $_SESSION['message'] = "Giá Sale nhập vào phải nhỏ hơn giá bán";
            $_SESSION['message_type'] = 'error';
            header("Location: ./createProduct.php");
        }
    }
} else {
    $_SESSION['message'] = "Vui lòng chọn danh mục của sản phẩm";
    $_SESSION['message_type'] = 'error';
    header("Location: ./createProduct.php");
}
