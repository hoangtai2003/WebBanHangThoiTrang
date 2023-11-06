<?php
session_start();
include_once("../../config/config.php");
if(isset($_GET['clickplus']) && $_GET['clickplus'] == 'plus'){
    $productId = $_GET['productId'];
    if(isset($_SESSION["cusid"]) && isset($_SESSION['cus_loggedin'])){
        $cusid = $_SESSION['cusid'];
        $sql_check_cart = "SELECT * FROM cart WHERE CusId = '" . $cusid . "'";
        $result_check_cart = $connection->query($sql_check_cart);
        if($result_check_cart->num_rows > 0){
            $row_check_cart = $result_check_cart->fetch_assoc();
    
            //lấy max số sản phẩm sẵn có
            $sqlgetCartDetail = "SELECT * FROM cartdetail WHERE CartId = '".$row_check_cart['CartId']."' AND ProdId = '".$productId."'";
            $resultgetCartDetail = mysqli_query($connection, $sqlgetCartDetail);
            if($resultgetCartDetail->num_rows > 0){
                $rowgetCartDetail = mysqli_fetch_assoc($resultgetCartDetail);
            
                $sqlProd = "SELECT * FROM product  LEFT JOIN (
                    SELECT ProdId, SUM(OrdQuantity) AS TotalOrders
                    FROM orderdetail
                    GROUP BY ProdId
                ) AS SoldProducts ON product.ProdId = SoldProducts.ProdId and product.ProdId = $productId";
                $product = mysqli_query($connection, $sqlProd);
                $dataProduct = mysqli_fetch_assoc($product);
            
                $maxQuantity = ($dataProduct['ProdQuantity'] - $dataProduct["TotalOrders"]) - $rowgetCartDetail['Quantity'];
                $response = array(
                    'success' => true,
                    'maxQuantity' => $maxQuantity
                );
                echo json_encode($response);
                exit();
            }else{
                $sqlProd = "SELECT * FROM product  LEFT JOIN (
                    SELECT ProdId, SUM(OrdQuantity) AS TotalOrders
                    FROM orderdetail
                    GROUP BY ProdId
                ) AS SoldProducts ON product.ProdId = SoldProducts.ProdId and product.ProdId = $productId";
                $product = mysqli_query($connection, $sqlProd);
                $dataProduct = mysqli_fetch_assoc($product);
                $response = array(
                    'success' => true,
                    'maxQuantity' => $dataProduct['ProdQuantity'] - $dataProduct['TotalOrders']
                );
                echo json_encode($response);
                exit();
            }
        }
        else if ($result_check_cart->num_rows == 0){
            $sqlProd = "SELECT * FROM product  LEFT JOIN (
                SELECT ProdId, SUM(OrdQuantity) AS TotalOrders
                FROM orderdetail
                GROUP BY ProdId
            ) AS SoldProducts ON product.ProdId = SoldProducts.ProdId and product.ProdId = $productId";
            $product = mysqli_query($connection, $sqlProd);
            $dataProduct = mysqli_fetch_assoc($product);
            $response = array(
                'success' => true,
                'maxQuantity' => $dataProduct['ProdQuantity'] - $dataProduct['TotalOrders']
            );
            echo json_encode($response);
            exit();
        }
    }
    else{
        $sqlProd = "SELECT * FROM product  LEFT JOIN (
            SELECT ProdId, SUM(OrdQuantity) AS TotalOrders
            FROM orderdetail
            GROUP BY ProdId
        ) AS SoldProducts ON product.ProdId = SoldProducts.ProdId and product.ProdId = $productId";
        $product = mysqli_query($connection, $sqlProd);
        $dataProduct = mysqli_fetch_assoc($product);
        $response = array(
            'success' => true,
            'maxQuantity' => $dataProduct['ProdQuantity'] - $dataProduct['TotalOrders']
        );
        echo json_encode($response);
        exit();
    }
}
?>