<?php 
	require_once 'app/config/database.php';

	function get_list_all_book_modle(){
		$conn = connection();
		$data = array();
		$sql  = "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai 
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			ORDER BY a.create_time DESC";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
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

	// GET DATA PAGING
	function get_all_data_book_by_page($start,$limit,$keyword=''){
		$conn = connection();
		$data = array();
		$sql  = "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			ORDER BY a.create_time DESC
			LIMIT :start,:limitdata";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
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

	function getInfoDataBookById($id){
		$conn = connection();
		$data = array();
		$sql  = "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			WHERE a.id = :id LIMIT 1";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam("id",$id,PDO::PARAM_INT);
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

	function getTypeBook($id,$idbook){
		$conn = connection();
		$data = array();
		$sql  = "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			WHERE a.id_loai = :id AND a.id <> :idbook LIMIT 0,10";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam("id",$id,PDO::PARAM_INT);
			$stmt->bindParam("idbook",$idbook,PDO::PARAM_INT);
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

	// GET DATA PRICE
	function get_list_book_less_500_modle(){
		$conn = connection();
		$data = array();
		$sql  = "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai 
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			WHERE (GiaCu < 500001  AND GiaMoi < 500001) OR ( GiaMoi < 500001 AND GiaMoi > 0)
			ORDER BY a.create_time DESC";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
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

	function get_list_book_L1000_modle(){
		$conn = connection();
		$data = array();
		$sql  =  "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai 
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			WHERE ((a.GiaCu BETWEEN 500000 AND 1000000)
				AND ((a.GiaMoi BETWEEN 500000 AND 1000000) OR a.GiaMoi <1))
				OR ( GiaMoi BETWEEN 500000 AND 1000000)
			ORDER BY a.create_time DESC";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
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

	function get_list_book_T1000_modle(){
		$conn = connection();
		$data = array();
		$sql  =  "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time, b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai 
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			WHERE (GiaCu >= 1000000  AND (GiaMoi >= 1000000 OR GiaMoi <1)) OR ( GiaMoi >= 1000000)
			ORDER BY a.create_time DESC";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
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
	// END GET DATA FOLLOW PRICE
	// 
	// INSERT ORDER
	function insertOrderCustom($idsach,$fullname,$phone,$email,$address,$ghichu,$qty,$money){
		$flag = FALSE;
		$conn = connection();
		$status = 0;
		$create_time = date("Y-m-d H:i:s");
		$update_time = '';
		$sql  = "INSERT INTO donhang(id_sach,TenKH,SDT,Email,DiaChi,GhiChu,SoLuong,ThanhTien,TrangThai,create_time,update_time) VALUES(:id_sach,:TenKH,:SDT,:Email,:DiaChi,:GhiChu,:SoLuong,:ThanhTien,:TrangThai,:create_time,:update_time);";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":id_sach",$idsach,PDO::PARAM_INT);
			$stmt->bindParam(":TenKH",$fullname,PDO::PARAM_STR);
			$stmt->bindParam(":SDT",$phone,PDO::PARAM_STR);
			$stmt->bindParam(":Email",$email,PDO::PARAM_STR);
			$stmt->bindParam(":DiaChi",$address,PDO::PARAM_STR);
			$stmt->bindParam(":GhiChu",$ghichu,PDO::PARAM_STR);
			$stmt->bindParam(":SoLuong",$qty,PDO::PARAM_INT);
			$stmt->bindParam(":ThanhTien",$money,PDO::PARAM_STR);
			$stmt->bindParam(":TrangThai",$status,PDO::PARAM_INT);
			$stmt->bindParam(":create_time",$create_time,PDO::PARAM_STR);
			$stmt->bindParam(":update_time",$update_time,PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flag = TRUE;
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $flag;
	}


	function update_view_modle($id,$view){
		// if ($view > 0) {
		// 	$view++;
		// }
		// else{
		// 	$view = 1;
		// }
		 $view = ($view > 0) ? ++$view : 1;
		// ($view > 0) ? $view++ : 1;
		$flag = FALSE;
		$conn = connection();
		$sql = "UPDATE sach AS a SET a.SoLuotXem = :view WHERE a.id = :id";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":view",$view,PDO::PARAM_INT);
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