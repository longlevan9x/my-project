<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng ký thành viên</title>
    <link rel="stylesheet" href="public/css/animate.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="public/css/style3.css">
    <script src="public/js/jquery-1.12.0.min.js"></script>
</head>
<body>
    <div class="container">
      <div class="login-box animated fadeInUp" style="max-width:340px">
      <h3><?php echo $dialog; ?></h3>
      <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
        <div>
          <ul>
              <?php foreach ($_SESSION['error'] as $key => $error): ?>
                <?php if (!empty($error)): ?>
                  <li><?php echo $error; ?></li>
                <?php endif ?>
              <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>
        <form action="?cn=signup&m=register" method="POST" >
          <div class="box-header">
            <h2>Đăng Ký</h2>
          </div>
          <label for="username">Tên đăng nhập</label>
          <br/>
          <input type="text" name="txtTenDangNhap" id="username">
          <br/>
          <label for="password">Mật khẩu</label>
          <br/>
          <input type="password" name="txtMatKhau" id="password">
          <br/>
          <label for="txtEmail">Email</label>
          <br/>
          <input type="email" name="txtEmail" id="txtEmail">
          <br/>
          <label for="txtHoTen">Họ Tên</label>
          <br/>
          <input type="text" name="txtHoTen" id="txtHoTen">
          <br/>
          <label for="txtAddress">Địa chỉ</label>
          <br/>
          <input type="text" name="txtAddress" id="txtAddress">
          <br/>
          <label for="txtPhone">Số Điện Thoại</label>
          <br/>
          <input type="text" name="txtPhone" id="txtPhone">
          <br/>
          <input type="submit" name="btnSubmit" value="Đăng ký"/>
          <input type="reset" name="btnReset" value="reset"/>
          <br/>
          <a href="?cn=login" title="">Đăng nhập</a>
          <span>|</span>
          <a href="?cn=index" title="">Trang chủ</a>
      </form>
    </div>
  </div>
</body>
</html>