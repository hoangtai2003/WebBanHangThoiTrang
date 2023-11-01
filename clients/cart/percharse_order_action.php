<?php
    session_start();
    require("../../config/config.php");
    if(isset($_POST['danhanduochang'])){
        $orderid = $_GET['orderid'];
        $sql_update_order = "UPDATE orders SET OrderStatus = '3' WHERE OrderId = '".$orderid."'";
        $connection->query($sql_update_order);
        header("Location: ./percharse_order.php");
    }
    if(isset($_POST['huydonhang'])){
        $orderid = $_GET['orderid'];
        $sql_delete_orderdetail = "DELETE FROM orderdetail WHERE OrderId = '".$orderid."'";
        $connection->query($sql_delete_orderdetail);
        $sql_delete_order = "DELETE FROM orders WHERE OrderId = '".$orderid."'";
        $connection->query($sql_delete_order);
        header("Location: ./percharse_order.php");
    }
?>