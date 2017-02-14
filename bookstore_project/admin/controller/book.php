<?php 
	require_once '../modle/books_modle.php';

	$method = isset($_GET['m']) ? $_GET['m'] : 'index';
	switch ($method) {
		case 'add':
			addBooks();
			break;
		case 'index':
			listAllBooks();
			break;
		case 'edit':
			editBook();
			break;
		case 'delete':
			deleteBook();
			break;
		default:
			listAllBooks();
			break;
	}

	//DELETE DATA 
	function deleteBook($id){
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		$idBook = isset($_GET['id']) ? $_GET['id'] : 0;
		$idBook = is_numeric($idBook) ? $idBook : 0;
		$dataBook = getDataInfoBook($idBook);
		if (empty($dataBook)) {
			require_once '../view/notfound_view.php';
		}
		else{
			$deleteDataBook = deleteDataBook_modle($idBook);
			if ($deleteDataBook) {
				$msg->success("Xóa thành công.");
				header("Location: home.php?sk=book");
			}
			else{
				$msg->error("Xóa thất bại.");
				header("Location: home.php?sk=book&m=index");
			}
		}
	}
	// EDIT DATA
	function editBook(){
		$idBook = isset($_GET['id']) ? $_GET['id'] : 0;
		$idBook = is_numeric($idBook) ? $idBook : 0;
		$dataBook = getDataInfoBook($idBook);
		if (empty($dataBook)) {
			require_once '../view/notfound_view.php';
		}
		else{
			//lấy all data tác giả
			$dataAuthor    = get_all_data_author_modle();
			// lấy tất cả dữ liệu nhà xuất bản
			$dataPublisher = get_all_data_publisher_modle();
			// lấy tất cả dữ liệu loại sách
			$dataKindbook = get_all_data_kindbook_modle();

			$msg = new \Plasticbrain\FlashMessages\FlashMessages();
			require_once '../view/book/editBooks_view.php';
			if (isset($_POST['btnSubmitEdit'])) {
				$author    = isset($_POST['slcAuthor'])    ? $_POST['slcAuthor']    : '';
				$publisher = isset($_POST['slcPublisher']) ? $_POST['slcPublisher'] : '';
				$kindbooks = isset($_POST['slcKindBooks']) ? $_POST['slcKindBooks'] : '';
				$status	   = isset($_POST['slcSttBooks'])  ? $_POST['slcSttBooks']  : '';
				$status	   = is_numeric($status) ? $status : 0;
				$namebook  = isset($_POST['txtNamebook'])  ? $_POST['txtNamebook']  : '';
				$namebook  = strip_tags($namebook);
				$hddNameB  = isset($_POST['hddNameB'])     ? $_POST['hddNameB']     : '';
				$hddNameB  = strip_tags($hddNameB);
				$giaStart  = isset($_POST['txtCostBook'])  ? $_POST['txtCostBook']  : '';
				$newCost   = isset($_POST['txtNewCostBook'])  ? $_POST['txtNewCostBook']  : '';
				$newCost   = is_numeric($newCost) ? $newCost : "";
				$newGia = empty($newCost) ? $giaStart : $newCost; // lấy giá mới
				$numBook   = isset($_POST['txtQTYbook'])   ? $_POST['txtQTYbook']   : '';
				$numPage   = isset($_POST['txtPageBook'])  ? $_POST['txtPageBook']  : '';
				$numPage   = is_numeric($numPage) ? $numPage : 0;
				$HddFile   = isset($_POST['txtHddFile'])   ? $_POST['txtHddFile']   : '';
				$HddFile   = strip_tags($HddFile);

				$img = "";
				$type = 3;
				if (isset($_FILES['txtFileLogo'])) {
					$img = uploadFiles($_FILES,$type);
				}

				$strImg = empty($img) ? $HddFile : $img; // lấy ảnh mới

				$flag = TRUE;
				$checkError = validateData($namebook,$author,$publisher,$kindbooks,$strImg,$newGia,$numBook,$numPage);
				foreach ($checkError as $key => $error) {
					if (!empty($error)) {
						$flag = FALSE;
						break;
					}
				}

				if ($flag) {
					$flagCheckName = FALSE;
					if ($namebook == $hddNameB) {
						$edit = editDataBook($idBook,$namebook,$author,$publisher,$kindbooks,$status,$strImg,$giaStart,$newGia,$numBook,$numPage);
						if ($edit) {
							if (isset($_SESSION['error'])) {
								unset($_SESSION['error']);
							}
							$msg->success("Sửa thành công.");
							header("Location: home.php?sk=book&m=index");
						}
					}
					else{
						$edit = editDataBook($idBook,$namebook,$author,$publisher,$kindbooks,$status,$strImg,$giaStart,$newGia,$numBook,$numPage);
						if (checkName($namebook)) {
							if ($edit) {
								if (isset($_SESSION['error'])) {
									unset($_SESSION['error']);
								}
								$msg->success("Sửa thành công tên mới.");
								header("Location: home.php?sk=book&m=index");
							}
						}
						else{
							if (isset($_SESSION['error'])) {
								unset($_SESSION['error']);
							}
							$msg->warning("Sửa thất bại. Tên đã tồn tại.");
							header("Location: home.php?sk=book&m=edit&id={$dataBook['id']}");
						}// end update
					}//end checkName
				}
				else{
					$msg->error("Dữa liệu thất sai.");
					$_SESSION['error'] = $checkError;
					header("Location: home.php?sk=book&m=edit&id={$dataBook['id']}");
				}//end flag
			}// end btnsubmit
		}

	}
	// hiển thị tất cả dữ liệu
	function listAllBooks(){
		// $dataAuthor    = get_all_data_author_modle();
		// $dataPublisher = get_all_data_publisher_modle();
		// $dataKindbook = get_all_data_kindbook_modle();

		if (isset($_SESSION['error'])) {
			unset($_SESSION['error']);
		}

		$keyword   = isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page      = isset($_GET['page'])    ? $_GET['page']    : "";
		$dataBooks = getAllDataBook($keyword);
		// tạo link
		$link    = createLink(BASE_URL,array("sk"=>"book","m"=>"index",'page'=>'{page}',"keyword"=>$keyword));
		// tạo hàm phân trang
		$dataPaging = paging($link,count($dataBooks),$page,ROW_LIMIT,$keyword);
		// $datePaging =
		$dataAllBook = getDataBookByPage($dataPaging['st'],$dataPaging['limit'],$dataPaging['keyword']);

		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		require_once '../view/book/index_book_view.php';
	}

	// thêm sách
	function addBooks(){
		$msg = new \Plasticbrain\FlashMessages\FlashMessages();
		//lấy all data tác giả
		$dataAuthor    = get_all_data_author_modle();
		// lấy tất cả dữ liệu nhà xuất bản
		$dataPublisher = get_all_data_publisher_modle();
		// lấy tất cả dữ liệu loại sách
		$dataKindbook = get_all_data_kindbook_modle();
		require_once '../view/book/addBook_view.php';

		if (isset($_POST['btnSubmit'])) {
			$author    = isset($_POST['slcAuthor'])    ? $_POST['slcAuthor']    : '';
			$publisher = isset($_POST['slcPublisher']) ? $_POST['slcPublisher'] : '';
			$kindbooks = isset($_POST['slcKindBooks']) ? $_POST['slcKindBooks'] : '';
			$namebook  = isset($_POST['txtNamebook'])  ? $_POST['txtNamebook']  : '';
			$namebook  = strip_tags($namebook);
			$giaStart  = isset($_POST['txtCostBook'])  ? $_POST['txtCostBook']  : '';
			$numBook   = isset($_POST['txtQTYbook'])   ? $_POST['txtQTYbook']   : '';
			$numPage   = isset($_POST['txtPageBook'])  ? $_POST['txtPageBook']  : '';

			$img = '';
			$type = 3;
			if (isset($_FILES['txtFileLogo'])) {
				$img = uploadFiles($_FILES,$type);
			}

			$flag = TRUE;
			$checkError = validateData($namebook,$author,$publisher,$kindbooks,$img,$giaStart,$numBook,$numPage);
			foreach ($checkError as $key => $error) {
				if (!empty($error)) {
					$flag = FALSE;
					break;
				}
			}

			if ($flag) {
				$check = checkName($namebook);
				if ($check) {
					$add = add_info_book_modle($namebook,$publisher,$author,$kindbooks,$img,$giaStart,$numBook,$numPage);
					if ($add) {
						if (isset($_SESSION['error'])) {
							unset($_SESSION['error']);
						}
						else{
							$msg->success("Thêm thành công.");
							header("Location: home.php?sk=book&m=index");
						}
					}// end add
				}
				else{
					if (isset($_SESSION['error'])) {
						unset($_SESSION['error']);
					}
					$msg->warning("Tên đã tồn tại. Thêm thất bại.");
					header("Location: home.php?sk=book&m=add");
				}// end checkName
			}
			else{
				$msg->error("Thêm thất bại.");
				$_SESSION['error'] = $checkError;
				header("Location: home.php?sk=book&m=add");
			}//end flag
		}
	}

	function checkName($name){
		return checkExitName($name);
	}

	function validateData($name,$author,$publisher,$kindbooks,$img,$cost,$numBook,$page){
		$errors = array();
		$errors['name'] = (empty($name) OR mb_strlen($name) > 201 OR strlen($name) < 1) ? "Tên sách k được để rỗng và chỉ từ 1 - 200 ký tự" : '';
		$errors['author'] = (empty($author) OR !is_numeric($author) OR $author <= 0) ? "Giá ko để trống, phải là số > 0." : '';
		$errors['publisher'] = (empty($publisher) OR !is_numeric($publisher) OR $publisher <= 0) ? "Giá ko để trống, phải là số > 0." : '';
		$errors['kindbooks'] = (empty($kindbooks) OR !is_numeric($kindbooks) OR $kindbooks <= 0) ? "Giá ko để trống, phải là số > 0. " : '';
		$errors['img']  = (empty($img)) ? "Img Fail. Empty!" : "";
		$errors['cost'] = (empty($cost) OR !is_numeric($cost) OR strlen($cost) > 11) ? "Giá ko để trống, phải là số và < 11 số. " : '';
		$errors['numBook'] = (empty($numBook)  OR !is_numeric($numBook) OR strlen($numBook) > 11 ) ? "Số lượng ko để trống, phải là số và < 11 số. " : '';
		$errors['page'] =	(empty($page)  OR !is_numeric($numBook) OR strlen($numBook) > 11 ) ? "Số trang ko để trống, phải là số và < 11 số. " : '';

		return $errors;
	}
 ?>