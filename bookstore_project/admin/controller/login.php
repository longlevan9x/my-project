<?php
// session_start(); không cần nữa

function validateData($username,$password){
	$errors  = array();
	$errors['username'] = (empty($username) or strlen($username) < 3) ? "Không được để trống và username > 3 ký tự" : '';
	$errors['password'] = (empty($password) or strlen($password) < 4) ? "Không được để trống và password > 6 ký tự" : '';
	return $errors;
}

if (isset($_POST['btnSubmit'])) {
    $username = isset($_POST['txtTenDangNhap']) ? trim($_POST['txtTenDangNhap']) : '';
    $username = strip_tags($username);
    $password = isset($_POST['txtMatKhau'])     ? trim($_POST['txtMatKhau'])     : '';
    $password = strip_tags($password);

    $checkData = validateData($username,$password);
    //print_r($checkData);
    $Flag = TRUE;
    foreach ($checkData as $key => $val) {
    	if (!empty($val)) {
    		$Flag = FALSE;
    		break;
    	}
    }

    if ($Flag) {
		$login = checklogin_modle($username,md5($password));
		if (!empty($login)) {
			$_SESSION['username']   = $login['username'];
			$_SESSION['email']      = $login['email'];
			$_SESSION['role_admin'] = $login['role_admin'];
			$_SESSION['status']     = $login['status'];
			header("Location: controller/home.php");
		}
		else{
			$mess = "username hoặc password không tồn tại";
		}
    }
}

 ?>
