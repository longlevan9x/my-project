<?php
function get_session_fullname(){
	$fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : '';
	return $fullname;
}
function get_session_email(){
	$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
	return $email;
}
function get_session_phone(){
	$phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : '';
	return $phone;
}
function get_session_address(){
	$address = isset($_SESSION['address']) ? $_SESSION['address'] : '';
	return $address;
}

 ?>