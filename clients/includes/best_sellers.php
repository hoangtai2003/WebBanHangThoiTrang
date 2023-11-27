<!-- Best Sellers -->
<?php 
require_once('../../config/config.php');

$sql_top_sellers = "SELECT p.*, IFNULL(SUM(od.OrdQuantity), 0) AS TotalOrders FROM product AS p 
LEFT JOIN orderdetail AS od ON p.ProdId = od.ProdId
GROUP BY p.ProdId
ORDER BY TotalOrders DESC
LIMIT 10;";
$result_top_sellers = mysqli_query($connection, $sql_top_sellers);

?>
<div class="best_sellers">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>Best Sellers</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product_slider_container">
						<div class="owl-carousel owl-theme product_slider">
							<!-- Slide 1 -->
							<?php if(mysqli_fetch_assoc($result_top_sellers) > 0) { 
								foreach($result_top_sellers as $row) {
								?>
							<div class="owl-item product_slider_item">
								<div class="product-item">
									<div class="product discount">
										<div class="product_image">
											<img src="../upload/<?=$row["ProdImage"]?>" alt="">
										</div>
										<div class="favorite favorite_left"></div>
										<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span><?=number_format($row["ProdPriceSale"] - $row["ProdPrice"], 0, ",", ".")?></span></div>
										<div class="product_info">
											<h6 class="product_name"><a href="../singleproduct/singleproduct_action.php?ProdId=<?=$row["ProdId"]?>"><?=$row["ProdName"]?></a></h6>
											<div class="product_price"><?=number_format($row["ProdPriceSale"], 0, ",", ".")?><span><?=number_format($row["ProdPrice"], 0, ",", ".")?></span></div>
										</div>
									</div>
								</div>
							</div>
							<?php } }?>
						</div>

						<!-- Slider Navigation -->

						<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>