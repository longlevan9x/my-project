<?php
// 1 lấy ra tổng số dòng dữ liệu
// 2 tính tổng số trang ceil(tổng trang /limit)
// 3 tính start = page1 - 1 * limit
	require_once '../modle/publisher_modle.php';
	$method = isset($_GET['m']) ? $_GET['m'] : 'index'; //  điều hướng đến các trang giao diện ở thư mục publisher
	switch ($method) {
		case 'index':
			listAllPublisher();
			break;
		case 'add':
			addPublisher();
			break;
		case 'edit':
			editPublisher();
			break;
		case 'delete':
			deletePublisher();
			break;
		default:
			listAllPublisher();
		break;
	}


	// xóa data publisher
	function deletePublisher(){
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		$idPb = isset($_GET['id']) ? $_GET['id'] : '';
		$idPb = is_numeric($idPb) ? $idPb : 0;
		$dataInfo = getDataInfoPublisher($idPb);
		if (empty($dataInfo)) {
			require_once '../view/notfound_view.php';
		}
		else{
			$delete = deleteDataPublisher_modle($idPb);
			if ($delete) {
				$msg->info("Xóa thành công.");
				header("Location: home.php?sk=publisher");
			}
			else{
				$msg->error("Đã hủy xóa.");
				header("Location: home.php?sk=publisher&m=index");
			}
		}

	}

	// kiểm tra update publisher
	function editPublisher(){
		$idPb = isset($_GET['id']) ? $_GET['id'] : 0;
		$dataInfo = getDataInfoPublisher($idPb);
		if (empty($dataInfo)) {
			require_once '../view/notfound_view.php';
		}
		else{
			$msg = new \Plasticbrain\FlashMessages\FlashMessages();
			require_once '../view/publisher/editPublisher_view.php';
			if (isset($_POST['btnSubmitEdit'])) {
				$namePublish    = isset($_POST['txtName'])    ? $_POST['txtName']    : "";
				$namePublish    = strip_tags($namePublish);
				$nameHidden     = isset($_POST['hddNametb'])  ?  $_POST['hddNametb'] : "";
				$nameHidden     = strip_tags($nameHidden);
				$phonePublish   = isset($_POST['txtPhone'])   ? $_POST['txtPhone']   : '';
				$phonePublish   = strip_tags($phonePublish);
				$addressPublish = isset($_POST['txtAddress']) ? $_POST['txtAddress'] : "";
				$addressPublish = strip_tags($addressPublish);
				$hddLogo = isset($_POST['hddFile']) ? $_POST['hddFile'] : '';
				$hddLogo = strip_tags($hddLogo);

				$logo = "";
				$type = 1 ;

				if (isset($_FILES['txtFileLogo'])) {
					$logo = uploadFiles($_FILES,$type);
				}
				$strLogo = empty($logo) ? $hddLogo : $logo;

				$flag = TRUE;
				$checkError = validateData($namePublish,$phonePublish,$addressPublish,$strLogo);
				foreach ($checkError as $key => $err) {
					if (!empty($err)) {
						$flag = FALSE;
						break;
					}
				}

				if ($flag) {
					if ($namePublish == $nameHidden) { // trường hợp tên ẩn và tên sửa giống nhau
						$update = editDataPublisher($idPb,$namePublish,$phonePublish,$addressPublish,$strLogo);
						if ($update) {
							$msg->success("Sửa thành công");
							header("Location: home.php?sk=publisher&m=index");
						}
					}
					else{
						$checkNamePublish = checkName($namePublish); // check tên gửi lên và tên hiện tại giống nhau
						if ($checkNamePublish) {
							$update = editDataPublisher($idPb,$namePublish,$phonePublish,$addressPublish,$strLogo);
							if ($update) {
							$msg->success("Sửa thành công tên mới.");
							header("Location: home.php?sk=publisher&m=index");
							}
						}
						else{
							$msg->warning('Tên nhà xuất bản đã tồn tại. Sửa thất bại. Vui lòng chọn tên khác.');
							header("Location: home.php?sk=publisher&m=edit&id={$dataInfo['id_nxb']}");
						}
					}
				}
				else{
					$msg->error("Dữ liệu không hợp lệ.");
					header("Location: home.php?sk=publisher&m=edit&id={$dataInfo['id_nxb']}");
				}
			}
			// end submitEdit
		}
	}

	function listAllPublisher(){
		$page    = isset($_GET['page']) ? $_GET['page'] : '';
		$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

		$dataPb  = getAllDataPublisher($keyword); // hiển thị dữ liệu

		$link    = createLink(BASE_URL,array("sk"=>"publisher","m"=>"index",'page'=>'{page}',"keyword"=>$keyword));

		// hàm thực thi dữ liệu trong helper
		$dataPaging = paging($link,count($dataPb),$page,ROW_LIMIT,$keyword);

		// hàm lọc dữ liệu theo trang
		$dataPublisher = getDataPublisherByPage($dataPaging['st'],$dataPaging['limit'],$dataPaging['keyword']);

		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		require_once '../view/publisher/index_publisher_view.php';

	}

	// thêm dữ liệu cho nhà xuất bản
	function addPublisher(){
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();// xử ý thông báo lỗi
		require_once '../view/publisher/addPublisher_view.php';
		if (isset($_POST['btnSubmit'])) {
			$namePublish    = isset($_POST['txtName'])     ? $_POST['txtName']    : '';
			$namePublish    = strip_tags($namePublish);
			$phonePublish   = isset($_POST['txtPhone'])    ? $_POST['txtPhone']   : '';
			$phonePublish   = strip_tags($phonePublish);
			$addressPublish = isset($_POST['txtAddress'])  ? $_POST['txtAddress'] : '';
			$addressPublish = strip_tags($addressPublish);

			$logo = '';
			$type = 1;
			if (isset($_FILES['txtFileLogo'])) {
				$logo = uploadFiles($_FILES,$type);
			}
			$check = validateData($namePublish,$phonePublish,$addressPublish,$logo);
			$flag = TRUE;
			foreach ($check as $key => $val) {
				if (!empty($val)) {
					$flag = FALSE;
					break;
				}
			}

			// thực hiện kiểm tra và thêm dữ liệu
			if ($flag) {
				$checkName = checkExitName($namePublish); // check tên gửi lên và tên hiện tại giống nhau
				if ($checkName) {
					$add = add_info_publisher_modle($namePublish,$phonePublish,$addressPublish,$logo);
					if ($add) {
						$msg->success('Thêm thành công.');
						header("Location: home.php?sk=publisher&m=index");
					}
				}
				else{
					$msg->error('Tên nhà xuất bản đã tồn tại.');
					header("Location: home.php?sk=publisher&m=add");
				}
			}
			else{
				$msg->error('Dữ liệu nhập sai.');
				header("Location: home.php?sk=publisher&m=add");
			}
		}
	}

	function checkName($name){
		$check = checkExitName($name);
		return $check;
	}
	function validateData($namePublish,$phonePublish,$addressPublish,$logo){

		$errors  = array();// mb_strlen để đặt tiếng việt có dấu
		// $logo = $_FILES['txtFileLogo']['type'];
		 // OR (KiemTraDuoiFile($logo) != 1)
		$errors['namePublish']    = (empty($namePublish) OR (mb_strlen($namePublish) < 1 or mb_strlen($namePublish) > 200)) ? "Tên không được để trống và không được lớn hơn 200 hoặc nhỏ hơn 1 ký tự." : '';
		$errors['phonePublish']   = (empty($phonePublish) or (checkRegexpPhone($phonePublish) == 0) ) ? "Số điện thoại không được để trống và phải nhập đúng định dạng." : '';
		$errors['addressPublish'] = (empty($addressPublish) OR mb_strlen($addressPublish) > 200) ? "Địa chỉ không được để trống và không được lớn hơn 200 hoặc nhỏ hơn 1 ký tự." : '';
		$errors['logo']           = (empty($logo)) ? "Bạn chưa chọn logo hoặc loại ảnh không hỗ trợ." : '';

		return $errors;
	}
 ?>