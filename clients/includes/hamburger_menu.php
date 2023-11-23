<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
			<?php
                if(isset($_SESSION['cus_loggedin']) && $_SESSION['cus_loggedin'] == true){
					?>
					<li class="menu_item has-children">
						<a href="#">
							Mệnh giá
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="menu_selection">
							<li><a href="#">VNĐ VNĐ</a></li>
							<li><a href="#">$ USD</a></li>
						</ul>
					</li>
					<li class="menu_item has-children">
						<a href="#">
                            Ngôn ngữ
                            <i class="fa fa-angle-down"></i>
						</a>
						<ul class="menu_selection">
							<li><a href="#">Tiếng Việt</a></li>
							<li><a href="#">English</a></li>
						</ul>
					</li>
					<?php
						if (isset($_SESSION['cusid'])){
							$cusid = $_SESSION['cusid'];
							$sql = "select * from customer where CusId = '$cusid'";
							$result = mysqli_query($connection, $sql);
							if(mysqli_num_rows($result) > 0){
								$row = mysqli_fetch_assoc($result);
							}
						}        
					?>
					<style>
						.account_img{
							width: 22px;
							height: 22px;
							border-radius: 50%;
							margin-bottom: -3px;
							margin-right: 10px;
						}
					</style>
					<li class="menu_item has-children">
						<a href="#">
							<?php
								if($row['ChangeImage'] == 1){
									?>
										<img class="account_img" src="../upload/<?= $row['CusImage']?>">
									<?php
								} else {
									?>
										<img class="account_img" src="<?= $row['CusImage']?>">
									<?php
								}
							?>
								<?= $row['CusUserName']?>
						</a>
						<ul class="menu_selection">
							<?php
								if(isset($_SESSION['cus_loggedin']) && $_SESSION['cus_loggedin'] == true){
							?>
								<li><a href="../information/profile.php"><i class="fa fa-user"></i>Tài khoản</a></li>  
								<li><a href="../cart/percharse_order.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đơn mua</a></li>
								<li><a href="../authen/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Sign Out</a></li>
							<?php    
								}
							?>
						</ul>
					</li>
					<?php
						}else{
					?>
					<li class="menu_item has-children">
						<a href="#">
							Mệnh giá
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="currency_selection">
							<li><a href="#">VNĐ VNĐ</a></li>
							<li><a href="#">$ USD</a></li>
						</ul>
					</li>
					<li class="menu_item has-children">
						<a href="#">
                            Ngôn ngữ
                            <i class="fa fa-angle-down"></i>
						</a>
						<ul class="language_selection">
							<li><a href="#">Tiếng Việt</a></li>
							<li><a href="#">English</a></li>
						</ul>
					</li>
					<li class="menu_item has-children">
						<a href="../authen/register.php">Register</a>
					</li>
					<li class="menu_item has-children">
						<a href="../authen/login.php">Sign in</a>
					</li>
					<?php
						}
					?>
                    <?php
						$result= mysqli_query($connection, "select * from menu ");
						while ($row = mysqli_fetch_assoc($result)){ 
					?>
						<li class="menu_item"><a href="<?= $row["MenuLink"]?>"><?= $row["MenuName"]; ?> </a></li>
					<?php
						}
                    ?>
			</ul>
		</div>
	</div>