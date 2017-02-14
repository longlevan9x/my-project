<?php 
if (isset($_SESSION['username']) AND !empty($_SESSION['username'])) {
	unset($_SESSION['username']);
	unset($_SESSION['email']);
	unset($_SESSION['phone']);
	unset($_SESSION['fullname']);
	unset($_SESSION['address']);
	header("Location: ?cn=index");
}

 ?>