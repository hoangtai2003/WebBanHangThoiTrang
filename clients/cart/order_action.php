<?php
    session_start();
    require("../../config/config.php");
    require("../../mail/sendmail.php");
    
    $order_code = rand(0, 9999);
    $cusid = $_SESSION['cusid'];
    $order_payment  = $_POST['payment'];

    //lấy thông tin vận chuyển
    $sql_get_trans = "SELECT * FROM ship WHERE CusId = '" . $cusid . "' ORDER BY ShipId DESC LIMIT 1";
    $result_get_trans = $connection->query($sql_get_trans);
    $row_get_trans = $result_get_trans->fetch_assoc();
    $shipid = $row_get_trans["ShipId"];

    $totalPrice = 0;
    foreach ($_SESSION['selected_items'] as $key => $value) {
        $quantity = $value['quantity'];
        $price = $value['price'];
        $multotal = $quantity * $price;
        $totalPrice += $multotal;
    }

    if ($order_payment == 'tienmat') {
        //thêm đơn hàng
        $sql_insert_order = "INSERT INTO orders (OrderCode, CusId, OrderPayment,ShipId) VALUES ('" . $order_code . "', '" . $cusid . "', '" . $order_payment . "', '" . $shipid . "')";
        $result_sql_insert_order = $connection->query($sql_insert_order);
        if ($result_sql_insert_order) {
            $last_insert_orderid = $connection->insert_id;

            $totalPrice = 0;
            $totalQuantity = 0;
            foreach ($_SESSION['selected_items'] as $key => $value) {
                $productId = $value['id'];
                $quantity = $value['quantity'];
                $price = $value['price'];
                $multotal = $quantity * $price;
                $totalPrice += $multotal;
                $totalQuantity += $quantity;

                //thêm chi tiết đơn hàng
                $sql_insert_orderdetail = "INSERT INTO orderdetail (OrderId, ProdId, OrdQuantity, OrdPrice) VALUES ('" . $last_insert_orderid . "', '" . $productId . "', '" . $quantity . "', '" . $price . "')";
                $connection->query($sql_insert_orderdetail);
            }

            $sql_update_order = "UPDATE orders SET OrderTotalPrice = '" . $totalPrice . "', OrderQuantity = '" . $totalQuantity . "' WHERE OrderId = '" . $last_insert_orderid . "'";
            $connection->query($sql_update_order);

            //gửi mail
            $title = "Đặt hàng website Bán hàng thời trang thành công!";
            $content = "<h3>Cảm ơn bạn đã đặt hàng của chúng tôi! Mã đơn hàng: $order_code</h3>";
            $content .= '<h4>Thông tin đơn hàng</h4>
                        <table border=1>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>';
            foreach ($_SESSION["selected_items"] as $key => $value) {
                $content .= "<tr>
                                <td>" . $value['name'] . "</td>
                                <td>" . number_format($value['price'], 0, ',', '.') . "</td>
                                <td>" . $value['quantity'] . "</td>
                                <td>" . number_format($value['price'] * $value['quantity'], 0, ',', '.') . "</td>
                            </tr>";
            }
            $content .= "<tr>
                            <th colspan=3>Tổng tiền:</th>
                            <th>" . number_format($totalPrice, 0, ',', '.') . "</th>
                        </tr>
                        </table>";
            $cusemail = $_SESSION["email"];
            $mail = new Mailer();
            $mail->orders_success($title, $content, $cusemail);

        }

        //xóa trong giỏ hàng các sản phẩm đã mua
        $sql_get_cart = "SELECT * FROM cart WHERE CusId = '" . $cusid . "'";
        $result_get_cart = $connection->query($sql_get_cart);
        $row_get_cart = $result_get_cart->fetch_assoc();

        foreach($_SESSION['selected_items'] as $key => $value){
            $sql_delete_cart_detail = "DELETE FROM cartdetail WHERE CartId = '" . $row_get_cart['CartId'] . "' AND ProdId = '".$value['id']."'";
            $connection->query($sql_delete_cart_detail);
        }
        unset($_SESSION['selected_items']);

        $sql_check_cart_detail_final = "SELECT * FROM cartdetail where CartId = '".$row_get_cart['CartId']."'";
        $result_check_cart_detail_final = $connection->query($sql_check_cart_detail_final);
        if($result_check_cart_detail_final->num_rows == 0){
            //xóa giỏ hàng
            $sql_delete_cart = "DELETE FROM cart WHERE CusId = '" . $cusid . "'";
            $connection->query($sql_delete_cart);

            unset($_SESSION['cart_inserted']);
        }
        
        $_SESSION['message'] = 'Bạn đã đặt hàng thành công! Click vào <a href="./percharse_order.php">Đơn mua</a> để xem thông tin!<br>Kiểm tra Email để xem thông tin chi tiết!';
        
        header('Location: ./cart_view.php');
    }
?>