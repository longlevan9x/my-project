<?php
    session_start();
    setcookie("admin","admin",time()+3600,"/","",0); // thiết lập cookie

    require_once 'modle/login_modle.php';
    require_once 'controller/login.php';
    require_once 'view/index_view.php';
 ?>
