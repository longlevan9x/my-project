<?php 
	require_once 'app/modle/author_modle.php';

	$method = isset($_GET['m']) ? trim($_GET['m']) : "index";
	switch ($method) {
		case 'index':
			getListAuthor();
			break;

		default:
			# code...
			break;
	}

	function getListAuthor(){
		$idAuthor = isset($_GET['id']) ? trim($_GET['id']) : '';
		$dataAuthor = get_list_author_by_page($idAuthor);
		if (empty($dataAuthor)) {
			require_once 'app/view/errors_view.php';
		}
		else{
			$data = array();
			foreach ($dataAuthor as $key => $value) {
				$data = $value;
			}
			require_once 'app/view/author/index_author_view.php';
		}
	}
 ?>