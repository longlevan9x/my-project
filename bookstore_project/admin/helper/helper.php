<?php
	function get_username_admin(){
		$username   = isset($_SESSION['username']) ? $_SESSION['username'] : "";
		return $username;
	}
	function get_email_admin(){
		$emailAdmin = isset($_SESSION['email'])    ? $_SESSION['email']    : '';
		return $emailAdmin;
	}

	// get cookie
	function getCookieAdmin(){
		$cookie = isset($_COOKIE['admin']) ? $_COOKIE['admin'] : '';
		return $cookie;
	}

	function checkLoginAdmin(){
		$username = get_username_admin();
		$email    = get_email_admin();
		$cookie   = getCookieAdmin();
		if (empty($username) or empty($email) or empty($cookie)) {
			session_destroy();
			header("Location: ../index.php");
			die();
		}
	}

// để viết các hàm để sủ dụng chung
	// hàm upload file
	function uploadFiles($file,$type){
		// return $file['txtFileLogo']['error'];
		if ($file['txtFileLogo']['error'] == 0) {
			$tmtPath = $file['txtFileLogo']['tmp_name'];
			if (!empty($tmtPath)) {
				$path = '';
				switch ($type) {
					case "1":
						$path = "../../uploads/logoPublisher/" . $file['txtFileLogo']['name'];
						break;
					case "2":
						$path = "../../uploads/imgAuthor/" . $file['txtFileLogo']['name'];
						break;
					case "3":
						$path = "../../uploads/imgBooks/" . $file['txtFileLogo']['name'];
				}
				if (!empty($path)) {
					$up = move_uploaded_file($tmtPath, $path);
					if ($up) {
						return $file['txtFileLogo']['name'];
					}
				}
			}
		}
	}

	// hàm kiểm tra số điện thoại
	function checkRegexpPhone($phone){
		$regexp = "/^((([0][9][0,1,3,4,6,7,8]\d{7})|([0][1][6][3,4,5,6,7,8,9]\d{7}))|([0][1][2]\d{8}))$/";
		$check = preg_match($regexp,$phone);
		return $check;
	}

	// kiểm tra đuôi ảnh
	function KiemTraDuoiFile($file){
		$arrayFile = array("image/jpeg", "image/png");
		$result = in_array($file, $arrayFile);
		return $result;
	}

	// // kiểm tra kích thước ảnh
	// function KiemTraKichThuoc($size){
	// 	$flag = TRUE;
	// 	if (($size/ 1024) > 200) {
	// 		$flag = FALSE;
	// 	}
	// 	return $flag;
	// }
	// 
	
	// uri : baseUrl , filter các tham số trên link của 1 controller
	function createLink($uri,$filter = array()){ // baseurl là đường link gốc <=> file home
		$string = '';
		// lấy các tham số trên link
		foreach ($filter as $key => $val) { // key là controller val giá trị
			$string .= "&{$key}={$val}";// nếu không có dấu & thì lấy $
		}
		return $uri.($string ? '?' . ltrim($string,"&") : '');
	}

	// hàm phân trang
	function paging($link,$totalRecord,$currentPage,$limit,$keyword = ""){
		// limit dòng dữ liệu giới hạn
		//keyword phục vụ cho việc tìm kiếm
		// tính tổng số trang
		$totalPage = ceil($totalRecord/$limit);
		//xử lý giới hạn cho current page
		if ($currentPage > $totalRecord) {
			$currentPage = $totalPage;
		}
		elseif($currentPage < 1){
			$currentPage = 1;
		}

		//tính start
		$start = ($currentPage-1)*$limit;

		// tạo template phân trang
		$html = "<div class='text-center'>";
		$html .= "<nav  aria-label='Page navigation'>";
		$html .= "<ul class='pagination'>";
		// kiểm tra nút priview (back)
		if ($currentPage > 1 and $totalPage > 1) {
			$html .= "<li><a href='" . str_replace('{page}',1,$link) . "'><span style='font-size:10px;' class='glyphicon glyphicon-backward'></span></a> </li>";
			$html .= "<li><a href='" . str_replace('{page}',$currentPage-1,$link) . "'><span style='font-size:10px;' class='glyphicon glyphicon-chevron-left'></span></a> </li>";// tìm tất cả page trong link thay thế bằng currentpage -1
		}

		// tính các trang ở giữa
		for ($i=1; $i <= $totalPage; $i++) {
			// trường hợp current page == trang hiển thị
			if ($i == $currentPage) {
				$html .= "<li class='active'><a>".$i."<span class='sr-only'></span></a></li>";
			}
			else{
				$html .= "<li><a href='".str_replace('{page}', $i, $link)."'>" .$i. "</a></li>";
			}
		}

		// xử lý cho nút next
		if ($currentPage < $totalPage AND $totalPage > 1) {
			$html .= "<li><a href='".str_replace('{page}', $currentPage + 1, $link)."' aria-label='Next'><span style='font-size:10px;' class='glyphicon glyphicon-chevron-right'></span></a></li>";
			$html .= "<li><a href='" . str_replace('{page}',$totalPage,$link) . "'><span style='font-size:10px;' class='glyphicon glyphicon-forward'></span></a> </li>";
		}
		$html .= "</ul>";
		$html .= "</nav>";
		$html .= "</div>";


		return array(
			"st"=>$start,
			"html"=>$html,
			"keyword"=>$keyword,
			"limit"=>$limit
		);
	}
 ?>