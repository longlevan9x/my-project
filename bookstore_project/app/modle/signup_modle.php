<?php 
require_once 'app/config/database.php';

function add_member_modle($username,$password,$email,$fullname,$address,$phone,$authenkey){
	$flag = 0;
	$status = 1;
	$role = 0;
	$createTime = date("Y-m-d H:i:s");
	$updateTime = '';
	$conn = connection();
	$sql  = "INSERT INTO taikhoan(TenDangNhap,MatKhau,Email,TenHienThi,DiaChi,SDT,Quyen,Trang_thai,authen_key,create_time,update_time) VALUES(:TenDangNhap,:MatKhau,:Email,:TenHienThi,:DiaChi,:SDT,:Quyen,:Trang_thai,:authen_key,:create_time,:update_time);";
	$stmt = $conn->prepare($sql);
	if ($stmt) {
		$stmt->bindParam(":TenDangNhap",$username,PDO::PARAM_STR);
		$stmt->bindParam(":MatKhau",$password,PDO::PARAM_STR);
		$stmt->bindParam(":Email",$email,PDO::PARAM_STR);
		$stmt->bindParam(":TenHienThi",$fullname,PDO::PARAM_STR);
		$stmt->bindParam(":DiaChi",$address,PDO::PARAM_STR);
		$stmt->bindParam(":SDT",$phone,PDO::PARAM_STR);
		$stmt->bindParam(":Quyen",$role,PDO::PARAM_STR);
		$stmt->bindParam(":Trang_thai",$status,PDO::PARAM_STR);
		$stmt->bindParam(":authen_key",$authenkey,PDO::PARAM_STR);
		$stmt->bindParam(":create_time",$createTime,PDO::PARAM_STR);
		$stmt->bindParam(":update_time",$updateTime,PDO::PARAM_STR);
		if ($stmt->execute()) {
			$flag = $conn->lastInsertId();
		}
		$stmt->closeCursor();
	}
	disconnect($conn);
	return $flag;
}

function get_info_user($id){
	$data = array();
	$conn = connection();
	$sql  = "SELECT * FROM taikhoan WHERE id_tk = :id";
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

// ACTIVE ACCOUNT
function active_account_user($id){
	$conn = connection();
	$flag = FALSE;
	$status = 1;
	$sql  = "UPDATE taikhoan SET Trang_thai = :status WHERE id_tk = :id";
	$stmt = $conn->prepare($sql);
	if ($stmt) {
		$stmt->bindParam(":id",$id,PDO::PARAM_INT);
		$stmt->bindParam(":status",$status,PDO::PARAM_INT);
		if ($stmt->execute()) {
			$flag = TRUE;
		}
		$stmt->closeCursor();
	}
	disconnect($conn);
	return $flag;
}
 ?>