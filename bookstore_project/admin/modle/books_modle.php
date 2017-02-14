<?php 
	require_once '../config/database.php';


	//check exit name
	function checkExitName($name){
		$conn = connection();
		$flag = TRUE;
		$sql  = "SELECT * FROM sach where TenSach = :namebook";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":namebook",$name,PDO::PARAM_STR);
			if($stmt->execute()){
				if ($stmt->rowCount() > 0) {
					$flag = FALSE;
				}
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $flag;
	}
	// lấy toàn bộ dữ liệu bản tác giả
	function get_all_data_author_modle(){
		$data = array();
		$conn = connection();
		$sql  = "SELECT * FROM tacgia";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);// lấy ra mảng không tuần tự
				}
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $data;
	}

	// lấy toàn bộ dữ liệu bảng nhà xuất bản
	function get_all_data_publisher_modle(){
		$data = array();
		$conn = connection();
		$sql  = "SELECT * FROM nhaxuatban";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);// lấy ra mảng không tuần tự
				}
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $data;
	}

	// lấy toàn bộ dữ liệu bảng loại sách
	function get_all_data_kindbook_modle(){
		$data = array();
		$conn = connection();
		$sql  = "SELECT * FROM loaisach";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);// lấy ra mảng không tuần tự
				}
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $data;
	}

	// Lấy dữ liệu bảng sách
	// function getAllDataBook(){
	// 	$conn = connection();
	// 	$data = array();
	// 	$sql  = "SELECT * FROM sach";
	// 	$stmt = $conn->prepare($sql);
	// 	if ($stmt) {
	// 		if ($stmt->execute()) {
	// 			if ($stmt->rowCount() > 0) {
	// 				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// 			}
	// 		}
	// 		$stmt->closeCursor();
	// 	}
	// 	disconnect($conn);
	// 	return $data;
	// }

	function getAllDataBook($keyword = ""){
		$conn = connection();
		$data = array();
		$key  = "%" . $keyword . "%";
		$sql  = "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai 
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			WHERE a.TenSach LIKE :key OR a.GiaCu LIKE :key
			ORDER BY a.create_time DESC";
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


	// tìm kiểm với phân trang
	function getDataBookByPage($start,$limit,$keyword = ""){
		$data = array();
		$conn = connection();
		$key  = "%" . $keyword . "%";
		$sql  = "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time,
			b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			WHERE a.TenSach LIKE :key OR a.GiaCu LIKE :key
			ORDER BY a.create_time DESC
			LIMIT :start,:limitdata";
		$stmt = $conn->prepare($sql);
		if ($stmt){
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
	// thêm dữ liệu bảng sách
	function add_info_book_modle($namebook,$idNXB,$idTG,$idLoai,$img,$giaStart,$numBook,$numPage){
		$flag = FALSE;
		$conn = connection();
		$status = 1;
		$soluotxem =0;
		$giaMoi = 0;
		$createTime = date("Y-m-d H:i:s");
		$sqlInsert  = "INSERT INTO sach(TenSach,id_nxb,id_tg,id_loai,status,SoLuotXem,HinhAnh,GiaCu,GiaMoi,SoLuong,SoTrang,create_time) VALUES (:name,:idnxb,:idtg,:idloai,:status,:SoLuotXem,:img,:giacu,:GiaMoi,:soluong,:sotrang,:createTime);";
		$stmt = $conn->prepare($sqlInsert);
		if ($stmt) {
			$stmt->bindParam(":name",$namebook,PDO::PARAM_STR);
			$stmt->bindParam(":idnxb",$idNXB,PDO::PARAM_INT);
			$stmt->bindParam(":idtg",$idTG,PDO::PARAM_INT);
			$stmt->bindParam(":idloai",$idLoai,PDO::PARAM_INT);
			$stmt->bindParam(":status",$status,PDO::PARAM_INT);
			$stmt->bindParam(":SoLuotXem",$soluotxem,PDO::PARAM_INT);
			$stmt->bindParam(":img",$img,PDO::PARAM_STR);
			$stmt->bindParam(":giacu",$giaStart,PDO::PARAM_INT);
			$stmt->bindParam(":GiaMoi",$giaMoi,PDO::PARAM_INT);
			$stmt->bindParam(":soluong",$numBook,PDO::PARAM_INT);
			$stmt->bindParam(":sotrang",$numPage,PDO::PARAM_INT);
			$stmt->bindParam(":createTime",$createTime,PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $flag;
	}

	// get data edit
	function getDataInfoBook($id){
		$data = array();
		$conn = connection();
		$sql  = "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai 
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			WHERE a.id = :id
			ORDER BY a.create_time DESC  LIMIT 1";
		$stmt = $conn->prepare($sql);
		if ($stmt){
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

	//EDIT DATA BOOK 
	function editDataBook($id,$name,$author,$publisher,$kinds,$status,$img,$qtyBook,$newCost,$numBook,$page){
		$flag = FALSE;
		$updateTime = date('Y-m-d H:i:s');
		$conn = connection();
		$sqlUpdate = "UPDATE sach AS a SET a.TenSach = :name, a.status = :status, a.HinhAnh = :img, a.GiaCu = :qtyBook, a.GiaMoi = :newCost, a.id_nxb = :publisher, a.id_tg = :author, a.id_loai = :kinds, a.SoLuong = :numBook, a.SoTrang = :numPage, a.date_time = :updateTime  WHERE id = :id;";
		$stmt = $conn->prepare($sqlUpdate);
		if ($stmt) {
			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);
			$stmt->bindParam(":publisher",$publisher,PDO::PARAM_INT);
			$stmt->bindParam(":author",$author,PDO::PARAM_INT);
			$stmt->bindParam(":kinds",$kinds,PDO::PARAM_INT);
			$stmt->bindParam(":status",$status,PDO::PARAM_INT);
			$stmt->bindParam(":qtyBook",$qtyBook,PDO::PARAM_INT);
			$stmt->bindParam(":newCost",$newCost,PDO::PARAM_INT);
			$stmt->bindParam(":numBook",$numBook,PDO::PARAM_INT);
			$stmt->bindParam(":numPage",$page,PDO::PARAM_INT);
			$stmt->bindParam(":updateTime",$updateTime,PDO::PARAM_STR);
			$stmt->bindParam(":img",$img,PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $flag;
	}

	// delete
	function deleteDataBook_modle($id){
		$conn = connection();
		$flag = FALSE;
		$sql  = "DELETE FROM sach WHERE id = :id";
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
 ?>