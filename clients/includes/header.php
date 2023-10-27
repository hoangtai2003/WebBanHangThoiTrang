<!-- Header -->

<header class="header trans_300">

<!-- Top Navigation -->

<div class="top_nav">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="top_nav_left">free shipping on all u.s orders over $50</div>
            </div>
            <div class="col-md-6 text-right">
                <div class="top_nav_right">
                    <ul class="top_nav_menu">

                        <!-- Currency / Language / My Account -->

                        <li class="currency">
                            <a href="#">
                                usd
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="currency_selection">
                                <li><a href="#">cad</a></li>
                                <li><a href="#">aud</a></li>
                                <li><a href="#">eur</a></li>
                                <li><a href="#">gbp</a></li>
                            </ul>
                        </li>
                        <li class="language">
                            <a href="#">
                                English
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="language_selection">
                                <li><a href="#">French</a></li>
                                <li><a href="#">Italian</a></li>
                                <li><a href="#">German</a></li>
                                <li><a href="#">Spanish</a></li>
                            </ul>
                        </li>
                        <li class="account">
                            <a href="#">
                                My Account
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="account_selection">
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
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Navigation -->

<div class="main_nav_container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-right">
                <div class="logo_container">
                    <a href="#">colo<span>shop</span></a>
                </div>
                <nav class="navbar">
                    <ul class="navbar_menu">
                        <li><a href="../index/index.php">home</a></li>
                        <li><a href="../categories/categories.php">shop</a></li>
                        <li><a href="#">promotion</a></li>
                        <li><a href="#">pages</a></li>
                        <li><a href="#">blog</a></li>
                        <li><a href="contact.html">contact</a></li>
                    </ul>
                    <ul class="navbar_user">
                        <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                        <li class="checkout">
                            <a href="../cart/cart_view.php">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="checkout_items" class="checkout_items"></span>
                            </a>
                        </li>
                    </ul>
                    <div class="hamburger_container">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
		$(document).ready(function(e){

			load_cart_item_number();

			function load_cart_item_number(){
				$.ajax({
					url: '../cart/cart_action.php',
					method: 'get',
					data: {cartItem: "cart_item"},
					success:function(response){
						$("#checkout_items").html(response);
					}
				});
			}
		});
	</script>

</header>