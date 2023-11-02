<?php
    require_once('../../config/config.php');
    $ProdId = $_REQUEST['ProdId'];
    $ProdName = $_POST["ProdName"];
    $ProdQuantity = $_POST["ProdQuantity"];
    $ProdPrice = $_POST["ProdPrice"];
    $ProdPriceSale = $_POST["ProdPriceSale"];
    $ProdDescription = $_POST["ProdDescription"];
    $CateId = $_POST["slCid"];
    $OldCateId = $_POST["OldCateId"];
    echo "mã sp: $ProdId";
    echo "mã danh mục cũ: $OldCateId";
    echo "Mã danh mục: $CateId";
    if ($OldCateId != $CateId) {
        $sqlUpdateCate = "UPDATE product SET CateId = ? WHERE ProdId = ?";
        $stmtUpdateCate = $connection->prepare($sqlUpdateCate);
        $stmtUpdateCate->bind_param("ii", $CateId, $ProdId);
        $stmtUpdateCate->execute();
        echo "cập nhật danh mục thành công";
    }
    if (isset($_FILES['ProdImage']) && $_FILES['ProdImage']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["ProdImage"]["tmp_name"];
        $ext = pathinfo($_FILES["ProdImage"]["name"], PATHINFO_EXTENSION);
        $ProdImage = uniqid() . '.' . $ext;
        move_uploaded_file($tmp_name, "../../images/" . $ProdImage);
        echo "Tên ảnh: $ProdImage";
        $sqlUpdateProduct = "UPDATE product 
        SET ProdName = ?, ProdQuantity = ?, ProdPrice = ?, ProdPriceSale = ?, ProdDescription = ?, ProdImage = ?
        WHERE ProdId = ?";
        $stmtUpdateProduct = $connection->prepare($sqlUpdateProduct);
        $stmtUpdateProduct->bind_param("siidssi", $ProdName, $ProdQuantity, $ProdPrice, $ProdPriceSale, $ProdDescription, $ProdImage, $ProdId);
        if ($stmtUpdateProduct->execute()) {
            echo "Cập nhật sản phẩm thành công";
            header("Location: ../myProduct/myProduct.php");
        } else {
            echo "Lỗi khi cập nhật sản phẩm.";
        }
    } else {
        $sqlUpdateProduct = "UPDATE product 
        SET ProdName = ?, ProdQuantity = ?, ProdPrice = ?, ProdPriceSale = ?, ProdDescription = ?
        WHERE ProdId = ?";
        $stmtUpdateProduct = $connection->prepare($sqlUpdateProduct);
        $stmtUpdateProduct->bind_param("siiisi", $ProdName, $ProdQuantity, $ProdPrice, $ProdPriceSale, $ProdDescription, $ProdId);
        if ($stmtUpdateProduct->execute()) {
            echo "Cập nhật sản phẩm thành công";
            header("Location: ../myProduct/myProduct.php");
        } else {
            echo "Lỗi khi cập nhật sản phẩm.";
        }
    }
    
?>