<?php
require_once('../../config/config.php');
$CateId = isset($_REQUEST['CateId']) ? intval($_REQUEST['CateId']) : 0;

if ($CateId > 0) {
    $sqlCate = "Update categories set CateStatus = 0 WHERE CateId = ?";
    
    $stmt = $connection->prepare($sqlCate);
    $stmt->bind_param("i", $CateId);
    
    if ($stmt->execute()) {
        echo "Danh mục đã được xóa thành công.";
        header("Location: myCategory.php");
    } else {
        echo "Lỗi khi xóa danh mục: " . $stmt->error;
    }
} else {
    echo "Danh mục không tồn tại hoặc ID danh mục  không hợp lệ.";
}

$connection->close();
?>