<?php 
    ob_start(); // khai báo nơi lưu dữu liệu tạm thời trên server
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>T3H - Hà Nội PHP1608E</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link href="../../public/css/styleadmin.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../public/css/font-awesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../public/css/AdminLTE.min.css">
        <link rel="stylesheet" href="../../public/css/_all-skins.min.css">
        <!-- jquery -->
        <script src="../../public/js/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="../../public/js/bootstrap.min.js"></script>
        <script src="../../public/js/app.min.js"></script>
        <script src="../../public/js/admin1.js"></script>
        <script src="../../public/js/formValidation.min1.js" type="text/javascript"></script>
        <script src="../../public/js/formValidation.min2.js" type="text/javascript"></script>
    </head>
    <?php 
        ob_flush(); // xóa bỏ đi dữ liệu tạm thời trên server
     ?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="home.php?sk=index" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>LT</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>LTE</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="../../public/images/ars.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Xin chào <?php echo (isset($_SESSION['username']) ? $_SESSION['username'] : ''); ?> </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="../../public/images/ars.png" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo (isset($_SESSION['username']) ? $_SESSION['username'] : ''); ?>
                                            <br>
                                            Web Developer
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Đổi mật khẩu</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="../logout.php" class="btn btn-default btn-flat">Đăng xuất</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
        