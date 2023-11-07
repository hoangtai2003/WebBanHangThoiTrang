<!-- Header -->
<?php
include("../../config/config.php"); 
?>
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
                        <?php
                            if(isset($_SESSION['cus_loggedin']) && $_SESSION['cus_loggedin'] == true){
                        ?>
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
                        <li class="account">
                            <a href="#"><img class="account_img" src="../upload/<?= $row['CusImage']?>">
                                <?= $row['CusUserName']?>
                            </a>
                            <ul class="account_selection">
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
                        <li class="account" style="border-right: solid 1px #33333b;padding-right: 21px;">
                            <a href="../authen/register.php">Register</a>
                        </li>
                        <li class="account">
                            <a href="../authen/login.php">Sign in</a>
                        </li>
                        <?php
                            }
                        ?>
                        <!-- Currency / Language / My Account -->

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
                        <?php include("../../config/config.php")?>
                    <?php
                            $result= $connection->query("select * from menu ");
                            while ($row = $result->fetch_assoc()){ 
                        ?>
                        <li><a href="<?php echo $row["MenuLink"]?>"><?php echo $row["MenuName"]; ?> </a></li>
                        <?php
                            }
                            ?>
                    </ul>
                    <ul class="navbar_user">
                        <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
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