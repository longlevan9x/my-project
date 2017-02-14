<?php 
	require '../modle/kindbook_modle.php';
	$method = isset($_GET['m']) ? $_GET['m'] : 'index';
	switch ($method) {
		case 'add':
			addKindbook_modle();
			break;
		case 'edit':
			editKindbook_modle();
			break;
		case 'delete':
			deleteKindbook_modle();
			break;
		case 'index':
			listAllKindbook();
			break;
		default:
			listAllKindbook();
			break;
	}

	// list All loại sách
	function listAllKindbook(){
		$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page    = isset($_GET['page'])	   ? $_GET['page']    : '';

		$dataKb  = getAllDataKindbook($keyword);

		$link    = createLink(BASE_URL,array("sk"=>"kindbook","m"=>"index","page"=>"{page}","keyword"=>$keyword));

		$dataPaging = paging($link,count($dataKb),$page,ROW_LIMIT,$keyword);

		$dataAllKb  = getDataKindbookByPage($dataPaging['st'],$dataPaging['limit'],$dataPaging['keyword']);
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		require_once '../view/kindbook/index_kindbook_view.php';
	}

	//DELETE DATA BOOK 
	function deleteKindbook_modle(){
		$idKb   = isset($_GET['id']) ? $_GET['id'] : 0;
		$idKb   = is_numeric($idKb)  ? $idKb : 0;
		$dataKb = getDataInfoKindbook($idKb);
		if (empty($dataKb)) {
			require_once '../view/notfound_view.php';
		}
		else{
			$msg = new \Plasticbrain\FlashMessages\FlashMessages();
			$delete = deleteDataKindbook($idKb);
			if ($delete) {
				$msg->success("Xóa thành công.");
				header("Location: home.php?sk=kindbook");
			}
			else{
				$msg->error("Đã hủy xóa.");
				header("Location: home.php?sk=kindbook&m=index");
			}
		}
	}
	// EDIT DATA KINDBOOK
	function editKindbook_modle(){
		$idKb   = isset($_GET['id']) ? $_GET['id'] : 0;
		$idKb   = is_numeric($idKb)  ? $idKb : 0;
		$dataKb = getDataInfoKindbook($idKb);
		if (empty($dataKb)) {
			require_once '../view/notfound_view.php';
		}
		else{
			$msg = new \Plasticbrain\FlashMessages\FlashMessages();
			require_once '../view/kindbook/editKindbook_view.php';
			if (isset($_POST['btnSubmitEdit'])) {
				$name    = isset($_POST['txtNameKB']) ? $_POST['txtNameKB'] : '';
				$name    = strip_tags($name);
				$hddName = isset($_POST['hddName']) ? $_POST['hddName'] : '';
				$hddName = strip_tags($hddName);

				$flag = TRUE;
				$flag = TRUE;
				$checkError = validateData($name);
				foreach ($checkError as $key => $err){
					if (!empty($err)) {
						$flag = FALSE;
						break;
					}
				}

				if ($flag) {
					if ($name == $hddName) {
						$update = editDataKindbook($idKb,$name);
						if ($update) {
							$msg->success("Sửa thành công.");
							header("Location: home.php?sk=kindbook&m=index");
						}
					}
					else{
						if (checkName($name)) {
							$update = editDataKindbook($idKb,$name);
							if ($update) {
								$msg->success("Sửa thành công tên mới.");
								header("Location: home.php?sk=kindbook&m=index");
							}
						}
						else{
							$msg->info("Tên đã tồn tại. Sửa thất bại.");
							header("Location: home.php?sk=kindbook&m=edit&id={$dataKb['id_loai']}");
						}
					}
				}
				else{
					$msg->error("Dữ liệu không hợp lệ.");
					header("Location: home.php?sk=kindbook&m=edit&id={$dataKb['id_loai']}");
				}//end Flag
			}//end submit
		}
	}

	// thêm sách
	function addKindbook_modle(){
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		require_once '../view/kindbook/addKindbook_view.php';
		if (isset($_POST['btnSubmit'])) {
			$name = isset($_POST['txtNameKB']) ? $_POST['txtNameKB'] : '';
			$name = strip_tags($name);


			$flag = TRUE;
			$checkError = validateData($name);
			foreach ($checkError as $key => $err){
				if (!empty($err)) {
					$flag = FALSE;
					break;
				}
			}

			if ($flag) {
				$check = checkName($name); // test name exited
				if ($check) {
					$add = add_info_kindbook_modle($name);
					if ($add) {
						$msg->success("Thêm thành công.");
						header("Location: home.php?sk=kindbook&m=index");
					}
				}
				else{
					$msg->info("Thêm thất bại. Tên đã tồn tại.");
					header("Location: home.php?sk=kindbook&m=add");
				}
			}
			else{
				$msg->error("Dữ liệu không hợp lệ.");
				header("Location: home.php?sk=kindbook&m=add");
			}
		}

	}

	function checkName($name){
		$check = checkExitName($name);
		return $check;
	}
	function validateData($name){
		$error = array();
		$error['name'] = (empty($name) or mb_strlen($name) > 200 or mb_strlen($name) < 3) ? "Tên không được để trống và phải lớn hơn 3 và 200 ký tự" : '';

		return $error;
	}
 ?>