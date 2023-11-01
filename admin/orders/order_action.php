<?php
    session_start();
    include('../../config/config.php');
    if($_GET['action']=='xacnhan' && isset($_GET['orderid'])){
        $orderid = $_GET['orderid'];
        $sql = "UPDATE orders SET OrderStatus = '1' WHERE OrderId = '".$orderid."'";
        $connection->query($sql);
        header("Location: ./order_list.php");
    }
    if($_GET['action']=='vanchuyen' && isset($_GET['orderid'])){
        $orderid = $_GET['orderid'];
        $sql = "UPDATE orders SET OrderStatus = '2' WHERE OrderId = '".$orderid."'";
        $connection->query($sql);
        header("Location: ./order_list.php");
    }
    if($_GET['action']=='thanhcong' && isset($_GET['orderid'])){
        $orderid = $_GET['orderid'];
        $sql = "UPDATE orders SET OrderStatus = '3' WHERE OrderId = '".$orderid."'";
        $connection->query($sql);
        header("Location: ./order_list.php");
    }
?>