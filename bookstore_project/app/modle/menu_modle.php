<?php 
	require_once 'app/config/database.php';

	// GET DATA AUTHOR
	function get_all_author_modle(){
		$conn = connection();
		$data = array();
		$sql  = "SELECT * FROM tacgia";
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

	// GET DATA TYPE BOOK
	function get_all_type_book_modle(){
		$conn = connection();
		$data = array();
		$sql  = "SELECT * FROM loaisach";
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

	// GET DATA PUBLISHER
	function get_all_publisher_modle(){
		$conn = connection();
		$data = array();
		$sql  = "SELECT * FROM nhaxuatban";
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
 ?>