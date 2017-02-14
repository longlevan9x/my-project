<?php
require_once 'app/config/database.php';
function checkLoginUser($username,$password){
	$data = array();
	$conn = connection();
	$sql  = "SELECT * FROM taikhoan AS a WHERE a.TenDangNhap = :username AND a.MatKhau = :password";
	$stmt = $conn->prepare($sql);
	if ($stmt) {
		$stmt->bindParam(":username",$username,PDO::PARAM_STR);
		$stmt->bindParam(":password",$password,PDO::PARAM_STR);
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
 ?>