<?php //thuoc tinh = bien = 
		// phuong thuc = ham = hanhdong
require_once 'app/modle/signup_modle.php';
$method = isset($_GET['m']) ? trim($_GET['m']) : "index";

switch ($method) {
	case 'index':
		signupView();
		break;
	case 'register':
		register();
		break;
	case 'active':
		active_member();
		break;
}

function active_member(){
	$idMember = isset($_GET['id']) ? $_GET['id'] : '';
	$authenkey = isset($_GET['au']) ? $_GET['au'] : '';

	$iddecode = decode($idMember);
	$iddecode = is_numeric($iddecode) ? $iddecode : 0;
	$check = get_info_user($iddecode);
	$mess = '';
	if (!empty($check)) {
		if ($authenkey == $check['authen_key']) {
			$today = date("Y-m-d H:i:s");
			$au = decode($authenkey);
			if (strtotime($today) > strtotime($au)) {
				$mess = "Mã kích hoạt hết hạn";
			}
			else{
				if ($check['Trang_thai'] != 1) {
					$active = active_account_user($iddecode);
					if ($active) {
						$mess = 'Kích hoạt thành công bạn có thể đăng nhập vào website';
					}
					else{
						$mess = "Kích hoạt thành công.";
					}
				}
				else{
					$mess = "Tài khoản đã kích hoạt";
				}
			}
		}
		else{
			$mess = "Mã kích hoạt không đúng";
		}
	}
	else{
		$mess = "Mã kích hoạt không đúng";
	}
	 require_once 'app/view/signup/active_signup_view.php';
}

function signupView(){

	$mess = isset($_GET['mess']) ? $_GET['mess'] : '';
	$dialog = ($mess == "success") ? "Đăng ký thành công. Vui lòng vào email kích hoạt tài khoản" : ($mess == "fail" ? "Đăng ký thất bại" : "");
	require_once 'app/view/signup/index_signup_view.php';
}

function register(){
	if (isset($_POST['btnSubmit'])) {
		$username = isset($_POST['txtTenDangNhap']) ? trim($_POST['txtTenDangNhap']) : '';
		$username = strip_tags($username);
		$password = isset($_POST['txtMatKhau']) 	? trim($_POST['txtMatKhau'])     : '';
		$password = strip_tags($password);
		$email 	  = isset($_POST['txtEmail'])       ? trim($_POST['txtEmail'])       : '';
		$email    = strip_tags($email);
		$fullname = isset($_POST['txtHoTen'])       ? trim($_POST['txtHoTen'])       : '';
		$fullname = strip_tags($fullname);
		$address  = isset($_POST['txtAddress'])     ? trim($_POST['txtAddress'])     : '';
		$address  = strip_tags($address);
		$phone    = isset($_POST['txtPhone'])       ? trim($_POST['txtPhone'])       : '';

		$flag = TRUE;
		$checkError = valiDateData($username,$password,$email,$fullname,$address,$phone);
		foreach ($checkError as $key => $error) {
			if (!empty($error)) {
				$flag = FALSE;
				break;
			}
		}

		if ($flag) {
			if (isset($_SESSION['error'])) {
				unset($_SESSION['error']);
			}
			$authenkey = encode(date("Y-m-d H:i:s",strtotime("+3days")));
			$add = add_member_modle($username,md5($password),$email,$fullname,$address,$phone,$authenkey);
			if ($add > 0) {
				$subject = "<h2>Active Your Account</h2>";
				$id   = encode($add);
				$link = "cuahangsach1069.esy.es/bookstore_project/index.php?cn=signup&m=active&id=".$id."&au=".$authenkey;
//				$send = xl_sendmail($email,$subject,$link);
//				if ($send) {
					header("Location: ?cn=signup&m=index&mess=success");
//				}
//				else{
//					header("Location: ?cn=signup&m=index&mess=fail1");
//				}//end send
			}
			else{
				header("Location: ?cn=signup&m=index&mess=fail");
			}//end add
		}
		else{
			$_SESSION['error'] = $checkError;
			header("Location: ?cn=signup&m=index");
		}// end flag
	}
}

function valiDateData($username,$password,$email,$fullname,$address,$phone){
	$errors = array();
	$errors['username'] = (empty($username)) ? "Error Username" : '';
	$errors['password'] = (empty($password) OR strlen($password) < 6) ? "Error password" : '';
	$checkEmail = filter_var($email,FILTER_VALIDATE_EMAIL);
	$errors['email']    = ($checkEmail == FALSE) ? "Error Email" : '';
	$errors['fullname'] = (empty($fullname)) ? "Error fullname"  : '';
	$errors['address']  = (empty($address))  ? "Error address"   : '';
	$errors['phone']    = (empty($phone))    ? "Error Username"  : '';
	$checkPhone = preg_match('/^[0][9]\d{8}$|^[0][1]\d{9}/',$phone);
	$errors['phone']    = ($checkPhone == FALSE) ? "Error Phone" : '';

	return $errors;
}
 ?>