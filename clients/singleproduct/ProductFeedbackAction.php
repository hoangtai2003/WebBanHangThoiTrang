<?php
session_start();
$IdCustomer = $_SESSION["cusid"];
$CusName = $_SESSION["name"];
require_once('../../config/config.php');
$ProdId = $_REQUEST["ProdId"];

$sql_check_buy = "SELECT o.CusId, od.ProdId
    FROM orders o
    INNER JOIN orderdetail od ON o.OrderId = od.OrderId where od.ProdId = '$ProdId' and o.CusId = '$IdCustomer'";
$result_check = mysqli_query($connection, $sql_check_buy);
$data_check = mysqli_fetch_assoc($result_check);


// Kiểm tra khách hàng đã xác nhận được hàng để đánh giá sản phẩm
$sqlOrderStatus = "SELECT o.OrderStatus
FROM orders o
INNER JOIN orderdetail od ON o.OrderId = od.OrderId
WHERE od.ProdId = $ProdId AND o.CusId = $IdCustomer";

$resultOrderStatus = mysqli_query($connection, $sqlOrderStatus);
$orderStatus = mysqli_fetch_assoc($resultOrderStatus);


// kiểm tra xem khách hàng đã đánh giá chưa
$sql_check_rate = "SELECT COUNT(*) as count FROM comment WHERE ProdId = $ProdId AND CusId = $IdCustomer";
$result_check_rate = mysqli_query($connection, $sql_check_rate);
$data_check_rate = mysqli_fetch_assoc($result_check_rate);


if (isset($data_check) && $data_check["CusId"] == $IdCustomer) {
    if (!is_null($orderStatus) && $orderStatus['OrderStatus'] == 3) {
        $rating = isset($_REQUEST["rating"]) ? $_REQUEST["rating"] : null;
        $description = isset($_REQUEST["description"]) ? $_REQUEST["description"] : null;
        if ($data_check_rate["count"] < 1) {
            if (!empty($rating) && !empty($description)) {
                $sql_rating = mysqli_query($connection, "INSERT INTO comment (CusId, ProdId, CmtDescription, rate) VALUES ($IdCustomer, $ProdId, '$description', $rating)");
                if ($sql_rating) {
                    header("Location: ./singleproduct.php?ProdId=$ProdId");
                } else {
                    $_SESSION['message'] = "Có lỗi xảy ra khi đánh giá sản phẩm. Vui lòng thử lại sau.";
                    header("Location: ./singleproduct.php?ProdId=$ProdId");
                }
            } else {
                $_SESSION['message'] = "Vui lòng nhập đầy đủ thông tin đánh giá";
                header("Location: ./singleproduct.php?ProdId=$ProdId");
            }
        } else {
            $_SESSION['message'] = "Bạn đã đánh giá sản phẩm này rồi";
            header("Location: ./singleproduct.php?ProdId=$ProdId");
        }
    } else {
        $_SESSION['message'] = "Bạn chỉ có thể đánh giá sản phẩm sau khi đã nhận được hàng.";
        header("Location: ./singleproduct.php?ProdId=$ProdId");
    }
} else {
    $_SESSION['message'] = "Bạn không thể đánh giá hay nhận xét khi chưa mua sản phẩm này!";
    header("Location: ./singleproduct.php?ProdId=$ProdId");
    exit();
}
