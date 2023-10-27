<?php
	session_start();
	require("../../config/config.php");
	require("../../mail/sendmail.php");
	if(!isset($_SESSION["cus_loggedin"])){
		header("Location: ../authen/login.php");
	}

	if (isset($_SESSION['redirect']) && $_SESSION['redirect'] == true) {
		// Thực hiện các câu lệnh trong vòng if (isset($_POST['redirect']))
		// ...
		$shipid = $_SESSION['ShipId'];
		$cusid = $_SESSION['cusid'];
		$order_code = $_SESSION['OrderCode'];
		$order_payment = $_SESSION['OrderPayment'];
		$sql_insert_order = "INSERT INTO orders (OrderCode, CusId, OrderPayment, OrderStatus, ShipId) VALUES ('" . $order_code . "', '" . $cusid . "', '" . $order_payment . "', '1', '" . $shipid . "')";
                $result_sql_insert_order = $connection->query($sql_insert_order);
                if ($result_sql_insert_order) {
                    $last_insert_orderid = $connection->insert_id;
                
                    $totalPrice = 0;
                    $totalQuantity = 0;
                    foreach ($_SESSION['cart'] as $key => $value) {
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
                    foreach ($_SESSION["cart"] as $key => $value) {
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
                // xóa giỏ hàng
                $sql_get_cart = "SELECT * FROM cart WHERE CusId = '" . $cusid . "'";
                $result_get_cart = $connection->query($sql_get_cart);
                $row_get_cart = $result_get_cart->fetch_assoc();
                
                $sql_delete_cart_detail = "DELETE FROM cartdetail WHERE CartId = '" . $row_get_cart['CartId'] . "'";
                $connection->query($sql_delete_cart_detail);
                $sql_delete_cart = "DELETE FROM cart WHERE CusId = '" . $cusid . "'";
                $connection->query($sql_delete_cart);
                
                unset($_SESSION['cart_inserted']);
                unset($_SESSION['cart']);
		// Xóa trạng thái chuyển hướng từ session
		unset($_SESSION['redirect']);
	}
	
	if(isset($_GET['vnp_Amount'])){
		$vnp_Amount = $_GET['vnp_Amount'];
		$vnp_BankCode = $_GET['vnp_BankCode'];
		$vnp_BankTranNo = $_GET['vnp_BankTranNo'];
		$vnp_OrderInfo = $_GET['vnp_OrderInfo'];
		$vnp_PayDate = $_GET['vnp_PayDate'];
		$vnp_TmnCode = $_GET['vnp_TmnCode'];
		$vnp_TransactionNo = $_GET['vnp_TransactionNo'];
		$vnp_CardType = $_GET['vnp_CardType'];
		$order_code = $_SESSION['OrderCode'];

		if(!isset($_SESSION['vnp_inserted'])){
			$sql_insert_vnpay = "INSERT INTO vnpay (VnpAmount, VnpBankCode, VnpBankTranNo, VnpCardType, VnpOrderInfo, VnpDate, VnpTmnCode, VnpTransactionNo, OrderCode) VALUES ('".$vnp_Amount."', '".$vnp_BankCode."', '".$vnp_BankTranNo."', '".$vnp_CardType."', '".$vnp_OrderInfo."', '".$vnp_PayDate."', '".$vnp_TmnCode."', '".$vnp_TransactionNo."', '".$order_code."')";
			$vnpay_query = $connection->query($sql_insert_vnpay);
			$_SESSION['vnp_inserted'] = true;
		}
		
		
		header("Location: cart_view.php");
	}
	if(!isset($_GET['vnp_Amount']) && $_SESSION['vnp_inserted'] == true){
		$_SESSION['message'] = 'Bạn đã đặt hàng thành công! Click vào <a href="./percharse_order.php">Đơn mua</a> để xem thông tin!<br>Kiểm tra Email để xem thông tin chi tiết!';
		unset($_SESSION["vnp_inserted"]);
	}
	unset($_SESSION["cart"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Colo Shop Categories</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../assets/styles/bootstrap4/bootstrap.min.css">
<link href="../assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="../assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="../assets/styles/categories_styles.css">
<link rel="stylesheet" type="text/css" href="../assets/styles/categories_responsive.css">
</head>

<body>

<div class="super_container">

	<!-- Header -->
    <?php include_once("../includes/header.php") ?>

	<div class="fs_menu_overlay"></div>

	<!-- Hamburger Menu -->
    <?php include_once("../includes/hamburger_menu.php") ?>

	<div class="container product_section_container">
		<div class="row">
			<div class="col product_section clearfix">

				<!-- Breadcrumbs -->

				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li class="active"><a href="index.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Giỏ hàng</a></li>
					</ul>
				</div>
				<?php include("../authen/message.php") ?>

				<!-- Main Content -->

				<div class="row">
					<div class="col-md-12">
						<table class="table">
							<thead>
                    	        <tr class="text-center">
									<th>STT</th>
                    	            <th>Mã</th>
                    	            <th>Tên sản phẩm</th>
                    	            <th>Hình ảnh</th>
									<th>Giá</th>
                    	            <th>Số lượng</th>
                    	            <th>Thành tiền</th>
                    	            <th>Xóa</th>
                    	        </tr>
                    	    </thead>
							<?php
								if(isset($_SESSION['cusid'])){
									$cusid = $_SESSION['cusid'];
									//lấy thông tin bảng cart
									$sql_get_cart = "SELECT * FROM cart WHERE CusId = '".$cusid."'";
									$result_get_cart = $connection->query($sql_get_cart);
									if ($result_get_cart->num_rows > 0) {
										$row_get_cart = $result_get_cart->fetch_assoc();
										$cartid = $row_get_cart['CartId'];
								
										//lấy thông tin chi tiết giỏ hàng từ bảng cartdetail dựa trên cartid
										$sql_get_cart_detail = "SELECT * FROM cartdetail WHERE CartId = '".$cartid."'";
										$result_get_cart_detail = $connection->query($sql_get_cart_detail);

										while ($row_get_cart_detail = $result_get_cart_detail->fetch_assoc()) {
											//lấy thông tin sản phẩm từ bảng product dựa trên prodid
											$prodid = $row_get_cart_detail['ProdId'];
											$quantity = $row_get_cart_detail['Quantity'];
								
											$sql_get_product = "SELECT * FROM product WHERE ProdId = '".$prodid."'";
											$result_get_product = $connection->query($sql_get_product);
								
											if ($result_get_product->num_rows > 0) {
												$row_get_product = $result_get_product->fetch_assoc();
												
												$_SESSION['cart'][] = array(
													'id' => $row_get_product['ProdId'],
													'name' => $row_get_product['ProdName'],
													'image' => $row_get_product['ProdImage'],
													'price' => $row_get_product['ProdPrice'],
													'quantity' => $quantity
												);
											}
										}
									}
								}
								if(isset($_SESSION["cart"])){
									$i = 0;
									$tongtien = 0;
									foreach($_SESSION["cart"] as $cart_item){
										$thanhtien = $cart_item['quantity'] * $cart_item['price'];
										$tongtien += $thanhtien;
										$i++;
							?>
							<tbody>
								<tr class="text-center">
									<th><?php echo $i ?></th>
									<td><?php echo $cart_item['id'] ?></td>
									<td><?php echo $cart_item['name'] ?></td>
									<td><img src="../../images/<?php echo $cart_item['image'] ?>" width="60"></td>
									<td><?php echo number_format($cart_item['price'], 0, ',', '.') ?></td>
									<td>
										<a href="../cart/cart_action.php?sub=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus" aria-hidden="true"></i></a>
										<?php echo $cart_item['quantity'] ?>
										<a href="../cart/cart_action.php?add=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
									</td>
									<td><?php echo number_format($thanhtien, 0, ',', '.') ?></td>
									<td><a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm <?php echo $cart_item['name'] ?> khỏi giỏ hàng không?')" href="../cart/cart_action.php?delete=<?php echo $cart_item['id'] ?>" class="btn btn-sm btn-danger">Xóa</a></td>
								</tr>
							</tbody>
							<?php
									}
									?>
									<tr>
										<th colspan="6" class="text-right">Tổng tiền:</th>
										<th class="text-center"><?php echo number_format($tongtien, 0, ',', '.') ?></th>
										<th class="text-center"><a onclick="return confirm('Bạn có chắc muốn xóa toàn bộ sản phẩm trong giỏ hàng không?')" href="../cart/cart_action.php?deleteAll=1" class="btn btn-sm btn-danger">Xóa tất cả</a></th>
									</tr>
									<tr>
										<th colspan="7"></th>	
										<!-- <th class="text-center"><a href="./order_action.php" class="btn btn-sm btn-success">Đặt hàng</a></th> -->
										<th class="text-center"><a href="./transportation_view.php" class="btn btn-sm btn-primary">Mua hàng</a></th>
									</tr>
									<?php
								}else{
							?>
								<tr><td colspan="8">Không có sản phẩm nào trong giỏ hàng</td></tr>
							<?php
								}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Benefit -->
    <?php include_once("../includes/benefit.php") ?>

	<!-- Newsletter -->
    <?php include_once("../includes/newsletter.php") ?>

	<!-- Footer -->
    <?php include_once("../includes/footer.php") ?>

</div>

<script src="../assets/js/jquery-3.2.1.min.js"></script>
<script src="../assets/styles/bootstrap4/popper.js"></script>
<script src="../assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="../assets/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="../assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="../assets/plugins/easing/easing.js"></script>
<script src="../assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="../assets/js/categories_custom.js"></script>
</body>

</html>
