<?php
	require_once '../modle/author_modle.php';
	$method = isset($_GET['m']) ? $_GET['m'] : 'index';

	switch ($method) {
		case 'add':
			addAuthor_modle();
			break;
		case 'edit':
			editAuthor();
			break;

		case 'delete':
			deleteAuthor();
			break;

		case 'index':
			listAllAuthor();
			break;

		default:
			listAllAuthor();
			break;
	}

	function listAllAuthor(){
		$page    = isset($_GET['page'])    ? $_GET['page']    : '';
		$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

		$dataAt  = getAllDataAuthor($keyword);
		// tạo link
		$link    = createLink(BASE_URL,array("sk"=>"author","m"=>"index","page"=>"{page}","keyword"=>$keyword));
		// gọi hàm phân trang
		$dataPaging = paging($link,count($dataAt),$page,ROW_LIMIT,$keyword);
		// xủ lý phân trang
		$dataAllAuthor = getAllDataAuthorByPage($dataPaging['st'],$dataPaging['limit'],$dataPaging['keyword']);
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		require_once '../view/author/index_author_view.php';
	}

	function addAuthor_modle(){
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		require_once '../view/author/addAuthor_view.php';
		if (isset($_POST['btnSubmit'])) {
			$nameAuthor 	= isset($_POST['txtName'])    ? $_POST['txtName']    : '';
			$nameAuthor 	= strip_tags($nameAuthor);
			$phoneAuthor	= isset($_POST['txtPhone'])   ? $_POST['txtPhone']   : '';
			$phoneAuthor 	= strip_tags($phoneAuthor);
			$addressAuthor 	= isset($_POST['txtAddress']) ? $_POST['txtAddress'] : '';
			$addressAuthor 	= strip_tags($addressAuthor);

			$logo = '';
			$type = 2;
			if (isset($_FILES['txtFileLogo'])) {
				$logo = uploadFiles($_FILES,$type);
			}

			$flag = TRUE;
			$checkError = validateData($nameAuthor,$phoneAuthor,$addressAuthor,$logo);
			foreach ($checkError as $key => $error) {
				if (!empty($error)) {
					$flag = FALSE;
					break;
				}
			}

			if ($flag) {
				if (checkName($nameAuthor)) {
					$add = add_info_author_modle($nameAuthor,$phoneAuthor,$addressAuthor,$logo);
					if ($add) {
						$msg->success("Thêm thành công.");
						header("Location: home.php?sk=author&m=index");
					}
				}
				else{
					$msg->warning("Thêm thất bại.Tên đã tồn tại");
					header("Location: home.php?sk=author&m=add");
				}
			}
			else{
				$msg->error("Thêm thất bại.");
				header("Location: home.php?sk=author&m=add");
			}// end flag
		}
	}

	// DELETE DATA AUTHOR
	function deleteAuthor($id){
		$idAt = isset($_GET['id']) ? $_GET['id'] : 0;
		$idAt = is_numeric($idAt)  ? $idAt : 0;
		$dataEditAt = getDataInfoAuthor($idAt);
		if (empty($dataEditAt)) {
			require_once '../view/notfound_view.php';
		}
		else{
			$msg = new \Plasticbrain\FlashMessages\FlashMessages();
			$delete = deleteDataAuthor_modle($idAt);
			if ($delete) {
				$msg->success("Xóa thành công");
				header("Location: home.php?sk=author");
			}
			else{
				$msg->info("Đã hủy xóa");
				header("Location: home.php?sk=author&m=index");
			}
		}
	}
	// Edit data author
	function editAuthor(){
		$idAt = isset($_GET['id']) ? $_GET['id'] : 0;
		$idAt = is_numeric($idAt)  ? $idAt : 0;
		$dataEditAt = getDataInfoAuthor($idAt);
		if (empty($dataEditAt)) {
			require_once '../view/notfound_view.php';
		}
		else{
			$msg = new \Plasticbrain\FlashMessages\FlashMessages();
			require_once '../view/author/editAuthor_view.php';
			if (isset($_POST['btnSubmitEdit'])) {
				$nameAuthor 	= isset($_POST['txtName'])    ? $_POST['txtName']    : '';
				$nameAuthor 	= strip_tags($nameAuthor);
				$nameHdd        = isset($_POST['hddName'])    ? $_POST['hddName'] : '';
				$nameHdd 	    = strip_tags($nameHdd);
				$phoneAuthor	= isset($_POST['txtPhone'])   ? $_POST['txtPhone']   : '';
				$phoneAuthor 	= strip_tags($phoneAuthor);
				$addressAuthor 	= isset($_POST['txtAddress']) ? $_POST['txtAddress'] : '';
				$addressAuthor 	= strip_tags($addressAuthor);
				$imgHdd         = isset($_POST['hddFileName']) ? $_POST['hddFileName'] : '';
				$imgHdd         = strip_tags($imgHdd);

				$img = '';
				$type = 3;
				if (isset($_FILES['txtFileLogo'])) {
					$img = uploadFiles($_FILES,$type);
				}
				$strImg = (empty($img)) ? $imgHdd : $img;

				$flag = TRUE;
				$checkError = validateData($nameAuthor,$phoneAuthor,$addressAuthor,$strImg);

				foreach ($checkError as $key => $error) {
					if (!empty($error)) {
						$flag = FALSE;
						break;
					}
				}

				if ($flag) {
					if ($nameHdd == $nameAuthor) {
						$edit = editDataAuthor($idAt,$nameAuthor,$phoneAuthor,$addressAuthor,$strImg);
						if ($edit) {
							$msg->success("Sửa thành công");
							header("Location: home.php?sk=author&m=index");
						}
					}
					else{
						if (checkName($nameAuthor)) {
							$edit = editDataAuthor($idAt,$nameAuthor,$phoneAuthor,$addressAuthor,$strImg);
							if ($edit) {
								$msg->info("Sửa thành công tên mới");
								header("Location: home.php?sk=author&m=index");
							}
						}
						else{
							$msg->warning("Sửa thất bại. Tên đã tồn tại.");
							header("Location: home.php?sk=author&m=edit&id={$dataEditAt['id_tg']}");
						}// end checkname
					}
				}
				else{
					$msg->error("Dữ liệu không hợp lệ.");
					header("Location: home.php?sk=author&m=edit&id={$dataEditAt['id_tg']}");
				}// end flag
			}// end submitedit
		}


	}

	//check name
	function checkName($name){
		return checkExitName($name);
	}
	function validateData($name,$phone,$address,$img){
		$errors = array();
		
		$errors['name']    = (empty($name) OR (mb_strlen($name) < 1 or mb_strlen($name) > 200)) ? "Tên không được để trống và không được lớn hơn 200 hoặc nhỏ hơn 1 ký tự." : '';
		$errors['phone']   = (empty($phone) or (checkRegexpPhone($phone) == 0) ) ? "Số điện thoại không được để trống và phải nhập đúng định dạng." : '';
		$errors['address'] = (empty($address) OR mb_strlen($address) > 200) ? "Địa chỉ không được để trống và không được lớn hơn 200 hoặc nhỏ hơn 1 ký tự." : '';
		$errors['img']           = (empty($img)) ? "Bạn chưa chọn logo hoặc loại ảnh không hỗ trợ." : '';

		return $errors;
	}
 ?> 