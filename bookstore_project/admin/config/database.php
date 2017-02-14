<?php

// lay du lieu tren serveer
	function connection(){
    try{
        $dbh = new PDO('mysql:host=mysql.hostinger.vn;dbname=u885733760_book;charset=utf8','u885733760_long', 'q1234567');
        return $dbh;

    }
    catch (PDOException $e) {
       	 	print "Error!: " . $e->getMessage() . "<br/>";
        	die();
   		}
	}

	function disconnect($conn)
	{
   	 $conn = null;
	}
 ?>