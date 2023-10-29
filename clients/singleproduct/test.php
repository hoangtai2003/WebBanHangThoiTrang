	<!-- <script>

			const thumbnails = document.querySelectorAll(".slick-slide");
			var imageBackground = document.querySelector(".single_product_image_background");
			thumbnails.forEach((thumbnail) => {
				thumbnail.addEventListener("click", function() {
					thumbnails.forEach((t) => t.classList.remove("active"));
					// thumbnails.forEach((t) => t.classList.remove("slick-current"));
					// thumbnail.classList.add("active");
					// thumbnail.classList.add("slick-current");
					const imgElement = thumbnail.querySelector("img");
					const imagePath = imgElement.getAttribute("src");
					imageBackground.style.backgroundImage = `url("${imagePath}"`;
				});
			});
	</script> -->
	<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
	<script>
		// Kích hoạt Slick Slider
		$(document).ready(function() {
			$('.slider').slick({
				autoplaySpeed: 20000,
				infinite: true,
				autoplay: false,
				vertical: true, // Kích hoạt chế độ dọc
				verticalSwiping: true, // Cho phép chuyển trang dọc
				slidesToShow: 3,
				slidesToScroll: 1,
				responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: true,
							autoplay: false,
							autoplaySpeed: 1000,
							infinite: true,
							vertical: false,
							verticalSwiping: false,
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							autoplay: true,
							autoplaySpeed: 1000,
							infinite: true,
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							autoplay: true,
							autoplaySpeed: 1000,
							infinite: true,
						}
					}
				]
			});
		});
	</script> -->