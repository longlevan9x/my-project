<?php
require_once '../modle/order_modle.php';
$method = isset($_GET['m']) ? $_GET['m'] : 'index';
switch ($method) {
	case 'index':
		listOrders();
		break;
	case 'update':
		updateOrder();
		break;
	default:
		# code...
		break;
}

function listOrders(){
	$page  = isset($_GET['page']) ? $_GET['page'] : 1;
	$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

	$dataOrder = get_all_order_modle($keyword);

	$link = createLink(BASE_URL,array("sk"=>"orders","m"=>"index","page"=>"{page}","keyword"=>$keyword));

	$dataPaging = paging($link,count($dataOrder),$page,ROW_LIMIT,$keyword);

	$dataAllOrders = get_all_data_orders($dataPaging['st'],$dataPaging['limit'],$dataPaging['keyword']);
	// print_r($dataAllOrders); die();
	require_once '../view/orders/index_orders_view.php';
}

function updateOrder(){
	$id = isset($_POST['id']) ? $_POST['id'] : 0;
	$id = is_numeric($id) ? $id : 0;
	$type = isset($_POST['type']) ? $_POST['type'] : 0;
	$type = (is_numeric($type) && in_array($type,array('1','2'))) ? $type : 0;
	if ($type != 0 && $id != 0) {
		// xu ly update
		if ($type == 1) {
			$update = update_order_modle($id,$type);
			if ($update) {
				$detailOrder = save_detail_order($id);
				if ($detailOrder) {
					echo "ok";
				}
				else{
					echo "err";
				}
			}
			else{
				echo "errorup";
			}
		}
		elseif ($type == 2) { // xu ly delete
			$delete = delete_order_modle($id);
			if ($delete) {
				echo "ok";
			}
			else{
				echo "errdl";
			}
		}
	}
	else{
		echo "err";
	}
}
 ?>