<?php
    include_once('../../config/config.php');
    $customer = "select count(CusId) as 'TongKhachHang' from customer";
    $customer_result = mysqli_query($connection, $customer);
    $customer_row = mysqli_fetch_assoc($customer_result);
    $totalCustomers = $customer_row['TongKhachHang'];


    $order = "select count(OrderId) as 'TongSoDonHang' from orders where OrderStatus = 3";
    $order_result = mysqli_query($connection, $order);
    $order_row = mysqli_fetch_assoc($order_result);
    $totalOrders = $order_row['TongSoDonHang'];

    $product = "select count(ProdId) as 'TongSoSanPham' from product";
    $product_result = mysqli_query($connection, $product);
    $product_row = mysqli_fetch_assoc($product_result);
    $totalProduct = $product_row['TongSoSanPham'];
    
?>