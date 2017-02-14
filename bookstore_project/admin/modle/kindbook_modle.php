<?php 
	require_once '../config/database.php';

	// Thêm dữ liệu vào bảng loại sách
	function add_info_kindbook_modle($nameKind){
		$flag = FALSE;
		$createTime = date("Y-m-d H:i:s");
		$updateTime = '';
		$conn = connection();
		$sqlInsert = "INSERT INTO loaisach(TenLoai,create_time,update_time) VALUES (:name,:createTime,:updateTime);";
		$stmt = $conn->prepare($sqlInsert);
		if ($stmt) {
			$stmt->bindParam(":name",$nameKind,PDO::PARAM_STR); // chống sql injecttion
			$stmt->bindParam(":createTime",$createTime,PDO::PARAM_STR);
			$stmt->bindParam(":updateTime",$updateTime,PDO::PARAM_STR);
			if ($stmt->execute()) { // thực thi câu lệnh
				$flag = TRUE;
			}
			$stmt->closeCursor(); // đóng con trỏ kết nối
		}
		disconnect($conn); // đóng kết nối
		return $flag;
	}

	// hiển thị dữ liệu
	function getAllDataKindbook($keyword = ''){
		$data = array();
		$conn = connection();
		$key  = "%".$keyword."%";
		$sql  = "SELECT * FROM loaisach WHERE TenLoai LIKE :key";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":key",$key,PDO::PARAM_INT);
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

	//DELETE DATA  KINDBOOK
	function deleteDataKindbook($id){
		$flag = FALSE;
		$conn = connection();
		$sql  = "DELETE FROM loaisach WHERE id_loai = :id";
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

	// GET DATA EDIT
	function getDataInfoKindbook($id){
		$data = array();
		$conn = connection();
		$sql  = "SELECT * FROM loaisach WHERE id_loai = :id" ;
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
	// Edit data KINDBOOK
	function editDataKindbook($id,$name){
		$flag = FALSE;
		$conn = connection();
		$updateTime = date("Y-m-d H:i:s");
		$sql  = "UPDATE loaisach SET TenLoai = :name, update_time = :updateTime WHERE id_loai= :id";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);
			$stmt->bindParam(":updateTime",$updateTime,PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $flag;
	}

	// xử lý phân trang và tìm kiếm
	function getDataKindbookByPage($start,$limit,$keyword){
		$data = array();
		$conn = connection();
		$key  = "%" . $keyword . "%";
		$sql  = "SELECT * FROM loaisach WHERE TenLoai LIKE :key ORDER BY create_time LIMIT :start,:limitdata";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":key",$key,PDO::PARAM_STR);
			$stmt->bindParam(":start",$start,PDO::PARAM_INT);
			$stmt->bindParam(":limitdata",$limit,PDO::PARAM_INT);
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

	// kiểm tra tên
	function checkExitName($name){
		$flag = TRUE;
		$conn = connection();
		$sql  = "SELECT * FROM loaisach WHERE TenLoai = :name";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					$flag = FALSE;
				}
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $flag;
	}
 ?>