<div id="layoutSidenav">
	<div id="layoutSidenav_nav">
		<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
			<div class="sb-sidenav-menu">
				<div class="nav">
					<div class="sb-sidenav-menu-heading">Core</div>
					<a class="nav-link" href="../home/index.php">
						<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
						Dashboard
					</a>
					<?php if(checkPrivilege('../user/user_list.php')) { ?>
					<a class="nav-link" href="../user/user_list.php">
						<div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
						Quản lý  thành viên
					</a>
					<?php } ?>
					<?php if(checkPrivilege('../customer/customer_list.php')) { ?>
					<a class="nav-link" href="../customer/customer_list.php">
						<div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
						Quản lý khách hàng
					</a>
					<?php } ?>
					<a class="nav-link" href="../menu/menu_view.php">
						<div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
						Menu
					</a>
					<a class="nav-link" href="../category/mycategory.php">
						<div class="sb-nav-link-icon"><i class="fas fa-cloud"></i></div>
						Danh mục sản phẩm
					</a>
					<a class="nav-link" href="../Product/myProduct.php">
						<div class="sb-nav-link-icon"><i class="fas fa-shirt"></i></div>
						Quản lý sản phẩm
					</a>
					<a class="nav-link" href="../orders/order_list.php">
						<div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
						Orders
					</a>
					<?php if(checkPrivilege('../slider/slider_list.php')) { ?>
					<a class="nav-link" href="../slider/slider_list.php">
						<div class="sb-nav-link-icon"><i class="fas fa-sliders"></i></div>
						Slider
					</a>
					<?php } ?>

				</div>
			</div>
		</nav>
	</div>
</div>