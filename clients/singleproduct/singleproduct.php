<?php
session_start();
require_once('../../config/config.php');
$ProdId = $_REQUEST['ProdId'];
if(isset($_SESSION['cusid'])){
	$cusid = $_SESSION['cusid'];
}

$sqlProd = "SELECT * FROM product  LEFT JOIN (
	SELECT ProdId, SUM(OrdQuantity) AS TotalOrders
	FROM orderdetail
	GROUP BY ProdId
) AS SoldProducts ON product.ProdId = SoldProducts.ProdId and product.ProdId = $ProdId";
$product = mysqli_query($connection, $sqlProd);
$dataProduct = mysqli_fetch_assoc($product);

//Lấy thông tin của các nhận xét theo id sản phẩm
$sql_feedback = "SELECT * FROM comment
                LEFT JOIN customer on comment.CusId = customer.CusId 
                WHERE   comment.ProdId=$ProdId";
$result_feedback = mysqli_query($connection, $sql_feedback);
$data_feedback = array();
while ($row = mysqli_fetch_assoc($result_feedback)) {
	$data_feedback[] = $row;
}

// lấy sao trung bình
$sql_rating = "select round(avg(rate), 1) as avg_rate
				from comment
				where ProdId = $ProdId";
$result_rating = mysqli_query($connection, $sql_rating);
$data_rating = mysqli_fetch_assoc($result_rating);



// Lấy ảnh mô tả của sản phẩm
$sqlImgProd = "select * from productimage where ProdId = $ProdId";
$imgProd = mysqli_query($connection, $sqlImgProd);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Single Product</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Colo Shop Template">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/styles/bootstrap4/bootstrap.min.css">
	<link href="../assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" href="../assets/plugins/themify-icons/themify-icons.css">
	<link rel="stylesheet" type="text/css" href="../assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../assets/styles/single_styles.css">
	<link rel="stylesheet" type="text/css" href="../assets/styles/single_responsive.css">
	<link rel="stylesheet" type="text/css" href="./Slider.css">
	<link rel="stylesheet" type="text/css" href="./singleproduct.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
</head>

<body>

	<div class="super_container">
		<!-- Header -->
		<?php include_once("../includes/header.php") ?>

		<div class="fs_menu_overlay"></div>

		<!-- Hamburger Menu -->
		<?php include_once("../includes/hamburger_menu.php") ?>

		<div class="container single_product_container">
			<div class="row">
				<div class="col">

					<!-- Breadcrumbs -->

					<div class="breadcrumbs d-flex flex-row align-items-center">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="categories.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Men's</a></li>
							<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Single Product</a></li>
						</ul>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-lg-7">
					<div class="single_product_pics">
						<div class="row">
							<div class="col-lg-3 thumbnails_col order-lg-1 order-2">
								<div class="single_product_thumbnails">
									<div class="item-container">
										<ul class="slider-image-product">
											<li class="active "><img src="../../images/<?php echo $dataProduct['ProdImage'] ?>" alt="" data-image="../../images/<?php echo $dataProduct['ProdImage'] ?>"></li>
											<?php foreach ($imgProd as $key => $value) { ?>
												<li><img src="../../images/<?php echo $value["Image"] ?>" alt="" data-image="../../images/<?php echo $value["Image"] ?>"></li>
											<?php } ?>
										</ul>
									</div>

								</div>
							</div>
							<div class="col-lg-9 image_col order-lg-2 order-1">
								<div class="single_product_image">
									<div class="single_product_image_background" style="background-image:url(../../images/<?php echo $dataProduct['ProdImage'] ?>)"><img src="" alt=""></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="product_details">
						<div class="product_details_title">
							<h2><?php echo $dataProduct["ProdName"] ?></h2>
							<div class="rate">
								<span class="number-rate"><?php # echo $result_rating["avg_rate"] 
															?></span>
								<?php
								$avg_rate = $data_rating['avg_rate'];
								for ($i = 1; $i <= 5; $i++) {
									if ($i <= $avg_rate) {
										echo '<i class="fa fa-star" aria-hidden="true"></i>';
									} else {
										echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
									}
								}
								?>
							</div>
							<span><?php echo $dataProduct["ProdViewCount"] ?></span><span> Lượt xem</span> | <span><?php echo $dataProduct["TotalOrders"] ?></span><span> Đã bán</span> | <span><?php echo $dataProduct['ProdQuantity'] - $dataProduct["TotalOrders"] ?></span><span> Sản phẩm có sẵn</span>
						</div>
						<div class="free_delivery d-flex flex-row align-items-center justify-content-center">
							<span class="ti-truck"></span><span>free delivery</span>
						</div>
						<?php
						if ($dataProduct['ProdIsSale'] == 1) {
						?>
							<div class="original_price"><?php echo number_format($dataProduct["ProdPrice"], 0, ',', '.') ?></div>
							<div class="product_price"><?php echo number_format($dataProduct["ProdPriceSale"], 0, ',', '.') ?></div>
						<?php
						} else if ($dataProduct['ProdIsSale'] == 0) {
						?>
							<div class="product_price"><?php echo number_format($dataProduct["ProdPrice"], 0, ',', '.') ?></div>
						<?php
						}
						?>
						<ul class="star_rating">
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
						</ul>

						<div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
							<span>Quantity:</span>
							<div class="quantity_selector">
								<span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
								<span id="quantity_value">1</span>
								<span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
							</div>
							<?php
							if ($dataProduct['ProdQuantity'] - $dataProduct['TotalOrders'] <= 0) {
								echo '<div class="red_button add_to_cart_button"><a style="color: #fff;">hết hàng</a></div>';
							} else {
								echo '<div class="red_button add_to_cart_button"><a href="#" id="cart_link">add to cart</a></div>';
							}
							?>
							<div class="product_favorite d-flex flex-column align-items-center justify-content-center"></div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!-- Tabs -->

		<div class="tabs_section_container">

			<div class="container">
				<div class="row">
					<div class="col">
						<div class="tabs_container">
							<ul class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
								<li class="tab active" data-active-tab="tab_1"><span>Description</span></li>
								<li class="tab" data-active-tab="tab_3"><span>Reviews (2)</span></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">

						<!-- Tab Description -->

						<div id="tab_1" class="tab_container active">
							<div class="row">
								<div class="col-lg-5 desc_col">
									<div class="tab_title">
										<h4>Description</h4>
										<p><?php echo $dataProduct["ProdDescription"] ?></p>
									</div>

								</div>

							</div>
						</div>

						<!-- Tab Reviews -->

						<div id="tab_3" class="tab_container ">
							<div class="row">

								<!-- User Reviews -->

								<div class="col-lg-6 reviews_col">
									<div class="tab_title reviews_title">
										<h4>Reviews(<?php echo count($data_feedback); ?>)</h4>
									</div>

									<?php foreach ($data_feedback as $feedback) { ?>
										<div class="user_review_container d-flex flex-column flex-sm-row">
											<div class="user">
												<div class="user_pic"></div>
												<div class="user_rating">
													<ul class="star_rating">
														<?php for ($i = 1; $i <= 5; $i++) { ?>
															<li>
																<?php if ($i <= $feedback['rate']) { ?>
																	<i class="fa fa-star" aria-hidden="true"></i>
																<?php } else { ?>
																	<i class="fa fa-star-o" aria-hidden="true"></i>
																<?php } ?>
															</li>
														<?php } ?>
													</ul>
												</div>
											</div>
											<div class="review">
												<div class="review_date"><?php echo $feedback['created_at']; ?></div>
												<div class="user_name"><?php echo $feedback['CusUserName']; ?></div>
												<p><?= $feedback['CmtDescription'] ?></p>
											</div>
										</div>
									<?php } ?>
									<!-- User Review -->

									<!-- <div class="user_review_container d-flex flex-column flex-sm-row">
										<div class="user">
											<div class="user_pic"></div>
											<div class="user_rating">
												<ul class="star_rating">
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
												</ul>
											</div>
										</div>
										<div class="review">
											<div class="review_date">27 Aug 2016</div>
											<div class="user_name">Brandon William</div>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
										</div>
									</div> -->
								</div>

								<!-- Add Review -->

								<div class="col-lg-6 add_review_col">

									<div class="add_review">
										<form method="POST" action="./ProductFeedbackAction.php?ProdId=<?php echo $dataProduct["ProdId"] ?>" id="review_form">
											<div>
												<div class="rating-container">
													<h1>Your Rating:</h1>
													<!-- <ul class="user_star_rating">
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star" aria-hidden="true"></i></li>
													<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
												</ul> -->
													<span class="star-rating">
														<input type="radio" id="star5" name="rating" value="5">
														<label for="star5" title="5 sao"></label>
														<input type="radio" id="star4" name="rating" value="4">
														<label for="star4" title="4 sao"></label>
														<input type="radio" id="star3" name="rating" value="3">
														<label for="star3" title="3 sao"></label>
														<input type="radio" id="star2" name="rating" value="2">
														<label for="star2" title="2 sao"></label>
														<input type="radio" id="star1" name="rating" value="1">
														<label for="star1" title="1 sao"></label>
													</span>
												</div>

												<textarea id="review_message" class="input_review" name="description" placeholder="viết nhận xét" rows="4" required data-error="Please, leave us a review."></textarea>
											</div>
											<div class="text-left text-sm-right">
												<button id="review_submit" type="submit" class="red_button review_submit_btn trans_300" value="Submit">submit</button>
											</div>
										</form>
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
	<script src="../assets/js/single_custom.js"></script>


	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('body').on('click', '.minus', function(e){
				var quantity = parseInt($('#quantity_value').text());
				if (quantity > 1) {
					quantity -= 1;
				}
				$('#quantity_value').text(quantity);
			});
			var maxQuantity = 0;
			$('body').on('click', '.plus', function(e){
				var productId = <?php echo $dataProduct['ProdId'] ?>;
				$.ajax({
					url: './singleproduct_action.php',
					method: 'get',
					data: {
						clickplus: "plus",
						productId: productId
					},
					dataType: 'json',
					success: function(response) {
						if(response.success){
							maxQuantity = response.maxQuantity;
							// alert(maxQuantity);
							updateQuantity(maxQuantity);
						}
					}
				});
			});
			function updateQuantity(maxQuantity){
				var quantity = parseInt($('#quantity_value').text());
				if(quantity < maxQuantity){
					quantity += 1;
					if(quantity > maxQuantity){
						quantity =maxQuantity;
					}
				}
				else{
					alert('Đã đạt tối đa số lượng sản phẩm và không cho tăng nữa.');
					quantity = maxQuantity;
				}
				$('#quantity_value').text(quantity);
			}

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
				var tQuantity = $('#quantity_value').text();
				if (tQuantity != '') {
					quantity = parseInt(tQuantity);
				}
				<?php
				if (!isset($_SESSION['cus_loggedin'])) {
				?>
					window.location.href = '../authen/login.php';
					return;
				<?php
				}
				?>
				var productId = <?php echo $dataProduct['ProdId'] ?>

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
						if(response.success){
							alert(response.message);
							load_cart_item_number();
						}
						else{
							alert(response.message);
						}
					}
				});
			});
		});
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
	<script>
		// Kích hoạt Slick Slider
		$(document).ready(function() {
			$('.slider-image-product').slick({
				autoplaySpeed: 20000,
				infinite: true,
				autoplay: false,
				vertical: true, // Kích hoạt chế độ dọc
				verticalSwiping: true, // Cho phép chuyển trang dọc
				slidesToShow: 4,
				slidesToScroll: 1,
				responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: true,
							autoplay: false,
							autoplaySpeed: 1000,
							infinite: true,
							vertical: false,
							verticalSwiping: false,
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							autoplay: true,
							autoplaySpeed: 1000,
							infinite: true,
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							autoplay: true,
							autoplaySpeed: 1000,
							infinite: true,
						}
					}
				]
			});

		});
	</script>
</body>

</html>