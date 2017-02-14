<?php
    
 ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../public/css/animate.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../public/css/style3.css">
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
    <script src="../public/js/jquery-1.12.0.min.js"></script>
    <style type="text/css">
    </style>
</head>
<body>
    <div class="container">
            <div class="login-box animated fadeInUp" style="max-width:340px">
                <div class="row">
                    <?php if (isset($Flag)): ?>
                        <ul>
                            <?php foreach ($checkData as $key => $err): ?>
                                <?php if(!empty($err)): ?>
                                <li><?php echo $err; ?></li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </div>
                <div class="row">
                    <?php if (isset($mess)): ?>
                        <h3><?php echo $mess; ?></h3>
                    <?php endif ?>
                </div>
                <!-- <form action="index.php" method="POST" accept-charset="utf-8">
                    <div class="box-header">
                        <h2>Đăng nhập</h2>
                    </div>
                    <div class="form-group">
                        <label for="username">Tài khoản</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" class="form-control" id="username" name="txtTenDangNhap" aria-describedby="inputGroupSuccess1Status" placeholder="Tài khoản" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" class="form-control" name="txtMatKhau" id="password" aria-describedby="inputGroupSuccess1Status" placeholder="Mật khẩu">
                        </div>
                    </div>
                    <input type="submit" name="btnSubmit" class="btn btn-default" value="Đăng nhập"/>
                    <input type="reset" name="btnReset" value="reset"/>
                </form> -->
                <form action="index.php" method="POST" >
                    <div class="box-header">
                            <h2>Đăng nhập</h2>
                    </div>
                    <label for="username">Tên đăng nhập</label>
                    <br/>
                    <input type="text" name="txtTenDangNhap" id="username">
                    <br/>
                    <label for="password">Mật khẩu</label>
                    <br/>
                    <input type="password" name="txtMatKhau" id="password">
                    <br/>
                    <input type="submit" name="btnSubmit" value="Đăng nhập"/>
                    <input type="reset" name="btnReset" value="reset"/>
                </form>
            </div>
    </div>
</body>
</html>
