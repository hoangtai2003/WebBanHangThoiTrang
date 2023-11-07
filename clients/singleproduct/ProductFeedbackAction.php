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
if (isset($data_check) && $data_check["CusId"] == $IdCustomer) {
    if (!is_null($orderStatus) && $orderStatus['OrderStatus'] == 3) {
        $rating = $_REQUEST["rating"];
        $description = $_REQUEST["description"];
        if (!empty($rating)) {
            $sql_rating = mysqli_query($connection, "insert into comment(CusId, ProdId, CmtDescription, rate) values($IdCustomer,$ProdId, '$description', $rating)");
            // header("Location: ./singleproduct.php?ProdId=$ProdId");
            echo '<div class="user_review_container d-flex flex-column flex-sm-row">
            <div class="user">
              <div class="user_pic"></div>
                 <div class="user_rating">
                <ul class="star_rating">';

                 for ($i = 1; $i <= 5; $i++) {
                     echo '<li>';
                     if ($i <= $rating) {
                     echo '<i class="fa fa-star" aria-hidden="true"></i>';
                     } else {
                    echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                    }
                    echo '</li>';
                     }

            echo '</ul>
                 </div>
            </div>
            <div class="review">
              <div class="review_date">' . date("Y-m-d H:i:s") . '</div>
              <div class="user_name">' . $CusName . '</div>
              <p>' . $description . '</p>
            </div>
          </div>';
        } else {
            $_SESSION['message'] = "Vui lòng nhập đầy đủ thông tin đánh giá";
            // header("Location: ./singleproduct.php?ProdId=$ProdId");
        }
    } else {
        $_SESSION['message'] = "Bạn chỉ có thể đánh giá sản phẩm sau khi đã nhận được hàng.";
        // header("Location: ./singleproduct.php?ProdId=$ProdId");
        echo "";
    }
} else {
    $_SESSION['message'] = "Bạn không thể đánh giá hay nhận xét khi chưa mua sản phẩm này!";
    // header("Location: ./singleproduct.php?ProdId=$ProdId");
    echo "";

    exit();
}