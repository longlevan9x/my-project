<?php 
	require_once 'app/config/database.php';

	function get_data_book_by_keyword($keyword){
		$data = array();
		$conn = connection();
		$key  = "%" . $keyword . "%";
		$sql  = "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time,
			b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			WHERE a.TenSach LIKE :key OR b.TenNXB LIKE :key OR c.TenTG LIKE :key OR d.TenLoai LIKE :key
			ORDER BY a.create_time DESC";
		$stmt = $conn->prepare($sql);
		if ($stmt){
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


	function get_data_book_by_page($start,$limit,$keyword){
		$data = array();
		$conn = connection();
		$key  = "%" . $keyword . "%";
		$sql  = "SELECT a.id,a.TenSach, a.HinhAnh, a.GiaCu, a.GiaMoi, a.SoLuong, a.SoTrang, a.SoLuotXem, a.create_time,
			b.id_nxb, b.TenNXB, c.id_tg, c.TenTG, d.id_loai, d.TenLoai
			FROM sach AS a
			INNER JOIN nhaxuatban AS b ON a.id_nxb  = b.id_nxb
			INNER JOIN tacgia     AS c ON a.id_tg   = c.id_tg
			INNER JOIN loaisach   AS d ON a.id_loai = d.id_loai
			WHERE a.TenSach LIKE :key OR b.TenNXB LIKE :key OR c.TenTG LIKE :key OR d.TenLoai LIKE :key
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
 ?>