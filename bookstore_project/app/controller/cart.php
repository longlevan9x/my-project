<?php 
require_once 'app/modle/home_modle.php';
$method = isset($_GET['m']) ? trim($_GET['m']) : "index";
switch ($method) {
	case 'index':
		showCart();
		break;
	case 'add':
		addCart();
		break;
	case 'remove':
		removeAllCart();
		break;
	case 'delete':
		deleteCart();
		break;
	case 'edit':
		updateCart();
		break;
	case 'orders':
		ordersCustomer();
		break;
	default:

		break;
}

function showCart(){
	$mess = isset($_GET['mess']) ? $_GET['mess'] : '';
	$mess1 = (!empty($mess) && $mess == 'fail') ? "Vui lòng chọn sản phẩm!" : '';
	$mess2 = (!empty($mess) && $mess == 'err') ? "Vui lòng điền thông tin mua hàng!" : '';
	$mess3 = (!empty($mess) && $mess == 'addfail') ? "Có lỗi xảy ra!" : '';
	$mess4 = (!empty($mess) && $mess == 'ok') ? "Đặt hàng thành công! Chúng tôi sẽ liên hệ bạn sớm nhất" : '';
	require_once 'app/view/cart/index_cart_view.php';
}

function ordersCustomer(){
	if (isset($_POST['btnSubmit'])) {
		if (isset($_SESSION['cart']) AND !empty($_SESSION['cart'])) {
			$fullname = isset($_POST['txtHoTen'])       ? $_POST['txtHoTen'] : '';
			$fullname = strip_tags($fullname);
			$phone    = isset($_POST['txtSoDienThoai']) ? $_POST['txtSoDienThoai'] : '';
			$phone    = strip_tags($phone);
			$email    = isset($_POST['txtEmail'])       ? $_POST['txtEmail'] : '';
			$email    = strip_tags($email);
			$address  = isset($_POST['txtDiaChi'])      ? $_POST['txtDiaChi'] : '';
			$address  = strip_tags($address);
			$ghichu   = isset($_POST['txtGhiChu'])      ? $_POST['txtGhiChu'] : '';
			$ghichu   = strip_tags($ghichu);

			$checkData = valiDateData($fullname,$phone,$email,$address);
			$flag = TRUE;
			foreach ($checkData as $key => $err) {
				if (!empty($err)) {
					$flag = FALSE;
					break;
				}
			}

			if ($flag) {
				//insertInfoDb
				$chkAdd = FLASE;
				foreach ($_SESSION['cart'] as $key => $val) {
					$money = ($val['qty'] * $val['cost']);
					$chkAdd = insertOrderCustom($val['idBook'],$fullname,$phone,$email,$address,$ghichu,$val['qty'],$money);
				}

				if ($chkAdd) {
					unset($_SESSION['cart']);
					header("Location: ?cn=cart&m=index&mess=ok");
				}
				else{
					header("Location: ?cn=cart&m=index&mess=addfail");
				}// end checkadd
			}
			else{
				header("Location: ?cn=cart&m=index&mess=err");
			}//end flag
		}
		else{
			header("Location: ?cn=cart&m=index&mess=fail");
		}
	}
}

function valiDateData($fullname,$phone,$email,$address){
	$errors = array();
	$errors['fullname'] = (empty($fullname)) ? "Vui lòng nhập tên": '';
	$checkPhone = "/^[0][9]\d{8}|[0][1]\d{9}$/";
	// $check = (preg_match($checkPhone, $phone) == TRUE) ? TRUE : FALSE;
	// $errors['phone'] = ($check == FALSE) ? "Vui lòng nhập số điện thoại và đúng định dạng": '';
	$errors['phone'] = (preg_match($checkPhone, $phone) == 0) ? "Vui lòng nhập số điện thoại và đúng định dạng": '';
	$checkEmail = filter_var($email,FILTER_VALIDATE_EMAIL);
	$errors['email'] = ($checkEmail = TRUE) ? "" : 'Vui lòng nhập email và đúng định dạng';
	$errors['address'] = (empty($address)) ? "Vui lòng nhập địa chỉ": '';
	return $errors;
}
function updateCart(){
	if (isset($_POST['btnSubmit'])) {
		$qty= isset($_POST['txtSoLuong']) ? $_POST['txtSoLuong'] : array();
		foreach ($qty as $key => $val) {
			if (isset($_SESSION['cart'][$key])) {
				$_SESSION['cart'][$key]['qty'] = $val;
			}
		}
		header("Location: ?cn=cart&m=index");
	}
}
function deleteCart(){
	$idCart = isset($_GET['id']) ? trim($_GET['id']) : 0;
	$idCart = is_numeric($idCart) ? $idCart : 0;
	if (isset($_SESSION['cart'][$idCart]) AND !empty($_SESSION['cart'][$idCart])) {
		unset($_SESSION['cart'][$idCart]);
	}
	header("Location: ?cn=cart&m=index");
}

function removeAllCart(){
	if (isset($_SESSION['cart']) AND !empty($_SESSION['cart'])) {
		unset($_SESSION['cart']);
	}
	header("Location: ?cn=index");
}

function addCart(){
	$idBook = isset($_GET['id']) ? $_GET['id'] : 0;
	$idBook = is_numeric($idBook) ? $idBook : 0;
	$infoBook = getInfoDataBookById($idBook);
	if (!empty($infoBook)) {
		$qty = isset($_POST['txtSoLuong']) ? $_POST['txtSoLuong'] : 1;
		$qty = is_numeric($qty) ? $qty : 1;
		if (isset($_SESSION['cart']) AND !empty($_SESSION['cart']) ) {
			if (isset($_SESSION['cart'][$idBook]) AND $_SESSION['cart'][$idBook]['idBook'] == $idBook) {
				$_SESSION['cart'][$idBook]['qty']  += $qty;
			}
			else{

				$_SESSION['cart'][$idBook]['idBook'] = $infoBook['id'];
				$_SESSION['cart'][$idBook]['nameBook'] = $infoBook['TenSach'];
				$_SESSION['cart'][$idBook]['imgBook']  = $infoBook['HinhAnh'];
				$_SESSION['cart'][$idBook]['cost']  = (!empty($infoBook['GiaMoi'])) ? $infoBook['GiaMoi'] : $infoBook['GiaCu'];
				$_SESSION['cart'][$idBook]['qty']  = $qty;
			}
		}
		else{
			$_SESSION['cart'][$idBook]['idBook'] = $infoBook['id'];
			$_SESSION['cart'][$idBook]['nameBook'] = $infoBook['TenSach'];
			$_SESSION['cart'][$idBook]['imgBook']  = $infoBook['HinhAnh'];
			$_SESSION['cart'][$idBook]['cost']  = ((!empty($infoBook['GiaMoi'])) ? $infoBook['GiaMoi'] : $infoBook['GiaCu']);
			$_SESSION['cart'][$idBook]['qty']  = $qty;
		}
	}
	header("Location: ?cn=cart&m=index");
}
 ?>