<?php
session_start();
$IdCustomer = $_SESSION["cusid"];
$CusName = $_SESSION["name"];
require_once('../../config/config.php');
$ProdId = $_REQUEST["ProdId"];

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['cus_loggedin'])) {
    $response = array("success" => false, "message" => "Vui lòng đăng nhập để đánh giá.");
    echo json_encode($response);
    exit();
}

// Kiểm tra người dùng đã mua sản phẩm chưa
$sql_check_buy = "SELECT o.CusId, od.ProdId, o.OrderStatus
    FROM orders o
    INNER JOIN orderdetail od ON o.OrderId = od.OrderId where od.ProdId = '$ProdId' and o.CusId = '$IdCustomer'";
$result_check = mysqli_query($connection, $sql_check_buy);
$data_check = mysqli_fetch_assoc($result_check);

if (!isset($data_check) || $data_check["CusId"] != $IdCustomer) {
    $response = array("success" => false, "message" => "Bạn chỉ có thể đánh giá sản phẩm sau khi đã mua nó.");
    echo json_encode($response);
    exit();
}

// // Kiểm tra xem người dùng đã đánh giá chưa
// $sql_check_rate = "SELECT COUNT(*) as count FROM comment WHERE ProdId = $ProdId AND CusId = $IdCustomer";
// $result_check_rate = mysqli_query($connection, $sql_check_rate);
// $data_check_rate = mysqli_fetch_assoc($result_check_rate);

// if ($data_check_rate["count"] > 0) {
//     $response = array("success" => false, "message" => "Bạn đã đánh giá sản phẩm này rồi.");
//     echo json_encode($response);
//     exit();
// }

// Kiểm tra xem người dùng đã nhận được hàng chưa
if (!is_null($data_check["OrderStatus"]) && $data_check["OrderStatus"] != 3) {
    $response = array("success" => false, "message" => "Bạn chỉ có thể đánh giá sản phẩm sau khi đã nhận được hàng.");
    echo json_encode($response);
    exit();
}

// Lấy dữ liệu từ AJAX request
$rating = isset($_POST["rating"]) ? $_POST["rating"] : null;
$description = isset($_POST["description"]) ? $_POST["description"] : null;

// Kiểm tra xem cả rating và description đều có giá trị
if (!empty($rating)) {
    // Thêm đánh giá vào cơ sở dữ liệu
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
