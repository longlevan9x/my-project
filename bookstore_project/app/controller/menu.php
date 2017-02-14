<?php 
	require_once 'app/modle/menu_modle.php';

	$method = isset($_GET['m']) ? trim($_GET['m']) : 'index';
	switch ($method) {
		case 'index':
			getDataMenu();
			break;

		default:
			getDataMenu();
			break;
	}

	function getDataMenu(){
		// lấy dữ liệu thể loại sách
		$typeBook = get_all_type_book_modle();
		//  Lấy dữ liệu tác giả
		$author = get_all_author_modle();
		// lấy dữ liệu nhà xuất bản
		$publisher = get_all_publisher_modle();
		require_once 'app/view/partials/menu_right_view.php';
	}
 ?>