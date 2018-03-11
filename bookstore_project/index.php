<?php
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	require_once 'app/config/constant.php';
	require_once 'app/libs/vn2latin.php'; // để xóa hết đi tiếng việt
	require_once 'app/libs/Myencryptdecrypt.php';
	require_once 'app/libs/sendmail.php';
	require_once 'app/helper/helper.php';
	require_once 'app/helper/common_helper.php';
    require_once 'app/modle/setting_model.php';

$cn = isset($_GET['cn']) ? trim($_GET['cn']) : 'index';
	if ($cn != "signup" AND $cn != "login") {
	require_once 'app/view/partials/header_view.php';
		if ($cn != "cart") {
			require_once 'app/view/partials/banner_view.php';
		}
	}
	switch ($cn) {
		case 'index':
			require_once 'app/controller/home.php';
			break;
		case 'search':
			require_once 'app/controller/search.php';
			break;
		case 'typebook':
			require_once 'app/controller/typebook.php';
			break;
		case 'author':
			require_once 'app/controller/author.php';
			break;
		case 'publisher':
			require_once 'app/controller/publisher.php';
			break;
		case 'signup':
			require_once 'app/controller/signup.php';
			break;
		case 'login':
			require_once 'app/controller/login.php';
			break;
		case 'logout':
			require_once 'app/controller/logout.php';
			break;
		case 'cart':
			require_once 'app/controller/cart.php';
			break;
		default:
			break;
	}

	if ($cn != "signup" AND $cn != "login") {
		if ($cn != "cart") {
			require_once 'app/controller/menu.php';
		}
	require_once 'app/view/partials/footer_view.php';
	}
 ?>