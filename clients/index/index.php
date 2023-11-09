<?php
session_start();
require_once('../../config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Colo Shop</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../assets/styles/bootstrap4/bootstrap.min.css">
<link href="../assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="../assets/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="../assets/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="../assets/styles/responsive.css">
</head>

<body>

<div class="super_container">

	<!-- Header -->
    <?php include_once("../includes/header.php") ?>

	<div class="fs_menu_overlay"></div>
	<?php include_once("../includes/hamburger_menu.php") ?>

	<!-- Slider -->
    <?php # include_once('../includes/message.php') ?>
    <?php include_once("../includes/slider.php") ?>

	<!-- Banner -->
    <?php include_once("../includes/banner.php") ?>

	<!-- New Arrivals -->
    <?php include_once("../includes/new_arrivals.php") ?>

	<!-- Deal of the week -->
    <?php include_once("../includes/deal_of_the_week.php") ?>

	<!-- Best Sellers -->
    <?php include_once("../includes/best_sellers.php") ?>

	<!-- Benefit -->
    <?php include_once("../includes/benefit.php") ?>

	<!-- Blogs -->
    <?php include_once("../includes/blogs.php") ?>

	<!-- Newsletter -->
    <?php include_once("../includes/newsletter.php") ?>
	<!-- Footer -->
    <?php include_once("../includes/footer.php") ?>

</div>

<script src="../assets/js/jquery-3.2.1.min.js"></script>
<script src="../assets/styles/bootstrap4/popper.js"></script>
<script src="../assets/styles/bootstrap4/bootstrap.min.js"></script>
<script src="../assets/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="../assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="../assets/plugins/easing/easing.js"></script>
<script src="../assets/js/custom.js"></script>
<script>
        window.onload = function() {
            openModal("<?php echo $_SESSION['messenger'] ?>");
        }
    </script>
</body>

</html>
