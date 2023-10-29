<?php
session_start();
require_once('../../config/config.php');
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
	<style>
		.product_image img {
			object-fit: cover;
			width: 100%;
			min-height: 240px;
			height: 240px;
		}
	</style>
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
							<li class="active"><a href="index.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Men's</a></li>
						</ul>
					</div>

					<!-- Sidebar -->

					<div class="sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">
								<h5>Product Category</h5>
							</div>
							<ul class="sidebar_categories">
								<li><a href="#">Men</a></li>
								<li class="active"><a href="#"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>Women</a></li>
								<li><a href="#">Accessories</a></li>
								<li><a href="#">New Arrivals</a></li>
								<li><a href="#">Collection</a></li>
								<li><a href="#">Shop</a></li>
							</ul>
						</div>

						<!-- Price Range Filtering -->
						<div class="sidebar_section">
							<div class="sidebar_title">
								<h5>Filter by Price</h5>
							</div>
							<p>
								<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
							</p>
							<div id="slider-range"></div>
							<div class="filter_button"><span>filter</span></div>
						</div>

					</div>

					<!-- Main Content -->

					<div class="main_content">

						<!-- Products -->

						<div class="products_iso">
							<div class="row">
								<div class="col">

									<!-- Product Sorting -->

									<div class="product_sorting_container product_sorting_container_top">
										<ul class="product_sorting">
											<li>
												<span class="type_sorting_text">Default Sorting</span>
												<i class="fa fa-angle-down"></i>
												<ul class="sorting_type">
													<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Default Sorting</span></li>
													<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "price" }'><span>Price</span></li>
													<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "name" }'><span>Product Name</span></li>
												</ul>
											</li>
											<li>
												<span>Show</span>
												<span class="num_sorting_text">6</span>
												<i class="fa fa-angle-down"></i>
												<ul class="sorting_num">
													<li class="num_sorting_btn"><span>6</span></li>
													<li class="num_sorting_btn"><span>12</span></li>
													<li class="num_sorting_btn"><span>24</span></li>
												</ul>
											</li>
										</ul>
										<div class="pages d-flex flex-row align-items-center">
											<div class="page_current">
												<span>1</span>
												<ul class="page_selection">
													<li><a href="#">1</a></li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
												</ul>
											</div>
											<div class="page_total"><span>of</span> 3</div>
											<div id="next_page" class="page_next"><a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
										</div>

									</div>

									<!-- Product Grid -->

									<div class="product-grid">

										<!-- Product 1 -->
										<?php
										$sql = "Select * from Product";
										$result = mysqli_query($connection, $sql);
										if (mysqli_fetch_array($result) > 0) {
											foreach ($result as $Prod) {
										?>
												<div class="product-item women">
													<div class="product product_filter">
														<div class="product_image">
															<img src="../../images/<?php echo $Prod["ProdImage"]; ?>" alt="">
														</div>
														<div class="favorite"></div>
														<div class="product_info">
															<h6 class="product_name"><a href="../singleproduct/singleproduct.php?ProdId=<?= $Prod['ProdId'] ?>"><?php echo $Prod["ProdName"] ?></a></h6>
															<div class="product_price"><?php echo $Prod["ProdPrice"] ?></div>
														</div>
													</div>
													<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
												</div>

										<?php
											}
										}
										?>


									</div>

									<!-- Product Sorting -->

									<div class="product_sorting_container product_sorting_container_bottom clearfix">
										<ul class="product_sorting">
											<li>
												<span>Show:</span>
												<span class="num_sorting_text">04</span>
												<i class="fa fa-angle-down"></i>
												<ul class="sorting_num">
													<li class="num_sorting_btn"><span>01</span></li>
													<li class="num_sorting_btn"><span>02</span></li>
													<li class="num_sorting_btn"><span>03</span></li>
													<li class="num_sorting_btn"><span>04</span></li>
												</ul>
											</li>
										</ul>
										<span class="showing_results">Showing 1–3 of 12 results</span>
										<div class="pages d-flex flex-row align-items-center">
											<div class="page_current">
												<span>1</span>
												<ul class="page_selection">
													<li><a href="#">1</a></li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
												</ul>
											</div>
											<div class="page_total"><span>of</span> 3</div>
											<div id="next_page_1" class="page_next"><a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
										</div>

									</div>

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