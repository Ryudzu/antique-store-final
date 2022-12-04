<?php
    session_start();
    require_once './db_connection/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Antique store</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Sublime project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./styles/bootstrap4/bootstrap.min.css">
	<link href="./plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="./plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="./plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="./plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="./styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="./styles/responsive.css">
	<script src="./js/jquery-3.2.1.min.js"></script>
	<script src="./js/cart.js"></script>
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo"><a href="#">Antique store</a></div>
							<nav class="main_nav">
								<ul>
									<li class="hassubs active">
										<a href="index.php">Главная</a>
										<ul>
											<li><a href="#down">Товары</a></li>
											<li><a href="./pages/cart.php">Корзина</a></li>
											<li><a href="./pages/order.php">Оплата</a></li>
											<li><a href="./pages/contact.php">Контакты</a></li>
										</ul>
									</li>

									<?php
										$show_categories = mysqli_query($conn, "SELECT * FROM `Category`");

										$categories = array();
						
										while ($category_info = mysqli_fetch_array($show_categories, MYSQLI_ASSOC)) {
											$categories[] = $category_info;
										}
									?>
									<li class="hassubs">
										<a href="#">Категории</a>
										<ul>
											<li><a href="./pages/categories_1.php">Сервиз</a></li>
											<li><a href="./pages/categories_2.php">Часы</a></li>
											<li><a href="./pages/categories_3.php">Лампы</a></li>
											<li><a href="./pages/categories_4.php">Шкатулки</a></li>
										</ul>
									</li>
									<li><a href="./user_auth/register.php">Регистрация</a></li>
									<?php if(isset($_SESSION['user'])): ?>
										<li><a href="./user_auth/logout.php">Выход</a></li>
									<?php else: ?>
										<li><a href="./user_auth/login.php">Вход</a></li>
									<?php endif; ?>
									<li><a href="./pages/contact.php">Контакты</a></li>
								</ul>
							</nav>
							<div class="header_extra ml-auto">
								<div class="shopping_cart">
									<a href="./pages/cart.php">
										<?php
											$show_cart = mysqli_query($conn, "SELECT * FROM `PurchaseProduct`");
										?>
										<div>Корзина <span>(<?=mysqli_num_rows($show_cart)?>)</span></div>
									</a>
								</div>
								<div class="search">
									<div class="search_icon">
										<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										viewBox="0 0 475.084 475.084" style="enable-background:new 0 0 475.084 475.084;"
										 xml:space="preserve">
										<g>
											<path d="M464.524,412.846l-97.929-97.925c23.6-34.068,35.406-72.047,35.406-113.917c0-27.218-5.284-53.249-15.852-78.087
												c-10.561-24.842-24.838-46.254-42.825-64.241c-17.987-17.987-39.396-32.264-64.233-42.826
												C254.246,5.285,228.217,0.003,200.999,0.003c-27.216,0-53.247,5.282-78.085,15.847C98.072,26.412,76.66,40.689,58.673,58.676
												c-17.989,17.987-32.264,39.403-42.827,64.241C5.282,147.758,0,173.786,0,201.004c0,27.216,5.282,53.238,15.846,78.083
												c10.562,24.838,24.838,46.247,42.827,64.234c17.987,17.993,39.403,32.264,64.241,42.832c24.841,10.563,50.869,15.844,78.085,15.844
												c41.879,0,79.852-11.807,113.922-35.405l97.929,97.641c6.852,7.231,15.406,10.849,25.693,10.849
												c9.897,0,18.467-3.617,25.694-10.849c7.23-7.23,10.848-15.796,10.848-25.693C475.088,428.458,471.567,419.889,464.524,412.846z
												 M291.363,291.358c-25.029,25.033-55.148,37.549-90.364,37.549c-35.21,0-65.329-12.519-90.36-37.549
												c-25.031-25.029-37.546-55.144-37.546-90.36c0-35.21,12.518-65.334,37.546-90.36c25.026-25.032,55.15-37.546,90.36-37.546
												c35.212,0,65.331,12.519,90.364,37.546c25.033,25.026,37.548,55.15,37.548,90.36C328.911,236.214,316.392,266.329,291.363,291.358z
												"/>
										</g>
									</svg>
									</div>
								</div>
								<div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Search Panel -->
		<div class="search_panel trans_300">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="search_panel_content d-flex flex-row align-items-center justify-content-end">
							<form action="#">
								<input type="text" class="search_input" placeholder="Поиск" required="required">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Social -->
		<div class="header_social">
			<ul>
				<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu menu_mm trans_300">
		<div class="menu_container menu_mm">
			<div class="page_menu_content">
							
				<div class="page_menu_search menu_mm">
					<form action="#">
						<input type="search" required="required" class="page_menu_search_input menu_mm" placeholder="Search for products...">
					</form>
				</div>
				<ul class="page_menu_nav menu_mm">
					<li class="page_menu_item has-children menu_mm">
						<a href="index.php">Главная<i class="fa fa-angle-down"></i></a>
						<ul class="page_menu_selection menu_mm">
							<li class="page_menu_item menu_mm"><a href="./pages/product.php">Товары<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="./pages/cart.php">Корзина<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="./pages/order.php">Оплата<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="./pages/contact.php">Контакты<i class="fa fa-angle-down"></i></a></li>
						</ul>
					</li>
					<li class="page_menu_item has-children menu_mm">
						<a href="#">Категории<i class="fa fa-angle-down"></i></a>
						<ul class="page_menu_selection menu_mm">
							<li class="page_menu_item menu_mm"><a href="./pages/categories_1.php">Сервиз<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="./pages/categories_2.php">Часы<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="./pages/categories_3.php">Лампы<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="./pages/categories_4.php">Шкатулки<i class="fa fa-angle-down"></i></a></li>
						</ul>
					</li>
					<li class="page_menu_item menu_mm"><a href="index.php">Другое<i class="fa fa-angle-down"></i></a></li>
					<li class="page_menu_item menu_mm"><a href="#">Пожелания<i class="fa fa-angle-down"></i></a></li>
					<li class="page_menu_item menu_mm"><a href="./pages/contact.php">Контакты<i class="fa fa-angle-down"></i></a></li>
				</ul>
			</div>
		</div>

		<div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>

		<div class="menu_social">
			<ul>
				<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="home_slider_container">
			
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme home_slider">
				
				<!-- Slider Item -->
				<div class="owl-item home_slider_item">
					<div class="home_slider_background" style="background-image:url(./images/home_slider_1.jpg)"></div>
					<div class="home_slider_content_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
										<div class="home_slider_title">Новый магазин антиквариата.</div>
										<div class="home_slider_subtitle">Антиквариат в целом — это старые или редкие художественные произведения или другие ценные вещи, которые являются объектами коллекционирования и торговли.</div>
										<div class="button button_light home_button"><a href="#">К покупкам</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Slider Item -->
				<div class="owl-item home_slider_item">
					<div class="home_slider_background" style="background-image:url(./images/home_slider_2.jpg)"></div>
					<div class="home_slider_content_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
										<div class="home_slider_title">Новый магазин антиквариата.</div>
										<div class="home_slider_subtitle">Антиквариат в целом — это старые или редкие художественные произведения или другие ценные вещи, которые являются объектами коллекционирования и торговли.</div>
										<div class="button button_light home_button"><a href="#">К покупкам</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Slider Item -->
				<div class="owl-item home_slider_item">
					<div class="home_slider_background" style="background-image:url(./images/home_slider_3.jpg)"></div>
					<div class="home_slider_content_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
										<div class="home_slider_title">Новый магазин антиквариата.</div>
										<div class="home_slider_subtitle">Антиквариат в целом — это старые или редкие художественные произведения или другие ценные вещи, которые являются объектами коллекционирования и торговли.</div>
										<div class="button button_light home_button"><a href="#">К покупкам</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<!-- Home Slider Dots -->
			
			<div class="home_slider_dots_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_slider_dots">
								<ul id="home_slider_custom_dots" class="home_slider_custom_dots">
									<li class="home_slider_custom_dot active">01.</li>
									<li class="home_slider_custom_dot">02.</li>
									<li class="home_slider_custom_dot">03.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>	
			</div>

		</div>
	</div>

	<!-- Ads -->

	<div class="avds">
		<div class="avds_container d-flex flex-lg-row flex-column align-items-start justify-content-between">
			<div class="avds_small">
				<div class="avds_background" style="background-image:url(./images/avds_small.jpg)"></div>
				<div class="avds_small_inner">
					<div class="avds_discount_container">
						<img src="../images/discount.png" alt="">
						<div>
							<div class="avds_discount">
								<div>20<span>%</span></div>
								<div>Скидка</div>
							</div>
						</div>
					</div>
					<div class="avds_small_content">
						<div class="avds_title">Лазуритовая шкатулка</div>
						<div class="avds_link"><a href="./pages/categories_4.php">Узнать подробнее</a></div>
					</div>
				</div>
			</div>
			<div class="avds_large">
				<div class="avds_background" style="background-image:url(./images/avds_large.jpg)"></div>
				<div class="avds_large_container">
					<div class="avds_large_content">
						<div class="avds_title">Антикварные часы</div>
						<div class="avds_text">Часовые механизмы, отмеряющие минуты и секунды нашей жизни… В них есть что-то мистическое и одновременно с этим притягательное. Сделать такое редкое приобретение – это большая удача для коллекционера, которая еще долго будет согревать его душу.</div>
						<div class="avds_link avds_link_large"><a href="./pages/categories_2.php">Узнать подробнее</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Products -->
	<a id="down"></a>
	<div class="products">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="product_grid">
						<!-- Product Show -->
						<?php
							$show_products = mysqli_query($conn, "SELECT * FROM `Product`");

							$products = array();
						
							while ($product_info = mysqli_fetch_array($show_products, MYSQLI_ASSOC)) {
								$products[] = $product_info;
							}
						?>

						<?foreach($products as $product):?>
							<div class="product" name="product_id" data-id="<?=$product['idProduct']?>">
								<div class="product_image"><img src="<?=$product['image']?>" alt=""></div>
								<div class="product_content">
									<div class="product_title"><a href="product.html"><?=$product['title']?></a></div>
									<div class="product_price"><?=$product['price']?> BYN</div>
									<div class="product_instock">В наличии: <?=$product['instock']?></div>
									<div>
									<?php if(isset($_SESSION['user'])): ?>
										<input type="button" class="product_buy" value="В корзину" onclick="addToCart(<?=$product['idProduct']?>)">
									<?php endif; ?>
									</div>
								</div>
							</div>
						<?endforeach?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Ad -->

	<div class="avds_xl">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="avds_xl_container clearfix">
						<div class="avds_xl_background" style="background-image:url(./images/avds_xl.jpg)"></div>
						<div class="avds_xl_content">
							<div class="avds_title">Отличные товары</div>
							<div class="avds_text">Большой ассортимент, низкие цены и все это в Antique store!</div>
							<div class="avds_link avds_xl_link"><a href="./pages/categories_1.php">Узнать подробнее</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Icon Boxes -->

	<div class="icon_boxes">
		<div class="container">
			<div class="row icon_box_row">
				
				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="./images/icon_1.svg" alt=""></div>
						<div class="icon_box_title">Доставка по всему миру</div>
						<div class="icon_box_text">
							<p>Лучший интернет-магазин, предоставляющий доставку по всему земному шару!</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="./images/icon_2.svg" alt=""></div>
						<div class="icon_box_title">Бесплатные возвраты</div>
						<div class="icon_box_text">
							<p>Не понравился товар? Мы вернем вам деньги!</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="./images/icon_3.svg" alt=""></div>
						<div class="icon_box_title">Онлайн поддержка 24/7</div>
						<div class="icon_box_text">
							<p>Круглосуточная поддержка в реальном времени поможет с любым вашим вопросом!</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_border"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="newsletter_content text-center">
						<div class="newsletter_title">Подпишитесь на нашу новостную рассылку</div>
						<div class="newsletter_text"><p>Вы сможете получать свежие новости о нашем интернет-магазине и многом другом!</p></div>
						<div class="newsletter_form_container">
							<form action="#" id="newsletter_form" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required">
								<button class="newsletter_button trans_200"><span>Подписаться</span></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	
	<div class="footer_overlay"></div>
	<footer class="footer">
		<div class="footer_background"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="footer_content d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
						<div class="footer_logo"><a href="#">Antique store</a></div>
						<div class="copyright ml-auto mr-auto"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> Все права защищены | Сайт создан <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Благиных Владимир</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
						<div class="footer_social ml-lg-auto">
							<ul>
								<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="./styles/bootstrap4/popper.js"></script>
<script src="./styles/bootstrap4/bootstrap.min.js"></script>
<script src="./plugins/greensock/TweenMax.min.js"></script>
<script src="./plugins/greensock/TimelineMax.min.js"></script>
<script src="./plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="./plugins/greensock/animation.gsap.min.js"></script>
<script src="./plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="./plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="./plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="./plugins/easing/easing.js"></script>
<script src="./plugins/parallax-js-master/parallax.min.js"></script>
<script src="./js/custom.js"></script>
</body>
</html>