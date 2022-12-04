<?php
    session_start();
    require_once '../db_connection/connection.php';

	$action = $_GET['action'];
	if ($action == 'show') {
		if(!isset($_SESSION['user'])) {
			echo 'Вы не вошли в систему и не можете добавлять товар в корзину!';
			exit;
		}
		if(!(isset($_SESSION['cart']))) {
			echo 'У вас нет заказов';
			exit;
		};
		$cart = $_SESSION['cart'];
		if (count($cart) == 0) {
			echo 'У вас нет заказов';
			exit;
		}

	echo '
	<div class="row">
		<div class="col">
			<div class="cart_info_columns clearfix" id="in-check">
				<div class="cart_info_col cart_info_col_product">Товары</div>
				<div class="cart_info_col cart_info_col_price">Цена</div>
				<div class="cart_info_col cart_info_col_quantity">Количество</div>
				<div class="cart_info_col cart_info_col_total">ID Товара</div>
			</div>
		</div>
	</div>
	';

	for ($i = 0; $i < count($cart); $i++) {
		$idProduct = $cart[$i]["idProduct"];
		$query = "SELECT * FROM `Product` WHERE `idProduct` = '$idProduct'";
		$res = mysqli_query($conn, $query);
		while ($product = $res->fetch_assoc()) {
			echo '
			<div class="row cart_items_row">
				<div class="col">
					<div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
						<div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
							<div class="cart_item_image">
								<div><img src="'.$product["image"].'" alt=""></div>
							</div>
							<div class="cart_item_name_container">
								<div class="cart_item_name"><a href="#">'.$product["title"].'</a></div>
								<div class="cart_item_edit"><a href="#">'.$product["description"].'</a></div>
								<div class="cart_item_edit">
									<input type="button" class="clear_cart_button delete_item" value="Удалить" onclick="delFromCart('.$product["idProduct"].')">
								</div>
							</div>
						</div>
						<div class="cart_item_price">'.$product["price"].' BYN</div>
						<div class="cart_item_quantity">
							<div class="product_quantity_container">
								<div class="product_quantity clearfix">
									<span>Кол-во</span>
									<input id="quantity_input" type="text" pattern="[0-9]*" max="'.$product["instock"].'" value="1" readonly>
									<div class="quantity_buttons">
										<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
										<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
									</div>
								</div>
							</div>
						</div>
						<div class="cart_item_total">'.$product["idProduct"].'</div>
					</div>
				</div>
			</div>
			';
		}
	}
}

if ($action == 'add') {
	$cart = $_SESSION['cart'];
	$id = $_GET['id'];
	$newProduct["idProduct"] = $id;
	$cart[count($cart)] = $newProduct;
	$_SESSION['cart'] = $cart;

	$count = '1';
	$addtodb = "INSERT INTO `PurchaseProduct` (`product_id`, `count`) VALUES ('$id', '$count')";
	$result_add = mysqli_query($conn, $addtodb);
}

if ($action == 'del') {
	$id = $_GET["id"];
	$newCart = array();

	$cart = $_SESSION['cart'];
	for ($i = 0; $i < count($cart); $i++) {
		$idProduct = $cart[$i]["idProduct"];
		if ($id != $idProduct) {
			$newCart[count($newCart)] = $cart[$i];
		}
	}
	$_SESSION['cart'] = $newCart;

	$delfromdb = "DELETE FROM `PurchaseProduct` WHERE `product_id` = '$id' LIMIT 1";
	$result_del = mysqli_query($conn, $delfromdb);
}

if (isset($_POST['delall'])){
	unset($_SESSION['cart']);

	$delallfromdb = "DELETE FROM `PurchaseProduct`";
	$result_delall = mysqli_query($conn, $delallfromdb);
	header("Location: cart.php");
}

?>