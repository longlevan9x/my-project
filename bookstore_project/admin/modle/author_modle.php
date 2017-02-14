<?php
	require_once '../config/database.php';

	// check xem tên có trong db chưa
	function checkExitName($name){
		$flag = TRUE;
		$conn = connection();
		$sql  = "SELECT * FROM tacgia WHERE TenTG = :name";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) { // tức là có dữ liệu trả về
					$flag = FALSE;
				}
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $flag;
	}

	// thêm dữ liệu vào bản tác giả
	function add_info_author_modle($nameAuthor,$phoneAuthor,$addressAuthor,$imgAuthor){
		$flag = FALSE;
		$createTime = date('Y-m-d H:i:s');
		$updateTime = '';
		$conn = connection();
		$sqlInsert = "INSERT INTO tacgia(TenTG,SDTTG,DiaChiTG,img_path,create_time,update_time) VALUES (:nameAuthor,:phoneAuthor,:addressAuthor,:imgAuthor,:createTime,:updateTime);";
		$stmt = $conn->prepare($sqlInsert);
		if ($stmt) {
			$stmt->bindParam(":nameAuthor",$nameAuthor,PDO::PARAM_STR);
			$stmt->bindParam(":phoneAuthor",$phoneAuthor,PDO::PARAM_STR);
			$stmt->bindParam(":addressAuthor",$addressAuthor,PDO::PARAM_STR);
			$stmt->bindParam(":imgAuthor",$imgAuthor,PDO::PARAM_STR);
			$stmt->bindParam(":createTime",$createTime,PDO::PARAM_STR);
			$stmt->bindParam(":updateTime",$updateTime,PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $flag;
	}

	// hiển thị dữ liệu từ bảng tác giả
	function getAllDataAuthor($keyword = ""){
		$data = array();
		$flag = FALSE;
		$conn = connection();
		$key  = "%" . $keyword . "%";
		$sql  = "SELECT * FROM tacgia AS a WHERE a.TenTG LIKE :key OR a.SDTTG LIKE :key OR a.DiaChiTG LIKE :key ORDER BY a.TenTG ASC";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":key",$key,PDO::PARAM_STR);
			if ($stmt->execute()) {
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $data;
	}
	// lấy dữ liệu để kiểm tra chỉnh sủa  và xóa
	function getDataInfoAuthor($id){
		$data = array();
		$conn = connection();
		$sql  = "SELECT * FROM tacgia WHERE id_tg = :id";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $data;
	}
	// chỉnh sửa tác giả
	function editDataAuthor($id,$name,$phone,$address,$img){
		$updateTime = date("Y-m-d H:i:s");
		$flag = FALSE;
		$conn = connection();
		$sqlEdit = "UPDATE tacgia SET TenTG = :name, SDTTG = :phone, DiaChiTG = :address, img_path = :img, update_time = :updateTime WHERE id_tg = :id ";
		$stmt = $conn->prepare($sqlEdit);
		if ($stmt) {
			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);
			$stmt->bindParam(":phone",$phone,PDO::PARAM_STR);
			$stmt->bindParam(":address",$address,PDO::PARAM_STR);
			$stmt->bindParam(":img",$img,PDO::PARAM_STR);
			$stmt->bindParam(":updateTime",$updateTime,PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $flag;
	}

	//Xóa tác giả
	function deleteDataAuthor_modle($id){
		$flag = FALSE;
		$conn = connection();
		$sql  = "DELETE FROM tacgia WHERE id_tg = :id";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $flag;
	}

	// xử lý tìm kiếm và phân trang
	function getAllDataAuthorByPage($start,$limit,$keyword = ""){
		$data = array();
		$conn = connection();
		$key  = "%" . $keyword . "%";
		$sql  = "SELECT * FROM tacgia AS a
		WHERE a.TenTG LIKE :key OR a.SDTTG LIKE :key OR a.DiaChiTG LIKE :key ORDER BY a.TenTG ASC LIMIT :start,:limitdata ";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam("key",$key,PDO::PARAM_STR);
			$stmt->bindParam("start",$start,PDO::PARAM_INT);
			$stmt->bindParam("limitdata",$limit,PDO::PARAM_INT);
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $data;
	}
 ?>