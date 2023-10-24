<?php 
	session_start();
	include_once('../../config/config.php');
?>
<?php
	$sql= "select * from sliders order by slid desc ";
	$result = mysqli_query($connection, $sql);
	$connection->close();
	if(mysqli_num_rows($result) > 0){
		foreach($result as $row){
			?>
				<div class="main_slider" style="background-image:url(./../../images/<?=$row['slimage']?>)">
						<div class="container fill_height">
							<div class="row align-items-center fill_height">
								<div class="col">
									<div class="main_slider_content">
										<h6><?= $row['slname']?></h6>
										<h1><?= $row['sldescription']?></h1>
										<div class="red_button shop_now_button"><a href="#">shop now</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
			<?php
		}
	}
?>