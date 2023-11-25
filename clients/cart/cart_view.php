<?php
	session_start();
	require("../../config/config.php");
	if(!isset($_SESSION["cus_loggedin"])){
		header("Location: ../authen/login.php");
	}
	unset($_SESSION["cart"]);
	unset($_SESSION["selected_items"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Colo Shop</title>
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
						<li><a href="../index/index.php">Home</a></li>
						<li class="active"><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Giỏ hàng</a></li>
					</ul>
				</div>
				<?php include("../authen/message.php") ?>

				<!-- Main Content -->

				<div class="row">
					<div class="col-md-12">
						<table class="table">
							<thead>
                    	        <tr class="text-center">
									<th><input type="checkbox" id="checkAll"></th>
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
												
												if($row_get_product['ProdIsSale'] == 0){
													$_SESSION['cart'][] = array(
														'id' => $row_get_product['ProdId'],
														'name' => $row_get_product['ProdName'],
														'image' => $row_get_product['ProdImage'],
														'price' => $row_get_product['ProdPrice'],
														'quantity' => $quantity
													);
												}
												else if ($row_get_product['ProdIsSale'] == 1){
													$_SESSION['cart'][] = array(
														'id' => $row_get_product['ProdId'],
														'name' => $row_get_product['ProdName'],
														'image' => $row_get_product['ProdImage'],
														'price' => $row_get_product['ProdPriceSale'],
														'quantity' => $quantity
													);
												}
												
											}
										}
									}
								}
								if(isset($_SESSION["cart"])){
									$i = 0;
									foreach($_SESSION["cart"] as $key => $cart_item){
										$i++;

										$sqlProd = "SELECT p.*, IFNULL(SUM(od.OrdQuantity), 0) AS TotalOrders
										FROM product AS p LEFT JOIN orderdetail AS od ON p.ProdId = od.ProdId
										WHERE p.ProdId = '".$cart_item['id']."'
										GROUP BY p.ProdId;";
										$resultProd = $connection->query($sqlProd);
										$rowProd = $resultProd->fetch_assoc();
							?>
							<tbody>
								<form action="./transportation_view.php" method="post">
								<?php
									if($cart_item['quantity'] > ($rowProd['ProdQuantity'] - $rowProd['TotalOrders']) && ($rowProd['ProdQuantity'] - $rowProd['TotalOrders']) > 0){
										$_SESSION['cart'][$key]['quantity'] = $rowProd['ProdQuantity'] - $rowProd['TotalOrders'];
										$cart_item['quantity'] = $_SESSION['cart'][$key]['quantity'];

										$sql_update_cartdetail = "UPDATE cartdetail set Quantity = '".$cart_item['quantity']."' WHERE CartId = '".$cartid."' AND ProdId = '".$cart_item['id']."'";
										$connection->query($sql_update_cartdetail);

										$thanhtien = $cart_item['quantity'] * $cart_item['price'];
								?>
								<tr class="text-center">
									<th><input type="checkbox" name="ckProdId_<?php echo $cart_item['id'] ?>" value="<?php echo $cart_item['id'] ?>"></th>
									<th><?php echo $i ?></th>
									<td><?php echo $cart_item['id'] ?></td>
									<td><?php echo '<a href="../singleproduct/singleproduct.php?ProdId='.$cart_item['id'].'">'.$cart_item['name'].'</a>' ?></td>
									<td><img src="../../images/<?php echo $cart_item['image'] ?>" width="60"></td>
									<td><?php echo number_format($cart_item['price'], 0, ',', '.') ?></td>
									<td>
										<a href="../cart/cart_action.php?sub=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus" aria-hidden="true"></i></a>
										<?php echo $cart_item['quantity'] ?>
										<a href="../cart/cart_action.php?add=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
										<?php 
											if($rowProd['ProdQuantity'] - $rowProd['TotalOrders'] <= 10){
										?>
											<p style="color: red">Còn <?php echo $rowProd['ProdQuantity'] - $rowProd['TotalOrders'] ?> sản phẩm</p>
										<?php
											}
										?>
									</td>
									<td><?php echo number_format($thanhtien, 0, ',', '.') ?></td>
									<td><a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm <?php echo $cart_item['name'] ?> khỏi giỏ hàng không?')" href="../cart/cart_action.php?delete=<?php echo $cart_item['id'] ?>" class="btn btn-sm btn-danger">Xóa</a></td>
								</tr>
								<?php
									}else if(($rowProd['ProdQuantity'] - $rowProd['TotalOrders']) == 0){
										$_SESSION['cart'][$key]['quantity'] = 0;
										$cart_item['quantity'] = $_SESSION['cart'][$key]['quantity'];
										$thanhtien = $cart_item['quantity'] * $cart_item['price'];
								?>
								<tr class="text-center">
									<th style="pointer-events: none;"><p style="color: red;">Hết hàng</p></th>
									<th style="pointer-events: none; opacity: 0.5;"><?php echo $i ?></th>
									<td style="pointer-events: none; opacity: 0.5;"><?php echo $cart_item['id'] ?></td>
									<td style="pointer-events: none; opacity: 0.5;"><?php echo '<a href="../singleproduct/singleproduct.php?ProdId='.$cart_item['id'].'">'.$cart_item['name'].'</a>' ?></td>
									<td style="pointer-events: none; opacity: 0.5;"><img src="../../images/<?php echo $cart_item['image'] ?>" width="60"></td>
									<td style="pointer-events: none; opacity: 0.5;"><?php echo number_format($cart_item['price'], 0, ',', '.') ?></td>
									<td style="pointer-events: none; opacity: 0.5;">
										<a href="../cart/cart_action.php?sub=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus" aria-hidden="true"></i></a>
										<?php echo $cart_item['quantity'] ?>
										<a href="../cart/cart_action.php?add=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
										<?php 
											if($rowProd['ProdQuantity'] - $rowProd['TotalOrders'] <= 10){
										?>
											<p style="color: red">Còn <?php echo $rowProd['ProdQuantity'] - $rowProd['TotalOrders'] ?> sản phẩm</p>
										<?php
											}
										?>
									</td>
									<td><?php echo number_format($thanhtien, 0, ',', '.') ?></td>
									<td><a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm <?php echo $cart_item['name'] ?> khỏi giỏ hàng không?')" href="../cart/cart_action.php?delete=<?php echo $cart_item['id'] ?>" class="btn btn-sm btn-danger">Xóa</a></td>
								</tr>
								<?php
									}else{
										$thanhtien = $cart_item['quantity'] * $cart_item['price'];
								?>
									<tr class="text-center">
									<th><input type="checkbox" name="ckProdId_<?php echo $cart_item['id'] ?>" value="<?php echo $cart_item['id'] ?>"></th>
									<th><?php echo $i ?></th>
									<td><?php echo $cart_item['id'] ?></td>
									<td><?php echo '<a href="../singleproduct/singleproduct.php?ProdId='.$cart_item['id'].'">'.$cart_item['name'].'</a>' ?></td>
									<td><img src="../../images/<?php echo $cart_item['image'] ?>" width="60"></td>
									<td><?php echo number_format($cart_item['price'], 0, ',', '.') ?></td>
									<td>
										<a href="../cart/cart_action.php?sub=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus" aria-hidden="true"></i></a>
										<?php echo $cart_item['quantity'] ?>
										<a href="../cart/cart_action.php?add=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
										<?php 
											if($rowProd['ProdQuantity'] - $rowProd['TotalOrders'] <= 10){
										?>
											<p style="color: red">Còn <?php echo $rowProd['ProdQuantity'] - $rowProd['TotalOrders'] ?> sản phẩm</p>
										<?php
											}
										?>
									</td>
									<td><?php echo number_format($thanhtien, 0, ',', '.') ?></td>
									<td><a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm <?php echo $cart_item['name'] ?> khỏi giỏ hàng không?')" href="../cart/cart_action.php?delete=<?php echo $cart_item['id'] ?>" class="btn btn-sm btn-danger">Xóa</a></td>
								</tr>
								<?php
									}
								?>
							</tbody>
							<?php
									}

									?>
									<tr>
										<th colspan="8"></th>
										<th class="text-center"><a onclick="return confirm('Bạn có chắc muốn xóa toàn bộ sản phẩm trong giỏ hàng không?')" href="../cart/cart_action.php?deleteAll=1" class="btn btn-sm btn-danger">Xóa tất cả</a></th>
									</tr>
									<tr>
										<th colspan="8"></th>	
										<!-- <th class="text-center"><a href="./order_action.php" class="btn btn-sm btn-success">Đặt hàng</a></th> -->
										<th class="text-center"><input type="submit" class="btn btn-sm btn-primary" name="cmdMuahang" value="Mua hàng"></th>
									</tr>
									</form>
									<?php
								}else{
							?>
								<tr><td colspan="9">Không có sản phẩm nào trong giỏ hàng</td></tr>
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

<script>
    let checkAll = document.getElementById('checkAll');
    let checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#checkAll)');

    checkAll.addEventListener('click', function () {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = checkAll.checked;
        });
    });
</script>

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
