<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
				<li class="menu_item has-children">
					<a href="#">
						usd
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<li><a href="#">cad</a></li>
						<li><a href="#">aud</a></li>
						<li><a href="#">eur</a></li>
						<li><a href="#">gbp</a></li>
					</ul>
				</li>
				<li class="menu_item has-children">
					<a href="#">
						English
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<li><a href="#">French</a></li>
						<li><a href="#">Italian</a></li>
						<li><a href="#">German</a></li>
						<li><a href="#">Spanish</a></li>
					</ul>
				</li>
				<li class="menu_item has-children">
					<a href="#">
						My Account
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<?php
							if(isset($_SESSION['cus_loggedin']) && $_SESSION['cus_loggedin'] == true){
								
						?>
							<li><a href="../cart/percharse_order.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đơn mua</a></li>
							<li><a href="../authen/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Sign Out</a></li>
						<?php
							}else{
						?>
							<li><a href="../authen/login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
							<li><a href="../authen/register.php"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
						<?php
							}
						?>
					</ul>
				</li>
				<li class="menu_item"><a href="../index/index.php">home</a></li>
				<li class="menu_item"><a href="../categories/categories.php">shop</a></li>
				<li class="menu_item"><a href="#">promotion</a></li>
				<li class="menu_item"><a href="#">pages</a></li>
				<li class="menu_item"><a href="#">blog</a></li>
				<li class="menu_item"><a href="#">contact</a></li>
			</ul>
		</div>
	</div>