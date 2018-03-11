<?php
	function connection(){
    	try{
        	$dbh = new PDO('mysql:host=localhost;dbname=bookstore;charset=utf8','root', '');
        	return $dbh;
    	}
    	catch (PDOException $e) {
       	 	print "Error!: " . $e->getMessage() . "<br/>";
        	die();
   		}
	}

	function disconnect($conn){
   	 	$conn = null;
	}
 ?>