
<?php
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	// require_once '../modle/checkLoginSession_modle.php';
	// nơi điều hướng.
	require_once '../config/constant.php';// file đường dẫn hình ảnh
	require_once '../helper/helper.php';
	checkLoginAdmin();

	require_once '../libs/thirdparty/FlashMessages.php';

	$cn = isset($_GET['sk']) ? $_GET['sk'] : 'index';
	// kiem tra neu khong phai ajax thi moi load header va sidebar
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
		require_once '../view/partials/header_view.php';
		require_once '../view/partials/aside_view.php';
	}
	switch ($cn) {
		case 'home':
			require_once '../view/home_view.php';
			break;
		case 'book':
			require_once 'book.php';
			break;
		case 'publisher':
			require_once 'publisher.php';
			break;
		case 'kindbook':
			require_once 'kindbook.php';
			break;
		case 'author':
			require_once 'author.php';
			break;
		case 'orders':
			require_once 'orders.php';
			break;
		case 'detailOders':
			require_once 'orders.php';
			break;
		case 'members':
			require_once 'members.php';
			break;
		case 'index':
			require_once '../view/home_view.php';
			break;
	}
	// kiem tra xem request la ajax thi khong load footer
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
		require_once '../view/partials/footer_view.php';
	}
?>