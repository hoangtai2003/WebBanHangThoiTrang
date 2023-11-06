<?php
    session_start();
    $IdCustomer = $_SESSION["cusid"];
    require_once('../../config/config.php');
    $ProdId = $_REQUEST["ProdId"];
    echo $ProdId;
    echo $IdCustomer;
    $sql_check_buy = "SELECT o.CusId, od.ProdId
    FROM orders o
    INNER JOIN orderdetail od ON o.OrderId = od.OrderId where od.ProdId = '$ProdId' and o.CusId = '$IdCustomer'";
    $result_check = mysqli_query($connection, $sql_check_buy);
    $data_check = mysqli_fetch_assoc($result_check);
    var_dump($data_check);
    if($data_check["CusId"] == $IdCustomer) {
        $rating = $_REQUEST["rating"];
        $desciption = $_REQUEST["description"];
        if(!empty($rating)) {
            $sql_rating = mysqli_query($connection, "insert into comment(CusId, ProdId, CmtDescription, rate) values($IdCustomer,$ProdId, '$desciption', $rating)");
            header("Location: ./singleproduct.php?ProdId=$ProdId");
        }else {

            header("Location: ./singleproduct.php?ProdId=$ProdId");
        }
    }
    else {
        // $_SESSION['messenger'] = "Bạn không thể đánh giá hay nhận xét khi chưa mua sản phẩm này! ";
        header("Location: ./singleproduct?ProdId=$ProdId");
        exit();
    }
    
?>