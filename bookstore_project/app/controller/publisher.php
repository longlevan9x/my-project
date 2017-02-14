<?php
require_once 'app/modle/publisher_modle.php';

$method = isset($_GET['m']) ? trim($_GET['m']) : "index";
switch ($method) {
	case 'index':
		getListPublisher();
		break;

	default:
		# code...
		break;
}

function getListPublisher(){
	$idPublish = isset($_GET['id']) ? trim($_GET['id']) : '';
	$dataPublisher = get_list_publisher_by_page($idPublish);
	if (empty($dataPublisher)) {
		require_once 'app/view/errors_view.php';
	}
	else{
		$data = array();
		foreach ($dataPublisher as $key => $value) {
			$data = $value;
		}
		require_once 'app/view/publisher/index_publisher_view.php';
	}
}
 ?>