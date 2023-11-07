<?php
session_start();
include_once("../../config/config.php");
// if(!isset($_SESSION["cus_loggedin"])){
//     header("Location: ../authen/login.php");
// }
if (isset($_GET['cartItem']) && $_GET['cartItem'] == 'cart_item') {
    if (!isset($_SESSION['cus_loggedin'])) {
        echo '0';
    } else {
        $cusid = $_SESSION['cusid'];
        $sql_cart_number = "SELECT * FROM cart WHERE CusId = '" . $cusid . "'";
        $result_cart_number = $connection->query($sql_cart_number);
        if ($result_cart_number->num_rows > 0) {
            $row_cart_number = $result_cart_number->fetch_assoc();
            $sql_cart_detail = "SELECT * FROM cartdetail WHERE CartId = '" . $row_cart_number['CartId'] . "'";
            $result_cart_detail = $connection->query($sql_cart_detail);
            $row_cart_detail = $result_cart_detail->num_rows;
            echo $row_cart_detail;
        } else {
            echo 0;
        }
    }
}

//thêm giỏ hàng
if (isset($_GET['cartadd']) && $_GET['cartadd'] == 'themgiohang' && isset($_GET['quantity'])) {

    $productId = $_GET['productId'];
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;

    if (isset($_SESSION['cusid'])) {
        $cusid = $_SESSION['cusid'];
        if (!isset($_SESSION['cart_inserted'])) {
            $sql_check_cart_exists = "SELECT * FROM cart WHERE CusId = '" . $cusid . "'";
            $result_check_cart_exists = $connection->query($sql_check_cart_exists);

            if ($result_check_cart_exists->num_rows > 0) {
                $_SESSION['cart_inserted'] = true;
            } else {
                $_SESSION['cart_inserted'] = false;
            }
        }
        if (isset($_SESSION['cart_inserted']) && $_SESSION['cart_inserted'] == false) {
            $sql_insert_cart = "INSERT INTO cart (CusId) VALUES ('" . $cusid . "')";
            $result = $connection->query($sql_insert_cart);
            $_SESSION['cart_inserted'] = true;
        }
        $sql_check_cart = "SELECT * FROM cart WHERE CusId = '" . $cusid . "'";
        $result_check_cart = $connection->query($sql_check_cart);
        if( $result_check_cart->num_rows > 0) {
            $row_check_cart = $result_check_cart->fetch_assoc();

            $sql_check_cart_detail = "SELECT * FROM cartdetail WHERE CartId = '" . $row_check_cart['CartId'] . "' AND ProdId = '" . $productId . "' LIMIT 1";
            $result_check_cart_detail = $connection->query($sql_check_cart_detail);

            if ($result_check_cart_detail->num_rows > 0) {
                $row_check_cart_detail = $result_check_cart_detail->fetch_assoc();

                $sqlProd = "SELECT p.*, IFNULL(SUM(od.OrdQuantity), 0) AS TotalOrders
                FROM product AS p LEFT JOIN orderdetail AS od ON p.ProdId = od.ProdId
                WHERE p.ProdId = '$productId'
                GROUP BY p.ProdId;";
                $product = mysqli_query($connection, $sqlProd);
                $dataProduct = mysqli_fetch_assoc($product);

                $maxQuantity = ($dataProduct['ProdQuantity'] - $dataProduct["TotalOrders"]) - $row_check_cart_detail['Quantity'];
                if($maxQuantity == 0){
                    $response = array(
                        'success' => false,
                        'message' => 'Không thể thêm vào giỏ hàng do quá số lượng sản phẩm sẵn có!'
                    );
                    echo json_encode($response);
                    exit();
                }
                else{
                    $new_quantity = $row_check_cart_detail["Quantity"] + $quantity;
                    $sql_update_cart = "UPDATE cartdetail SET Quantity = '" . $new_quantity . "' WHERE CartId = '" . $row_check_cart['CartId'] . "' AND ProdId = '" . $productId . "'";
                    $connection->query($sql_update_cart);
                    $response = array(
                        'success' => true,
                        'message' => 'Thêm vào giỏ hàng thành công.',
                        'maxQuantity' => $maxQuantity
                    );
                    echo json_encode($response);
                    exit();
                }

                
            } else if ($result_check_cart_detail->num_rows == 0) {
                $sql_insert_cart_detail = "INSERT INTO cartdetail (CartId, ProdId, Quantity) VALUES ('" . $row_check_cart['CartId'] . "', '" . $productId . "', '".$quantity."')";
                $connection->query($sql_insert_cart_detail);
                $response = array(
                    'success' => true,
                    'message' => 'Thêm vào giỏ hàng thành công.'
                );
                echo json_encode($response);
                exit();
            }
        }

        //lấy max số sản phẩm sẵn có
        // $sqlgetCartDetail = "SELECT * FROM cartdetail WHERE CartId = '".$row_check_cart['CartId']."' AND ProdId = '".$productId."'";
        // $resultgetCartDetail = mysqli_query($connection, $sqlgetCartDetail);
        // $rowgetCartDetail = mysqli_fetch_assoc($resultgetCartDetail);

        // $sqlProd = "SELECT * FROM product  LEFT JOIN (
        //     SELECT ProdId, SUM(OrdQuantity) AS TotalOrders
        //     FROM orderdetail
        //     GROUP BY ProdId
        // ) AS SoldProducts ON product.ProdId = SoldProducts.ProdId and product.ProdId = $productId";
        // $product = mysqli_query($connection, $sqlProd);
        // $dataProduct = mysqli_fetch_assoc($product);

        // $maxQuantity = ($dataProduct['ProdQuantity'] - $dataProduct["TotalOrders"]) - $rowgetCartDetail['Quantity'];
        // if($maxQuantity == 0){
        //     $response = array(
        //         'success' => false,
        //         'message' => 'Không thể thêm vào giỏ hàng!'
        //     );
        //     echo json_encode($response);
        //     exit();
        // }
        // else{
        //     $response = array(
        //         'success' => true,
        //         'message' => 'Thêm vào giỏ hàng thành công.',
        //         'maxQuantity' => $maxQuantity
        //     );
        //     echo json_encode($response);
        //     exit();
        // }
    }
}

//xóa tất cả trong giỏ hàng
if (isset($_GET['deleteAll']) && $_GET['deleteAll'] == 1) {
    if (isset($_SESSION['cusid'])) {
        $cusid = $_SESSION['cusid'];
        $sql_check_cart = "SELECT * FROM cart where CusId = '" . $cusid . "'";
        $result_check_cart = $connection->query($sql_check_cart);
        $row_check_cart = $result_check_cart->fetch_assoc();
        foreach ($_SESSION['cart'] as $cart_item) {
            $sql_delete_cart_detail = "DELETE FROM cartdetail where CartId = '" . $row_check_cart['CartId'] . "'";
            $connection->query($sql_delete_cart_detail);
        }
        $sql_delete_cart = "DELETE FROM cart where CusId = '" . $cusid . "'";
        $result = $connection->query($sql_delete_cart);
        unset($_SESSION['cart_inserted']);
    }
    unset($_SESSION['cart']);
    header('Location: ./cart_view.php');
}

//xóa từng sản phẩm
if (isset($_SESSION['cart']) && isset($_GET['delete'])) {
    $productId = $_GET['delete'];
    if (isset($_SESSION['cusid'])) {
        $cusid = $_SESSION['cusid'];
        //lấy cartid
        $sql_get_cart = "SELECT * FROM cart WHERE CusId = '" . $cusid . "'";
        $result_get_cart = $connection->query($sql_get_cart);
        $row_get_cart = $result_get_cart->fetch_assoc();
        //xóa
        $sql_delete_product = "DELETE FROM cartdetail WHERE CartId = '" . $row_get_cart['CartId'] . "' AND ProdId = '" . $productId . "'";
        $connection->query($sql_delete_product);


        // Kiểm tra số lượng sản phẩm trong giỏ hàng
        $sql_check_product_count = "SELECT COUNT(*) as product_count FROM cartdetail WHERE CartId = '" . $row_get_cart['CartId'] . "'";
        $result_check_product_count = $connection->query($sql_check_product_count);
        $row_check_product_count = $result_check_product_count->fetch_assoc();
        $product_count = $row_check_product_count['product_count'];
        if ($product_count < 1) {
            // Nếu số sản phẩm = 0, xóa cả giỏ hàng
            $sql_delete_cart = "DELETE FROM cart WHERE CartId = '" . $row_get_cart['CartId'] . "'";
            $connection->query($sql_delete_cart);
            unset($_SESSION['cart_inserted']);
        }
        // else {
        //     foreach ($_SESSION['cart'] as $cart_item) {
        //         if ($cart_item['id'] != $productId) {
        //             $product[] = array('id' => $cart_item['id'], 'name' => $cart_item['name'], 'desc' => $cart_item['desc'], 'image' => $cart_item['image'], 'price' => $cart_item['price'], 'pricesale' => $cart_item['pricesale'], 'quantity' => $cart_item['quantity'], 'cateid' => $cart_item['cateid']);
        //         }
        //         $_SESSION['cart'] = $product;
        //     }
        // }
    }

    header('Location: ./cart_view.php');
}

//tăng số lượng
if (isset($_GET['add'])) {
    $productId = $_GET['add'];
    if (isset($_SESSION['cusid'])) {
        $cusid = $_SESSION['cusid'];
        //lấy cartid
        $sql_get_cart = "SELECT * FROM cart WHERE CusId = '" . $cusid . "'";
        $result_get_cart = $connection->query($sql_get_cart);
        $row_get_cart = $result_get_cart->fetch_assoc();

        $sql_check_cart_detail = "SELECT * FROM cartdetail WHERE CartId = '" . $row_get_cart['CartId'] . "' AND ProdId = '" . $productId . "' LIMIT 1";
        $result_check_cart_detail = $connection->query($sql_check_cart_detail);

        if ($result_check_cart_detail->num_rows > 0) {
            $row_check_cart_detail = $result_check_cart_detail->fetch_assoc();

            $sqlProd = "SELECT p.*, IFNULL(SUM(od.OrdQuantity), 0) AS TotalOrders
            FROM product AS p LEFT JOIN orderdetail AS od ON p.ProdId = od.ProdId
            WHERE p.ProdId = '$productId'
            GROUP BY p.ProdId;";
            $product = mysqli_query($connection, $sqlProd);
            $dataProduct = mysqli_fetch_assoc($product);

            $maxQuantity = ($dataProduct['ProdQuantity'] - $dataProduct["TotalOrders"]) - $row_check_cart_detail['Quantity'];
            if($maxQuantity == 0){
                $_SESSION['message'] = 'Không thể thêm vào giỏ hàng do quá số lượng sản phẩm sẵn có!';
                header('Location: ./cart_view.php');
                exit();
            }
            else{
                $new_quantity = $row_check_cart_detail["Quantity"] + 1;
                $sql_update_cart = "UPDATE cartdetail SET Quantity = '" . $new_quantity . "' WHERE CartId = '" . $row_get_cart['CartId'] . "' AND ProdId = '" . $productId . "'";
                $connection->query($sql_update_cart);
                header('Location: ./cart_view.php');
                exit();
            }    
        }

        //tăng
        // $sql_add_quantity = "UPDATE cartdetail SET Quantity = Quantity + 1 WHERE CartId = '" . $row_get_cart['CartId'] . "' AND ProdId = '" . $productId . "'";
        // $connection->query($sql_add_quantity);
    }
    // foreach ($_SESSION['cart'] as $cart_item) {
    //     if ($cart_item['id'] != $productId) {
    //         $product[] = array('id' => $cart_item['id'], 'name' => $cart_item['name'], 'desc' => $cart_item['desc'], 'image' => $cart_item['image'], 'price' => $cart_item['price'], 'pricesale' => $cart_item['pricesale'], 'quantity' => $cart_item['quantity'], 'cateid' => $cart_item['cateid']);
    //         $_SESSION['cart'] = $product;
    //     } else {
    //         $addQuantity = $cart_item['quantity'] + 1;
    //         $product[] = array('id' => $cart_item['id'], 'name' => $cart_item['name'], 'desc' => $cart_item['desc'], 'image' => $cart_item['image'], 'price' => $cart_item['price'], 'pricesale' => $cart_item['pricesale'], 'quantity' => $addQuantity, 'cateid' => $cart_item['cateid']);
    //         $_SESSION['cart'] = $product;
    //     }
    // }
}

//trừ số lượng
if (isset($_GET['sub'])) {
    $productId = $_GET['sub'];
    if (isset($_SESSION['cusid'])) {
        $cusid = $_SESSION['cusid'];
        //lấy cartid
        $sql_get_cart = "SELECT * FROM cart WHERE CusId = '" . $cusid . "'";
        $result_get_cart = $connection->query($sql_get_cart);
        $row_get_cart = $result_get_cart->fetch_assoc();
        //trừ
        $sql_add_quantity = "UPDATE cartdetail SET Quantity = Quantity - 1 WHERE CartId = '" . $row_get_cart['CartId'] . "' AND ProdId = '" . $productId . "' AND Quantity > 1";
        $connection->query($sql_add_quantity);
    }
    // foreach ($_SESSION['cart'] as $cart_item) {
    //     if ($cart_item['id'] != $productId) {
    //         $product[] = array('id' => $cart_item['id'], 'name' => $cart_item['name'], 'desc' => $cart_item['desc'], 'image' => $cart_item['image'], 'price' => $cart_item['price'], 'pricesale' => $cart_item['pricesale'], 'quantity' => $cart_item['quantity'], 'cateid' => $cart_item['cateid']);
    //         $_SESSION['cart'] = $product;
    //     } else {
    //         $subQuantity = $cart_item['quantity'] - 1;
    //         if ($cart_item['quantity'] > 1) {
    //             $product[] = array('id' => $cart_item['id'], 'name' => $cart_item['name'], 'desc' => $cart_item['desc'], 'image' => $cart_item['image'], 'price' => $cart_item['price'], 'pricesale' => $cart_item['pricesale'], 'quantity' => $subQuantity, 'cateid' => $cart_item['cateid']);
    //         } else {
    //             $product[] = array('id' => $cart_item['id'], 'name' => $cart_item['name'], 'desc' => $cart_item['desc'], 'image' => $cart_item['image'], 'price' => $cart_item['price'], 'pricesale' => $cart_item['pricesale'], 'quantity' => $cart_item['quantity'], 'cateid' => $cart_item['cateid']);
    //         }
    //         $_SESSION['cart'] = $product;
    //     }
    // }
    header('Location: ./cart_view.php');
}
