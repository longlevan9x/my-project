<?php
	require_once 'config/database.php';

	function checklogin_modle($user,$pass){
		$data = array();
		$conn = connection();
		$sql  = "SELECT * FROM admin WHERE username = :user AND password = :pass";
		$stmt = $conn->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(":user",$user,PDO::PARAM_STR);
			$stmt->bindParam(":pass",$pass,PDO::PARAM_STR);
			if ($stmt->execute()) {
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
			}
			$stmt->closeCursor();
		}
		disconnect($conn);
		return $data;
	}
 ?>