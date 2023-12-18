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
					<h2 style="color: #a84832;">Gian hàng</h2>
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
								<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".<?= strtolower($catenameReplace) ?>"><?= $catename ?></li>
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
					<?php
					// $sql = "SELECT * from product inner join categories on product.CateId = categories.CateId where categories.CateStatus = 1 and product.ProdStatus = 1";
					$sql = "SELECT product.*, categories.CateName, IFNULL(TotalOrders, 0) AS TotalOrders
										FROM product
										INNER JOIN categories ON product.CateId = categories.CateId
										LEFT JOIN (
											SELECT ProdId, SUM(od.OrdQuantity) AS TotalOrders
											FROM orderdetail AS od
											GROUP BY ProdId
										) AS SoldProducts ON product.ProdId = SoldProducts.ProdId
										WHERE categories.CateStatus = 1 AND product.ProdStatus = 1;
						";
					$result = $connection->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							$catename = $row["CateName"];
							$catenameReplace = preg_replace('/[^a-zA-Z0-9]/', '', $catename);
					?>
							<form action="" class="form-submit">
								<input type="hidden" class="ProdId" value="<?= $row['ProdId'] ?>">
								<div class="product-item <?= strtolower($catenameReplace) ?>">
									<div class="product discount product_filter">
										<div class="product_image">
											<a href="../singleproduct/singleproduct_action.php?ProdId=<?= $row["ProdId"] ?>"><img src="../../images/<?= $row["ProdImage"] ?>" alt=""></a>
										</div>
										<div class="favorite favorite_left"></div>
										<!-- <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-$20</span></div> -->
										<div class="product_info">
											<h6 class="product_name"><a href="../singleproduct/singleproduct_action.php?ProdId=<?= $row["ProdId"] ?>"><?= $row["ProdName"] ?></a></h6>
											<?php
											if ($row['ProdIsSale'] == 1) {
											?>
												<div class="product_price"><?= number_format($row["ProdPriceSale"], 0, ',', '.') ?>₫<span><?= number_format($row["ProdPrice"], 0, ',', '.') ?>₫</span></div>
											<?php
											} else if ($row['ProdIsSale'] == 0) {
											?>
												<div class="product_price"><?= number_format($row["ProdPrice"], 0, ',', '.') ?>₫</div>
											<?php
											}
											?>
										</div>
									</div>
									<?php
									if ($row['ProdQuantity'] - $row['TotalOrders'] <= 0) {
										echo '<div class="red_button add_to_cart_button"><a style="color: #fff;">hết hàng</a></div>';
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
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

