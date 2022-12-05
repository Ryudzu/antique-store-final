<?php
    session_start();
    require_once '../db_connection/connection.php';

	$action = $_POST['action'];
	if ($action == 'show') {
		if(!isset($_SESSION['user'])) {
			echo 'Вы не вошли в систему и не можете оформлять заказы!';
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
    <div class="order_list_container" id="in-order">
        <div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
		    <div class="order_list_title">Товар</div>
		    <div class="order_list_value ml-auto">Итого</div>
	    </div>
    </div>
	';

	for ($i = 0; $i < count($cart); $i++) {
		$idProduct = $cart[$i]["idProduct"];
		$query = "SELECT * FROM `Product` WHERE `idProduct` = '$idProduct'";
		$res = mysqli_query($conn, $query);
		while ($product = $res->fetch_assoc()) {
			echo '
            <div class="order_list_container" id="in-order">
                <ul class="order_list">
                    <li class="d-flex flex-row align-items-center justify-content-start">
                        <div class="order_list_title">'.$product["title"].'</div>
                        <div class="order_list_value ml-auto">'.$product["price"].' BYN</div>
                    </li>
                </ul>
            </div>
			';
		}
	}
}

if(isset($_POST['submit'])) {
	if(isset($_SESSION['user'])) {
		$total = 0;
		$orderDate = date('Y-m-d');
		$username = $_POST["checkout_username"];
		$address = $_POST["checkout_address"];
		$email = $_POST["checkout_email"];
		$comment = $_POST["checkout_comment"];
	
		$sql_user = mysqli_query($conn, "SELECT `idUser` FROM `User` WHERE `username` = '$username'");
		$user_sort = mysqli_fetch_assoc($sql_user);
		$user_id = array_values($user_sort)[0];
	
		$sql_product = mysqli_query($conn, "SELECT `product_id` FROM `PurchaseProduct`");
		$product_sort = mysqli_fetch_assoc($sql_product);
		$product_id = array_values($product_sort)[0];

		$get_order = "INSERT INTO `Order` (`user_id`, `comment`, `date`, `product_order_id`, `customer_username`, `contact_email`, `delivery_address`)
		VALUES
		('$user_id', '$comment', '$orderDate', '$product_id', '$username', '$email', '$address')";
		$order = mysqli_query($conn, $get_order);

		if ($order) {
			$_SESSION['order'] = 'Ваш заказ был успешно сделан и находится в обработке!';
			header('Location: order.php');
		} else {
			$_SESSION['order_fail'] = 'Упс, произошла ошибка!';
			header('Location: order.php');
		}
	} else {
		$_SESSION['order_err'] = 'Необходимо войти в систему!';
		header('Location: order.php');
	}
}
?>