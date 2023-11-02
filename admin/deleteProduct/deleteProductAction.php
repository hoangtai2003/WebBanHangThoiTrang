<?php
require_once('../../config/config.php');
$ProdId = isset($_REQUEST['ProdId']) ? intval($_REQUEST['ProdId']) : 0;

if ($ProdId > 0) {
    $sqlProd = "DELETE FROM product WHERE ProdId = ?";
    
    $stmt = $connection->prepare($sqlProd);
    $stmt->bind_param("i", $ProdId);
    
    if ($stmt->execute()) {
        echo "Sản phẩm đã được xóa thành công.";
        header("Location: ../myProduct/myProduct.php");
    } else {
        echo "Lỗi khi xóa sản phẩm: " . $stmt->error;
    }
} else {
    echo "Sản phẩm không tồn tại hoặc ID sản phẩm không hợp lệ.";
}

$connection->close();
?>
