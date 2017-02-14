<?php ob_start(); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Cửa Hàng sách PHP1608E</title>
        <meta http-equiv="cache-control" content="no-cache"/>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1"/>
        <meta name="viewport" content="width=device-width"/>
        <link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style1.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bs.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/range-slider.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/edit_menu_right.css" rel="stylesheet" type="text/css"/>
        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="public/js/lib.js"></script>
        <script type="text/javascript" src="public/js/bxslider.js"></script>
        <script src="public/js/range-slider.js"></script>
        <script src="public/js/jquery.zoom.js"></script>
        <script type="text/javascript" src="public/js/bookblock.js"></script>
        <script type="text/javascript" src="public/js/custom.js"></script>
        <script type="text/javascript" src="public/js/social.js"></script>
        <script src="public/js/formValidation.min1.js" type="text/javascript"></script>
        <script src="public/js/formValidation.min2.js" type="text/javascript"></script>
        <script src="public/js/index1.js" type="text/javascript"></script>
        <script type="text/javascript">
          $(document).ready(function() {
          $('.social_active').hoverdir( {} );
          $('#ex1').zoom();
        });
        </script>
    </head>
<?php ob_flush(); ?>
    <body>
        <div class="wrapper">
            <header id="main-header">
                <section class="container-fluid container">
                    <section class="row-fluid">
                        <section class="span4">
                            <h1 id="logo"> <a href="?cn=index"><img src="public/images/logo.png"/></a> </h1>
                        </section>
                        <section class="span8">
                            <ul class="top-nav2">
                            <?php if (isset($_SESSION['fullname']) && !empty($_SESSION['fullname'])): ?>
                                <li><a href="#">Hello:  <?php echo $_SESSION['fullname']; ?></a></li>
                            <?php endif ?>

                            <?php if (!isset($_SESSION['fullname']) && empty($_SESSION['fullname'])): ?>
                                <li><a href="?cn=login">Đăng nhập</a></li>
                            <?php endif ?>
                                <li><a href="?cn=signup">Đăng kí</a></li>
                                <li><a href="?cn=cart">Giỏ hàng <i class="fa fa-shopping-cart" aria-hidden="true"></i><span style="color: red"> &nbsp;&nbsp;&nbsp; <?php echo (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0; ?></span></a></li>
                            <?php if (isset($_SESSION['fullname']) && !empty($_SESSION['fullname'])): ?>
                                <li><a href="?cn=logout">Thoát</a></li>
                            <?php endif ?>
                            </ul>
                            <div class="col-xs-12 ">

                                <input id="txtsearch" class="col-md-6 col-xs-10" name="" type="text" style="" placeholder="Tìm kiếm" />
                                <button id="btnSearch" class="btn btn-info" type="button" style="height: 35px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </section>
                    </section>
                </section>
                <button id="menu1" style="font-size: 23px;background-color: #E5E5E5;height: 40px;line-height: 40px; width: 40px; text-align: center  " class="navbar-toggler pull-xs-right hidden-sm-up collapsed" type="button" data-toggle="collapse" data-target=".menu1" aria-expanded="false">
                    ☰
                </button>
                <nav id="nav">
                    <nav class="navbar menu1">
                        <div class="container-fluid">
                            <ul class="nav navbar-nav">
                                <li> <a href="?cn=index">Trang chủ</a> </li>
                                <li><a href="?cn=home&method=gioithieu">Giới thiệu</a></li>
                                <li><a href="?cn=khuyenmai">Khuyến mãi</a></li>
                                <li><a href="?cn=hotro">Hỗ trợ khách hàng</a></li>
                                <li><a href="?cn=home&method=lienhe">Liên hệ & Địa chỉ</a></li>
                            </ul>
                        </div>
                    </nav>
                </nav>
            </header>
            <script type="text/javascript" charset="utf-8">
                $(document).ready(function() {
                    $("#btnSearch").click(function () {
                        var keyword = $.trim($('#txtsearch').val());
                        if (keyword.length > 3) {
                            window.location.href = "?cn=search&m=index&page=1&keyword="+keyword;
                        }
                        else{
                            alert("Vui lòng nhập nhiều hơn 3 ký tự ");
                        }
                    });
                });
            </script>