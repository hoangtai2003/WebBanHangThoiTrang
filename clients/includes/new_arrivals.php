<!-- New Arrivals -->
<?php
// session_start();
require_once('../../config/config.php');
?>
<div class="new_arrivals">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="section_title new_arrivals_title">
					<h2>New Arrivals</h2>
				</div>
			</div>
		</div>
		<div class="row align-items-center">
			<div class="col text-center">
				<div class="new_arrivals_sorting">
					<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
						<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
						<?php
						$sql_cate = "SELECT * FROM categories";
						$result_cate = $connection->query($sql_cate);
						if ($result_cate->num_rows > 0) {
							while ($row = $result_cate->fetch_assoc()) {
								$catename = $row["CateName"];
								$catenameReplace = preg_replace('/[^a-zA-Z0-9]/', '', $catename);
						?>
								<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".<?php echo strtolower($catenameReplace) ?>"><?php echo $catename ?></li>
						<?php
							}
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

					<!-- Product 1 -->
					<?php
					// $sql = "SELECT * from product inner join categories on product.CateId = categories.CateId where categories.CateStatus = 1 and product.ProdStatus = 1";
					$sql = "SELECT product.*, categories.CateName, IFNULL(TotalOrders, 0) AS TotalOrders
						FROM product
						INNER JOIN categories ON product.CateId = categories.CateId
						LEFT JOIN (
							SELECT ProdId, COUNT(*) AS TotalOrders
							FROM orderdetail
							GROUP BY ProdId
						) AS SoldProducts ON product.ProdId = SoldProducts.ProdId
						WHERE categories.CateStatus = 1 AND product.ProdStatus = 1;
						";
					$result = $connection->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							// var_dump($row);
							$catename = $row["CateName"];
							$catenameReplace = preg_replace('/[^a-zA-Z0-9]/', '', $catename);
					?>
							<form action="" class="form-submit">
								<input type="hidden" class="ProdId" value="<?php echo $row['ProdId'] ?>">
								<div class="product-item <?php echo strtolower($catenameReplace) ?>">
									<div class="product discount product_filter">
										<div class="product_image">
											<img src="../../images/<?php echo $row["ProdImage"] ?>" alt="">
										</div>
										<div class="favorite favorite_left"></div>
										<!-- <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-$20</span></div> -->
										<div class="product_info">
											<h6 class="product_name"><a href="../singleproduct/singleproduct.php?ProdId=<?php echo $row["ProdId"] ?>"><?php echo $row["ProdName"] ?></a></h6>
											<?php
											if ($row['ProdIsSale'] == 1) {
											?>
												<div class="product_price"><?php echo number_format($row["ProdPriceSale"], 0, ',', '.') ?><span><?php echo number_format($row["ProdPrice"], 0, ',', '.') ?></span></div>
											<?php
											} else if ($row['ProdIsSale'] == 0) {
											?>
												<div class="product_price"><?php echo number_format($row["ProdPrice"], 0, ',', '.') ?></div>
											<?php
											}
											?>
										</div>
									</div>
									<?php
									if ($row['ProdQuantity'] - $row['TotalOrders'] <= 0) {
										echo '<div class="red_button add_to_cart_button"><a style="color: #fff;">hết hàng</a></div>';
									} else {
										echo '<div class="red_button add_to_cart_button"><a href="#" id="cart_link">add to cart</a></div>';
									}
									?>

								</div>
							</form>
					<?php
						}
					} else {
						echo "Không có sản phẩm nào";
					}
					$connection->close();
					?>
					<!-- <div class="product-item men">
							<div class="product discount product_filter">
								<div class="product_image">
									<img src="../assets/images/product_1.png" alt="">
								</div>
								<div class="favorite favorite_left"></div>
								<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-$20</span></div>
								<div class="product_info">
									<h6 class="product_name"><a href="../singleproduct/singleproduct.php">Fujifilm X100T 16 MP Digital Camera (Silver)</a></h6>
									<div class="product_price">$520.00<span>$590.00</span></div>
								</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
						</div> -->

					<!-- Product 2 -->

					<!-- <div class="product-item women">
							<div class="product product_filter">
								<div class="product_image">
									<img src="../assets/images/product_2.png" alt="">
								</div>
								<div class="favorite"></div>
								<div class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center"><span>new</span></div>
								<div class="product_info">
									<h6 class="product_name"><a href="../singleproduct/singleproduct.php">Samsung CF591 Series Curved 27-Inch FHD Monitor</a></h6>
									<div class="product_price">$610.00</div>
								</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
						</div> -->

					<!-- Product 3 -->

					<!-- <div class="product-item women">
							<div class="product product_filter">
								<div class="product_image">
									<img src="../assets/images/product_3.png" alt="">
								</div>
								<div class="favorite"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="../singleproduct/singleproduct.php">Blue Yeti USB Microphone Blackout Edition</a></h6>
									<div class="product_price">$120.00</div>
								</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
						</div> -->

					<!-- Product 4 -->

					<!-- <div class="product-item accessories">
							<div class="product product_filter">
								<div class="product_image">
									<img src="../assets/images/product_4.png" alt="">
								</div>
								<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>sale</span></div>
								<div class="favorite favorite_left"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="../singleproduct/singleproduct.php">DYMO LabelWriter 450 Turbo Thermal Label Printer</a></h6>
									<div class="product_price">$410.00</div>
								</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
						</div> -->

					<!-- Product 5 -->

					<!-- <div class="product-item women men">
							<div class="product product_filter">
								<div class="product_image">
									<img src="../assets/images/product_5.png" alt="">
								</div>
								<div class="favorite"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="../singleproduct/singleproduct.php">Pryma Headphones, Rose Gold & Grey</a></h6>
									<div class="product_price">$180.00</div>
								</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
						</div> -->

					<!-- Product 6 -->
					<!-- 
						<div class="product-item accessories">
							<div class="product discount product_filter">
								<div class="product_image">
									<img src="../assets/images/product_6.png" alt="">
								</div>
								<div class="favorite favorite_left"></div>
								<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-$20</span></div>
								<div class="product_info">
									<h6 class="product_name"><a href="#../singleproduct/singleproduct.php">Fujifilm X100T 16 MP Digital Camera (Silver)</a></h6>
									<div class="product_price">$520.00<span>$590.00</span></div>
								</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
						</div> -->

					<!-- Product 7 -->

					<!-- <div class="product-item women">
							<div class="product product_filter">
								<div class="product_image">
									<img src="../assets/images/product_7.png" alt="">
								</div>
								<div class="favorite"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="../singleproduct/singleproduct.php">Samsung CF591 Series Curved 27-Inch FHD Monitor</a></h6>
									<div class="product_price">$610.00</div>
								</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
						</div> -->

					<!-- Product 8 -->

					<!-- <div class="product-item accessories">
							<div class="product product_filter">
								<div class="product_image">
									<img src="../assets/images/product_8.png" alt="">
								</div>
								<div class="favorite"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="../singleproduct/singleproduct.php">Blue Yeti USB Microphone Blackout Edition</a></h6>
									<div class="product_price">$120.00</div>
								</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
						</div> -->

					<!-- Product 9 -->

					<!-- <div class="product-item men">
							<div class="product product_filter">
								<div class="product_image">
									<img src="../assets/images/product_9.png" alt="">
								</div>
								<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>sale</span></div>
								<div class="favorite favorite_left"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="../singleproduct/singleproduct.php">DYMO LabelWriter 450 Turbo Thermal Label Printer</a></h6>
									<div class="product_price">$410.00</div>
								</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
						</div> -->

					<!-- Product 10 -->

					<!-- <div class="product-item men">
							<div class="product product_filter">
								<div class="product_image">
									<img src="../assets/images/product_10.png" alt="">
								</div>
								<div class="favorite"></div>
								<div class="product_info">
									<h6 class="product_name"><a href="../singleproduct/singleproduct.php">Pryma Headphones, Rose Gold & Grey</a></h6>
									<div class="product_price">$180.00</div>
								</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
						</div> -->
				</div>
			</div>
		</div>
	</div>
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
				success: function() {
					alert("Thêm vào giỏ hàng thành công.");
					load_cart_item_number();
				}
			});
		});
	});
</script>