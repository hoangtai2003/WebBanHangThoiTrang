<?php
	session_start();
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
										<a href="../cart/add_cart.php?sub=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus" aria-hidden="true"></i></a>
										<?php echo $cart_item['quantity'] ?>
										<a href="../cart/add_cart.php?add=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
									</td>
									<td><?php echo number_format($thanhtien, 0, ',', '.') ?></td>
									<td><a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm <?php echo $cart_item['name'] ?> khỏi giỏ hàng không?')" href="../cart/add_cart.php?delete=<?php echo $cart_item['id'] ?>" class="btn btn-sm btn-danger">Xóa</a></td>
								</tr>
							</tbody>
							<?php
									}
									?>
									<tr>
										<th colspan="6" class="text-right">Tổng tiền:</th>
										<th class="text-center"><?php echo number_format($tongtien, 0, ',', '.') ?></th>
										<th class="text-center"><a onclick="return confirm('Bạn có chắc muốn xóa toàn bộ sản phẩm trong giỏ hàng không?')" href="../cart/add_cart.php?deleteAll=1" class="btn btn-sm btn-danger">Xóa tất cả</a></th>
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
