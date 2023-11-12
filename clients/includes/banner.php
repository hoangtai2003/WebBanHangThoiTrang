<!-- Banner -->
<?php
require_once('../../config/config.php');
$sqlCategory = "select * from categories";
$resultCate = mysqli_query($connection, $sqlCategory);
// $dataCate = mysqli_fetch_array($resultCate);


?>
<div class="banner">
		<div class="container">
			<div class="row">
				<?php
			if ( mysqli_fetch_array($resultCate) > 0) {
                                foreach ($resultCate as $row) {
                            ?>
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(../assets/images/<?php echo $row["CateImage"] ?>)">
						<div class="banner_category">
							<a href="../categories/categories_viewhome.php?CateId=<?=$row["CateId"]?>"><?=$row["CateName"]?></a>
						</div>
					</div>
				</div>
				<?php }} ?>
			</div>
		</div>
	</div>