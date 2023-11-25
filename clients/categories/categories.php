<?php
session_start();
require_once('../../config/config.php')
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
	<link rel="stylesheet" type="text/css" href="../includes/header_search.css">

</head>

<body>
	<div class="super_container">

		<!-- Header -->
		<?php include_once("../includes/header.php") ?>

		<div class="fs_menu_overlay"></div>

		<!-- Hamburger Menu -->
		<?php include_once("../includes/hamburger_menu.php") ?>

		<div class="container product_section_container">
			<div class="row" style="padding-top: 40px;">
				<div class="col product_section clearfix">
					<!-- Sidebar -->

					<div class="sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">
								<h4>Danh mục</h4>
							</div>
							<ul class="sidebar_categories">
								<?php
									$CateId = isset($_REQUEST['CateId']) ? $_REQUEST['CateId'] : null;
									$sqlCate = "Select * from categories";
									$resultCate = mysqli_query($connection, $sqlCate);
								?>
								<?php if (!isset($_REQUEST['CateId'])) { ?>
									<li class="active"><a href="categories.php"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>Tất cả sản phẩm</a></li>
								<?php } else { ?>
									<li class=""><a href="categories.php">Tất cả sản phẩm</a></li>
								<?php } ?>
								<?php
								if (mysqli_num_rows($resultCate) > 0) {
									foreach ($resultCate as $row) {
								?>
								<?php if ($row["CateId"] == $CateId) { ?>
									<li class="active"><a href=""><span><i class="fa fa-angle-double-right" aria-hidden="true"></i><?= $row["CateName"] ?></a></li>
								<?php  } else { ?>
										<li class=""><a href="categories.php?CateId=<?php echo $row["CateId"] ?>"><?= $row["CateName"] ?></a></li>
									<?php } ?>
								<?php } ?>
							<?php } ?>
							</ul>
						</div>
						<div>
							<h5>Khoảng giá</h5>
						</div>
						<div class="shopee-price-range-filter__inputs"><input id="min-price" type="number" aria-label="" maxlength="13" class="shopee-price-range-filter__input" placeholder="₫ từ" value="" fdprocessedid="krwrii">
							<div class="shopee-price-range-filter__range-line"></div><input id="max-price" type="number" aria-label="" maxlength="13" class="shopee-price-range-filter__input" placeholder="₫ đến" value="" fdprocessedid="kthd6b">
						</div>
						<div class="filter_button" onclick="filterByPrice()"><span>Áp dụng</span></div>
					</div>

					<!-- Main Content -->
					
					<div class="main_content">
						<div class="products_iso">
							<div class="row">
								<div class="col">
									<div class="product_sorting_container product_sorting_container_top">
										<ul class="product_sorting">
											<li>
												<span class="type_sorting_text">Giá</span>
												<i class="fa fa-angle-down"></i>
												<ul class="sorting_type">
													<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "price", "sortAscending": false }'><span>Giá: cao đến thấp</span></li>
													<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "price", "sortAscending": true }'><span>Giá: thấp đến cao</span></li>
												</ul>
											</li>
										</ul>
									</div>
									<div class="product-grid" style="display: flex;">
										<?php
										$cmd=isset($_REQUEST["cmd"])?$_REQUEST["cmd"]:'';
										if ($cmd !='') {
											$search=isset($_REQUEST["search-box"])?$_REQUEST["search-box"]:'';
											include("../pagination/offset.php");
										$totalRecords = mysqli_query($connection, "select product.*, categories.* from product inner join categories on product.CateId = categories.CateId where categories.CateId = '$CateId' ");
										$totalRecords = $totalRecords->num_rows;
										// Tổng số trang = tổng số sản phẩm / tổng số sản phẩm một trang
										$totalPage = ceil($totalRecords / $item_per_page);
																
										$sql = "SELECT product.*,categories.*, IFNULL(TotalOrders, 0) AS TotalOrders
										FROM product
										inner join categories on product.CateId = categories.CateId
										LEFT JOIN (
											SELECT ProdId, SUM(od.OrdQuantity) AS TotalOrders
											FROM orderdetail AS od
											GROUP BY ProdId
										) AS SoldProducts ON product.ProdId = SoldProducts.ProdId
										WHERE categories.CateStatus = 1 AND product.ProdStatus = 1 and product.ProdName like '%".$search."%'
										order by ProdId desc limit ".$item_per_page." offset ".$offset."";
										$result = $connection->query($sql);
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
										?>
											<form action="" class="form-submit">
													<input type="hidden" class="ProdId" value="<?php echo $row['ProdId'] ?>">
													<div class="product-item">
														<div class="product product_filter">
															<div class="product_image">
																<img src="../../images/<?php echo $row["ProdImage"]; ?>" alt="">
															</div>
															<div class="favorite"></div>
															<!-- <div class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center"><span>new</span></div> -->
															<div class="product_info">
																<h6 class="product_name"><a href="../singleproduct/singleproduct_action.php?ProdId=<?php echo $row['ProdId'] ?>"><?php echo $row["ProdName"] ?></a></h6>
																<?php
																if ($row['ProdIsSale'] == 1) {
																?>
																	<div class="product_price"><?php echo number_format($row["ProdPriceSale"], 0, ',', '.') ?> VNĐ<span><?php echo number_format($row["ProdPrice"], 0, ',', '.') ?> VNĐ</span></div>
																<?php
																} else if ($row['ProdIsSale'] == 0) {
																?>
																	<div class="product_price"><?php echo number_format($row["ProdPrice"], 0, ',', '.') ?> VNĐ</div>
																<?php
																}
																?>
															</div>
														</div>
														<?php
														if ($row['ProdQuantity'] - $row['TotalOrders'] <= 0) {
															echo '<div class="red_button add_to_cart_button"><a href="#">hết hàng</a></div>';
														} else {
															echo '<div class="red_button add_to_cart_button"><a href="" id="cart_link">add to cart</a></div>';
														}
														?>
													</div>
												</form>
												<?php
												}
											} else {
												echo "Không có sản phẩm nào";
											}
										
										} else if (isset($CateId)) {
											?>
										<?php
										include("../pagination/offset.php");
										$totalRecords = mysqli_query($connection, "select product.*, categories.* from product inner join categories on product.CateId = categories.CateId where categories.CateId = '$CateId' ");
										$totalRecords = $totalRecords->num_rows;
										// Tổng số trang = tổng số sản phẩm / tổng số sản phẩm một trang
										$totalPage = ceil($totalRecords / $item_per_page);
																
										$sql = "SELECT product.*,categories.*, IFNULL(TotalOrders, 0) AS TotalOrders
										FROM product
										inner join categories on product.CateId = categories.CateId
										LEFT JOIN (
											SELECT ProdId, SUM(od.OrdQuantity) AS TotalOrders
											FROM orderdetail AS od
											GROUP BY ProdId
										) AS SoldProducts ON product.ProdId = SoldProducts.ProdId
										WHERE categories.CateStatus = 1 AND product.ProdStatus = 1 and product.CateId = '$CateId'
										order by ProdId desc limit ".$item_per_page." offset ".$offset."";
										$result = $connection->query($sql);
											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
										?>
												<form action="" class="form-submit">
													<input type="hidden" class="ProdId" value="<?php echo $row['ProdId'] ?>">
													<div class="product-item">
														<div class="product product_filter">
															<div class="product_image">
																<img src="../../images/<?php echo $row["ProdImage"]; ?>" alt="">
															</div>
															<div class="favorite"></div>
															<div class="product_info">
																<h6 class="product_name"><a href="../singleproduct/singleproduct_action.php?ProdId=<?php echo $row['ProdId'] ?>"><?php echo $row["ProdName"] ?></a></h6>
																<?php
																$priceSale = number_format(floatval($row["ProdPriceSale"]), 0, ',', '.');
																$price = number_format(floatval($row["ProdPrice"]), 0, ',', '.');
																if ($row['ProdIsSale'] == 1) {
																?>
																	<div class="product_price"><?= $priceSale ?>₫<span><?= $price ?>₫</span></div>
																<?php
																} else if ($row['ProdIsSale'] == 0) {
																?>
																	<div class="product_price"><?= $price ?>₫</div>
																<?php
																}
																?>
															</div>
														</div>
														<?php
														if ($row['ProdQuantity'] - $row['TotalOrders'] <= 0) {
															echo '<div class="red_button add_to_cart_button"><a href="#">hết hàng</a></div>';
														} else {
															echo '<div class="red_button add_to_cart_button"><a href="" id="cart_link">Thêm vào giỏ hàng</a></div>';
														}
														?>
													</div>
												</form>
												<?php
												}
											} else {
												echo "Không có sản phẩm nào";
											}

										} else {
											include("../pagination/offset.php");
											$totalRecords = mysqli_query($connection, "select * from product");
											$totalRecords = $totalRecords->num_rows;
											// Tổng số trang = tổng số sản phẩm / tổng số sản phẩm một trang
											$totalPage = ceil($totalRecords / $item_per_page);
											$sqlAllProduct = "SELECT product.*,categories.*, IFNULL(TotalOrders, 0) AS TotalOrders
											FROM product
											inner join categories on product.CateId = categories.CateId
											LEFT JOIN (
												SELECT ProdId, SUM(od.OrdQuantity) AS TotalOrders
												FROM orderdetail AS od
												GROUP BY ProdId
											) AS SoldProducts ON product.ProdId = SoldProducts.ProdId
											WHERE categories.CateStatus = 1 AND product.ProdStatus = 1
											order by ProdId desc limit ".$item_per_page." offset ".$offset."";
											$resultProduct = mysqli_query($connection, $sqlAllProduct);
											if ($resultProduct->num_rows > 0) {
												while ($row = $resultProduct->fetch_assoc()) {
												?>
												<form action="" class="form-submit">
													<input type="hidden" class="ProdId" value="<?php echo $row['ProdId'] ?>">
													<div class="product-item">
														<div class="product product_filter">
															<div class="product_image">
																<img src="../../images/<?php echo $row["ProdImage"]; ?>" alt="">
															</div>
															<div class="favorite"></div>
															<div class="product_info">
																<h6 class="product_name"><a href="../singleproduct/singleproduct_action.php?ProdId=<?php echo $row['ProdId'] ?>"><?php echo $row["ProdName"] ?></a></h6>
																<?php
																$priceSale = number_format(floatval($row["ProdPriceSale"]), 0, ',', '.');
																$price = number_format(floatval($row["ProdPrice"]), 0, ',', '.');
														
																if ($row['ProdIsSale'] == 1) {
																?>
																	<div class="product_price"><?= $priceSale ?>₫<span><?=$price ?>₫</span></div>
																<?php
																} else if ($row['ProdIsSale'] == 0) {
																?>
																	<div class="product_price"><?=$price ?>₫</div>
																<?php
																}
																?>
															</div>
														</div>
														<?php
														if ($row['ProdQuantity'] - $row['TotalOrders'] <= 0) {
															echo '<div class="red_button add_to_cart_button"><a href="#">hết hàng</a></div>';
														} else {
															echo '<div class="red_button add_to_cart_button"><a href="#" id="cart_link">Thêm vào giỏ hàng</a></div>';
														}
														?>
													</div>
												</form>

										<?php
												}
											} else {
												echo "Không có sản phẩm nào";
											}
										}
										?>
									</div>
									<?php include("../pagination/pagination.php") ?>
								</div>
							</div>
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

	<script type="text/javascript">
		$(document).ready(function(e) {
			function load_cart_item_number() {
				$.ajax({
					url: '../cart/cart_action.php',
					method: 'get',
					data: {
						cartItem: "cart_item"
					},
					success: function(response) {
						$("#checkout_items").html(response);
					}
				});
			}
			$('body').on('click', '#cart_link', function(e) {
				e.preventDefault();
				var quantity = 1;
				<?php
				if (!isset($_SESSION['cus_loggedin'])) {
				?>
					window.location.href = '../authen/login.php';
					return;
				<?php
				}
				?>
				var $form = $(this).closest(".form-submit");
				var productId = $form.find(".ProdId").val();

				$.ajax({
					url: '../cart/cart_action.php',
					method: 'get',
					data: {
						cartadd: "themgiohang",
						productId: productId,
						quantity: quantity
					},
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							alert(response.message);
							load_cart_item_number();
						} else {
							alert(response.message);
						}
					}
				});
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

	<!-- lọc giá sản phẩm -->
	<script>
		const deleteSelect = document.querySelector('.btn-delete');
		console.log(deleteSelect)
		function filterByPrice() {
			var minPrice = document.getElementById("min-price").value;
			var maxPrice = document.getElementById("max-price").value;
			// sử dụng ajax để gửi giá lên server

			if (minPrice === "" || maxPrice === "") {
				alert("Vui lòng nhập khoảng giá trước khi áp dụng bộ lọc.");
				return;
			}
			var CateId = <?php echo json_encode($CateId); ?>;
			$.ajax({
				type: 'POST',
				url: 'filter_products.php',
				data: {
					CateId: CateId,
					minPrice: minPrice,
					maxPrice: maxPrice
				},
				success: function(response) {
					$('.product-grid').html(response);
				},
				error: function(error) {
					console.log(error);
				}
			});
		}
	</script>
</body>

</html>