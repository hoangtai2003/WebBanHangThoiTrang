<?php
    session_start();
    include_once("../../config/config.php");
    //thêm giỏ hàng
    if(isset($_POST['themgiohang'])){
        // unset($_SESSION['cart']);
        $productId = $_GET['productId'];
        $soluong = 1;
        $sql = "SELECT * FROM Product WHERE ProdId = '".$productId."' LIMIT 1";
        $result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_array($result);
        if($row){
            $new_product = array(array('id'=>$productId, 'name'=>$row['ProdName'], 'desc'=>$row['ProdDescription'], 'image'=>$row['ProdImage'], 'price'=>$row['ProdPrice'], 'pricesale'=>$row['ProdPriceSale'], 'quantity'=>$soluong, 'cateid'=>$row['CateId']));
            //kiểm tra session giỏ hàng tồn tại
            if(isset($_SESSION['cart'])){
                $found = false;
                foreach($_SESSION['cart'] as $cart_item){
                    //nếu trùng
                    if($cart_item['id'] == $productId){
                        $product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'desc'=>$cart_item['desc'], 'image'=>$cart_item['image'], 'price'=>$cart_item['price'], 'pricesale'=>$cart_item['pricesale'], 'quantity'=>$cart_item['quantity']+1, 'cateid'=>$cart_item['cateid']);
                        $found = true;
                    }
                    else{
                        //nếu không trùng
                        $product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'desc'=>$cart_item['desc'], 'image'=>$cart_item['image'], 'price'=>$cart_item['price'], 'pricesale'=>$cart_item['pricesale'], 'quantity'=>$cart_item['quantity'], 'cateid'=>$cart_item['cateid']);
                    }
                }
                if($found == false){
                    $_SESSION['cart'] = array_merge($product, $new_product);
                }
                else{
                    $_SESSION['cart'] = $product;
                }
            }
            else{
                $_SESSION['cart'] = $new_product;
            }
        }
        header('Location: ./cart_view.php');
    }
    
    //xóa tất cả trong giỏ hàng
    if(isset($_GET['deleteAll']) && $_GET['deleteAll']==1){
        unset($_SESSION['cart']);
        header('Location: ./cart_view.php');
    }

    //xóa từng sản phẩm
    if(isset($_SESSION['cart']) && isset($_GET['delete'])){
        $productId = $_GET['delete'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id'] != $productId){
                $product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'desc'=>$cart_item['desc'], 'image'=>$cart_item['image'], 'price'=>$cart_item['price'], 'pricesale'=>$cart_item['pricesale'], 'quantity'=>$cart_item['quantity'], 'cateid'=>$cart_item['cateid']);
            }
            $_SESSION['cart'] = $product;
        }
        header('Location: ./cart_view.php');
    }

    //tăng số lượng
    if(isset($_GET['add'])){
        $productId = $_GET['add'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id'] != $productId){
                $product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'desc'=>$cart_item['desc'], 'image'=>$cart_item['image'], 'price'=>$cart_item['price'], 'pricesale'=>$cart_item['pricesale'], 'quantity'=>$cart_item['quantity'], 'cateid'=>$cart_item['cateid']);
                $_SESSION['cart'] = $product;
            }
            else{
                $addQuantity = $cart_item['quantity'] + 1;
                $product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'desc'=>$cart_item['desc'], 'image'=>$cart_item['image'], 'price'=>$cart_item['price'], 'pricesale'=>$cart_item['pricesale'], 'quantity'=>$addQuantity, 'cateid'=>$cart_item['cateid']);
                $_SESSION['cart'] = $product;
            }
        }
        header('Location: ./cart_view.php');
    }

    //trừ số lượng
    if(isset($_GET['sub'])){
        $productId = $_GET['sub'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id'] != $productId){
                $product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'desc'=>$cart_item['desc'], 'image'=>$cart_item['image'], 'price'=>$cart_item['price'], 'pricesale'=>$cart_item['pricesale'], 'quantity'=>$cart_item['quantity'], 'cateid'=>$cart_item['cateid']);
                $_SESSION['cart'] = $product;
            }
            else{
                $subQuantity = $cart_item['quantity'] - 1;
                if($cart_item['quantity'] > 1){
                    $product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'desc'=>$cart_item['desc'], 'image'=>$cart_item['image'], 'price'=>$cart_item['price'], 'pricesale'=>$cart_item['pricesale'], 'quantity'=>$subQuantity, 'cateid'=>$cart_item['cateid']);
                }
                else{
                    $product[] = array('id'=>$cart_item['id'], 'name'=>$cart_item['name'], 'desc'=>$cart_item['desc'], 'image'=>$cart_item['image'], 'price'=>$cart_item['price'], 'pricesale'=>$cart_item['pricesale'], 'quantity'=>$cart_item['quantity'], 'cateid'=>$cart_item['cateid']);
                }
                $_SESSION['cart'] = $product;
            }
        }
        header('Location: ./cart_view.php');
    }
?>