<?php
require_once '../modle/order_modle.php';
$method = isset($_GET['m']) ? $_GET['m'] : 'index';
switch ($method) {
	case 'index':
		order_detail();
		break;
	default:
		# code...
		break;
}

function order_detail(){
	$id  = isset($_GET['id']) ? $_GET['id'] : 0;
	$type  = isset($_GET['type']) ? $_GET['type'] : 0;
	$model = get_order_modle($id, $type);
	if (!isset($model) || empty($model)) {
		require_once '../view/notfound_view.php';
		return false;
	}

	require_once '../view/orders/detail_order.php';
}
 ?>