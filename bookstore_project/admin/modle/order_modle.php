<?php 
require_once '../config/database.php';
function get_all_order_modle($keyword = ''){
	$data = array();
	$conn = connection();
	$key = '%' . $keyword . '%';
	$status = 0;
	$sql  = "SELECT a.id_hd,a.id_sach,a.TenKH,a.SDT,a.Email,a.DiaChi,a.GhiChu,a.SoLuong,a.ThanhTien,a.TrangThai,a.create_time,b.TenSach,b.HinhAnh
			FROM donhang AS a INNER JOIN sach AS b ON a.id_sach = b.id
			WHERE a.TrangThai = :status AND b.TenSach LIKE :key
			ORDER BY a.create_time DESC";
	$stmt = $conn->prepare($sql);
	if ($stmt) {
		$stmt->bindParam(":key",$key,PDO::PARAM_STR);
		$stmt->bindParam(":status",$status,PDO::PARAM_INT);
		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
		}
		$stmt->closeCursor();
	}
	disconnect($conn);
	// print_r($data); die();
	// xử lý data đổ ra view
	$orderBook = array();
	foreach ($data as $key => $val) {
		$orderBook[$val['id_sach']]['imgbook'] = $val['HinhAnh'];
		$orderBook[$val['id_sach']]['namebook'] = $val['TenSach'];
		$orderBook[$val['id_sach']]['listorder'][] = $val;
	}
	// print_r($orderBook); die();
	return $orderBook;
}

function get_all_data_orders($start,$limit,$keyword = ""){
	$data = array();
	$conn = connection();
	$status = 0;
	$key = '%' . $keyword . '%';
	$sql  = "SELECT a.id_hd,a.id_sach,a.TenKH,a.SDT,a.Email,a.DiaChi,a.GhiChu,a.SoLuong,a.ThanhTien,a.TrangThai,a.create_time,b.TenSach,b.HinhAnh
			FROM donhang AS a INNER JOIN sach AS b ON a.id_sach = b.id
			WHERE a.TrangThai = :status AND b.TenSach LIKE :key
			ORDER BY a.create_time DESC
			LIMIT :start,:limitdata";
	$stmt = $conn->prepare($sql);
	if ($stmt) {
		$stmt->bindParam(":key",$key,PDO::PARAM_STR);
		$stmt->bindParam(":status",$status,PDO::PARAM_INT);
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

	$dataOrders = array();

	foreach ($data as $key => $val) {
		$dataOrders[$val['id_sach']]['imgbook'] = $val['HinhAnh'];
		$dataOrders[$val['id_sach']]['namebook'] = $val['TenSach'];
		$dataOrders[$val['id_sach']]['listorder'][] = $val;
	}

	return $dataOrders;
}


function update_order_modle($id,$type){
	$conn  = connection();
	$flag = FALSE;
	$sql = "UPDATE donhang AS a SET a.TrangThai = :status WHERE a.id_hd = :id";
	$stmt = $conn->prepare($sql);
	if ($stmt) {
		$stmt->bindParam(":id",$id,PDO::PARAM_INT);
		$stmt->bindParam(":status",$type,PDO::PARAM_INT);
		if ($stmt->execute()) {
			$flag  = TRUE;
		}
		$stmt->closeCursor();
	}
	disconnect($conn);
	return $flag;
}


function delete_order_modle($id){
	$conn = connection();
	$flag = FALSE;
	$sql = "DELETE FROM donhang  WHERE id_hd = :id";
	$stmt = $conn->prepare($sql);
	if ($stmt) {
		$stmt->bindParam(":id",$id,PDO::PARAM_INT);
		if ($stmt->execute()) {
			$flag  = TRUE;
		}
		$stmt->closeCursor();
	}
	disconnect($conn);
	return $flag;
}


function save_detail_order($id){
	$conn = connection();
	$flag = FALSE;
	$create_time = date("Y-m-d H:i:s");
	$update_time = '';
	$sql = "INSERT INTO chitiethoadon(id_dh,create_time,update_time) VALUES(:id_dh,:create_time,:update_time)";
	$stmt = $conn->prepare($sql);
	if ($stmt) {
		$stmt->bindParam(":id_dh",$id,PDO::PARAM_INT);
		$stmt->bindParam(":create_time",$create_time,PDO::PARAM_STR);
		$stmt->bindParam(":update_time",$update_time,PDO::PARAM_STR);
		if ($stmt->execute()) {
			$flag  = TRUE;
		}
		$stmt->closeCursor();
	}
	disconnect($conn);
	return $flag;
}
 ?>