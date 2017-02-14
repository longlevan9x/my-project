<?php 
	require_once '../config/database.php';
	

	// thêm dữ liệu vào
	function add_info_publisher_modle($namePublish,$phonePublish,$addressPublish,$logo){
		$createTime = date("Y-m-d H:i:s");
		$updateTime = " ";
		$checkFlag = FALSE;
		$conn = connection();
		$sql = "INSERT INTO nhaxuatban(TenNXB,SDTNXB,DiaChiNXB,logo_NXB,create_time,update_time) VALUES(:namePublish,:phone,:address,:logo,:createTime,:updateTime);";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":namePublish",$namePublish,PDO::PARAM_STR);
			$stmt->bindParam(":phone",$phonePublish,PDO::PARAM_STR);
			$stmt->bindParam(":address",$addressPublish,PDO::PARAM_STR);
			$stmt->bindParam(":logo",$logo,PDO::PARAM_STR);
			$stmt->bindParam(":createTime",$createTime,PDO::PARAM_STR);
			$stmt->bindParam(":updateTime",$updateTime,PDO::PARAM_STR);
			if ($stmt->execute()) {
				$checkFlag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $checkFlag;
	}


	// hiển thị dữ liệu ra
	function getAllDataPublisher($keyword = ""){
		$data = array();
		$conn = connection();
		$key = "%" . $keyword . "%";
		$sql  = "SELECT * FROM nhaxuatban as a WHERE a.TenNXB LIKE :key OR a.SDTNXB LIKE :key OR a.DiaChiNXB LIKE :key";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":key",$key,PDO::PARAM_STR);
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

	// kiểm tra nhập tên nhà xuất bản đã có chưa
	function checkExitName($username){
		$checkFlag = TRUE;
		$conn = connection();
		$sql  = "SELECT TenNXB FROM nhaxuatban WHERE TenNXB = :username";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':username',$username,PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					$checkFlag = FALSE;
				}
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $checkFlag;
	}


	// lấy dữ liệu để xóa và chỉnh sửa
	function getDataInfoPublisher($id){
		$data = array();
		$conn = connection();
		$sql = "SELECT * FROM nhaxuatban WHERE id_nxb = :id";
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
	// sửa dữ liệu
	function editDataPublisher($id,$namePublish,$phonePublish,$addressPublish,$logo){
		$flag = FALSE;
		$updateTime = date("Y-m-d H:s:i");
		$conn = connection();
		$sqlUpdate = "UPDATE nhaxuatban SET TenNXB = :namePublish, SDTNXB = :phonePublish, DiaChiNXB = :addressPublish, logo_NXB = :logo, update_time = :updateTime WHERE id_nxb = :id";
		$stmt =  $conn->prepare($sqlUpdate);
		if ($stmt) {
			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
			$stmt->bindParam(":namePublish",$namePublish,PDO::PARAM_STR);
			$stmt->bindParam(":phonePublish",$phonePublish,PDO::PARAM_STR);
			$stmt->bindParam(":addressPublish",$addressPublish,PDO::PARAM_STR);
			$stmt->bindParam(":logo",$logo,PDO::PARAM_STR);
			$stmt->bindParam(":updateTime",$updateTime,PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $flag;
	}

	// xóa dữ liệu
	function deleteDataPublisher_modle($id){
		$flag = FALSE;
		$conn = connection();
		$sqlDelete = "DELETE FROM nhaxuatban WHERE id_nxb = :id";
		$stmt = $conn->prepare($sqlDelete);
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


	// xử lý phân trang
	function getDataPublisherByPage($start,$limit,$keyword = ""){
		$data = array();
		$conn = connection();
		$key  = "%" . $keyword . "%";
		$sql  = "SELECT * FROM nhaxuatban AS a WHERE a.TenNXB LIKE :key OR a.SDTNXB LIKE :key OR a.DiaChiNXB LIKE :key ORDER BY a.create_time DESC LIMIT :start,:limitdata";
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
			$stmt->closeCursor();// đóng con trỏ kết nối
		}
		disconnect($conn);
		return $data;
	}
 ?>