<?php 
	require_once 'app/modle/search_modle.php';
	$method = isset($_GET['m']) ? trim($_GET['m']) : "index";
	switch ($method) {
		case 'index':
			listDataSearch();
			break;

		default:

			break;
	}

	function listDataSearch(){
		$page = isset($_GET['page']) ? trim($_GET['page']) : '';
		$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

		$dataSearch = get_data_book_by_keyword($keyword);

		$link = createLink(BASE_URL,array("cn"=>"search","m"=>"index","page"=>"{page}","keyword"=>$keyword));

		$dataPaging = paging($link,count($dataSearch),$page,ROW_LIMIT,$keyword);

		$dataAllSearch = get_data_book_by_page($dataPaging['start'],$dataPaging['limit'],$dataPaging['keyword']);
		require_once 'app/view/search/index_search_view.php';
	}
 ?>