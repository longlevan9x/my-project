<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/css/animate.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="public/css/style3.css">
    <script src="public/js/jquery-1.12.0.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="login-box animated fadeInUp" style="max-width:340px">
    <?php if (isset($_SESSION['error']) AND !empty($_SESSION['error'])): ?>
        <div class="row">
            <ul>
            <?php foreach ($_SESSION['error'] as $k => $v): ?>
                <?php if (!empty($v)): ?>
                    <li><?php echo $v; ?></li>
                <?php endif ?>
            <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <?php if (isset($_SESSION['error1']) AND !empty($_SESSION['error1'])): ?>
        <div class="row">
            <ul>
                <li><?php echo $_SESSION['error1']; ?></li>
            </ul>
        </div>
    <?php endif ?>

      <form action="?cn=login&m=logins" method="POST" accept-charset="utf8">
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
        <br/>
        <a href="?cn=signup" title="">Đăng ký</a>
        <span>|</span>
        <a href="?cn=index" title="">Trang chủ</a>
      </form>
    </div>
  </div>
</body>
</html>