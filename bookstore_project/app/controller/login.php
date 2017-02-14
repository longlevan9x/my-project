<?php
require_once 'app/modle/login_modle.php';
$method = isset($_GET['m']) ? trim($_GET['m']) : "index";
switch ($method) {
	case 'index':
		frmLogin();
		break;
	case 'logins':
		myLogin();
		break;
	default:
		# code...
		break;
}

function frmLogin(){
	// if (isset($_SESSION['error1'],$_SESSION['error'])) {
	// 	unset($_SESSION["error"]);
	// 	unset($_SESSION["error1"]);
	// }
	require_once 'app/view/login/index_login_view.php';
}

function validateLogin($username,$password){
	$error = array();
	$error['username'] = (empty($username)) ? "Nhập tên tk" : '';
	$error['password'] = (empty($password) OR strlen($password) < 8) ? "Nhập mật khẩu và lớn hơn 8 ký tự" : '';
	return $error;
}
function myLogin(){
	if (isset($_POST['btnSubmit'])) {
		$username = isset($_POST['txtTenDangNhap']) ? trim($_POST['txtTenDangNhap']) : '';
		$username = strip_tags($username);
		$password = isset($_POST['txtMatKhau']) ? trim($_POST['txtMatKhau']) : '';
		$password = strip_tags($password);

		$flag = TRUE;
		$check = validateLogin($username,$password);
		foreach ($check as $key => $val) {
			if (!empty($val)) {
				$flag = FALSE;
				break;
			}
		}

		if ($flag) {
			if (isset($_SESSION['error'])) {
				unset($_SESSION["error"]);
			}
			$chLogin = checkLoginUser($username,md5($password));
			if (!empty($chLogin)) {
				$_SESSION['username'] = $chLogin['TenDangNhap'];
				$_SESSION['email']    = $chLogin['Email'];
				$_SESSION['phone']    = $chLogin['SDT'];
				$_SESSION['address']  = $chLogin['DiaChi'];
				$_SESSION['fullname'] = $chLogin['TenHienThi'];
				
				unset($_SESSION["error1"]);
				header("Location: ?cn=index");
			}
			else{
				$_SESSION['error1'] = 'Tài khoản hoặc mật khẩu không tồn tại';
				header("Location: ?cn=login&m=index");
			}
		}
		else{
			$_SESSION['error'] = $check;
			header("Location: ?cn=login&m=index");
		}
	}
}
 ?>
