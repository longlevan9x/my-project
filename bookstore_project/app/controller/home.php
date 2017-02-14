<?php 
	require_once 'app/modle/home_modle.php';
	$method = isset($_GET['m']) ? trim($_GET['m']) : 'index';
	switch ($method) {
		case 'index':
			listAllBook();
			break;
		case 'detail':
			detailBook();
			break;
		case 'Sach_theo_gia':
			listPriceBook();
			break;
		default:
			listAllBook();
			break;
	}

	function listAllBook(){
		$page    = isset($_GET['page']) ? trim($_GET['page']) : '';
		$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
		$dataBook = get_list_all_book_modle();
		// tao link
		$link = createLink(BASE_URL,array("cn"=>"index","m"=>"index","page"=>"{page}","keyword"=>$keyword));
		// phan trang
		$dataPaging = paging($link,count($dataBook),$page,ROW_LIMIT,$keyword);
		//
		$dataAllBook = get_all_data_book_by_page($dataPaging['start'],$dataPaging['limit'],$dataPaging['keyword']);
		require_once 'app/view/home/index_view.php';
	}

	function detailBook(){
		$idString = isset($_GET['name']) ? $_GET['name'] : "";
		$arrString = explode("-",$idString); // chuyển chuỗi thành mảng thông qua dấu -
		$id = end($arrString);// lấy id ở cuối ,. Hàm trong file libs
		$id = is_numeric($id) ? $id : 0;
		$infoData = getInfoDataBookById($id);
		if (!empty($infoData)) {
			$dataTypeBook = getTypeBook($infoData['id_loai'],$id);
			
			$updateView = update_view_modle($id,$infoData['SoLuotXem']);
			require_once 'app/view/home/detail_home_view.php';
		}
		else{
			require_once 'app/view/errors_view.php';
		}
	}

	function listPriceBook(){
		$id = isset($_GET['id']) ? trim($_GET['id']) : 0;
		if ($id == 1) {
			$priceBookLess500 = get_list_book_less_500_modle();
			require_once 'app/view/home/index_price_500_view.php';
		}
		elseif ($id == 2) {
			$priceBookLess1000 = get_list_book_L1000_modle();
			require_once 'app/view/home/index_price_L1000_view.php';
		}
		elseif ($id == 3) {
			$priceBookThan1000 = get_list_book_T1000_modle();
			require_once 'app/view/home/index_price_T1000_view.php';
		}
		else{
			require_once 'app/view/errors_view.php';
		}
	}
 ?>