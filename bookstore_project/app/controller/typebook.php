<?php 

require_once 'app/modle/typebook_modle.php';

$method = isset($_GET['m']) ? trim($_GET['m']) : 'index';
switch ($method) {
	case 'index':
		getListTypeBook();
		break;
	
	default:
		# code...
		break;
}

function getListTypeBook(){
	$idTypeBook = isset($_GET['id']) ? $_GET['id'] : 0;

	$dataTypeBook = get_list_book_by_page($idTypeBook);
	if (!empty($dataTypeBook)) {
		$data = array();
		foreach ($dataTypeBook as $key => $nameTypebook) {
			$data = $nameTypebook;
		}
		require_once 'app/view/typebook/index_typebook_view.php';
	}
	else{
		require_once 'app/view/errors_view.php';
	}
}
 ?>