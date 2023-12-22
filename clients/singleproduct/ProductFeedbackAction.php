<?php
session_start();
$IdCustomer = $_SESSION["cusid"];
$CusName = $_SESSION["name"];
require_once('../../config/config.php');
$ProdId = $_REQUEST["ProdId"];

// Lấy dữ liệu từ AJAX request
$rating = isset($_POST["rating"]) ? $_POST["rating"] : null;
$description = isset($_POST["description"]) ? $_POST["description"] : null;

if (!empty($rating)) {
    $sql_rating = mysqli_query($connection, "INSERT INTO comment (CusId, ProdId, CmtDescription, rate) VALUES ($IdCustomer, $ProdId, '$description', $rating)");

    if ($sql_rating) {
        $response = array("success" => true, "message" => "Đánh giá của bạn đã được gửi thành công.");
        echo json_encode($response);
        exit();
    } else {
        $response = array("success" => false, "message" => "Có lỗi xảy ra khi đánh giá sản phẩm. Vui lòng thử lại sau.");
        echo json_encode($response);
        exit();
    }
} else {
    $response = array("warning" => false, "message" => "Vui lòng nhập đầy đủ thông tin đánh giá.");
    echo json_encode($response);
    exit();
}
?>
