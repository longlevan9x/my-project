    <style type="text/css">
    .table > tbody > tr > td {
      vertical-align: middle;
    }
    .myinput{width: 320px;}
    </style>
<div class="container">
    <?php if (!empty($mess1)): ?>
        <div class="row">
            <h3 class="text-center"><?php echo $mess1; ?></h3>
        </div>
    <?php endif ?>
    <?php if (!empty($mess2)): ?>
        <div class="row">
            <h3 class="text-center"><?php echo $mess2; ?></h3>
        </div>
    <?php endif ?>
    <?php if (!empty($mess3)): ?>
        <div class="row">
            <h3 class="text-center"><?php echo $mess3; ?></h3>
        </div>
    <?php endif ?>
    <?php if (!empty($mess4)): ?>
        <div class="row">
            <h3 class="text-center"><?php echo $mess4; ?></h3>
        </div>
    <?php endif ?>
<?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
    <?php $tong_tien = 0; ?>
    <div class="heading-bar">
        <a class="more-btn">Danh sách sản phẩm</a>
    </div>
    <div class="table_gio_hang">
        <form method="POST" action="?cn=cart&m=edit" id="form_gio_hang">
            <table class="table table-hover table-striped" style="margin: 0px;padding: 0px;">
                <tr>
                    <th>&nbsp;#</th>
                    <th>Tên sách</th>
                    <th class="center1">Giá</th>
                    <th class="center1">Số lượng</th>
                    <th class="center1" >Thành tiền</th>
                    <th>Xóa</th>
                </tr>
            <?php $i = 1; ?>
            <?php foreach ($_SESSION['cart'] as $key => $listCart): ?>
                <tr>
                    <td class="center1"><?php echo $i; ?></td>
                    <td><img src="<?php echo PATH_IMG_BOOK.$listCart['imgBook']; ?>" width="120" height="120" alt=""><p><?php echo $listCart['nameBook']; ?></p></td>
                    <td class="center1"><?php echo number_format($listCart['cost']); ?></td>
                    <td class="center1" ><input class="soluong1" required pattern="[0-9]{1,3}" title="Số lượng phải là chữ số và nhỏ hơn 4 kí tự" name="txtSoLuong[<?php echo $listCart['idBook']; ?>]" size="2" type="text" value="<?php echo $listCart['qty']; ?>"/></td>
                    <td  class="center1 img_gio_hang"><?php echo number_format($listCart['qty'] * $listCart['cost']); ?></td>
                    <td ><a onclick="deleteOneCart(<?php echo $listCart['idBook']; ?>);"> <i class="icon-trash"></i></a></td>
                </tr>
            <?php $tong_tien += ($listCart['qty'] * $listCart['cost']) ?>
            <?php $i++; ?>
            <?php endforeach ?>
                <tr>
                    <td colspan="5" style="text-align: right">
                        <span>Tổng tiền</span>
                    </td>
                    <td>
                        <span><?php echo number_format($tong_tien); ?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: right">
                        <a href="?cn=index" class="btn btn-danger">Tiếp tục mua hàng</a>
                        <button name="btnSubmit" style="" class="btn btn-info">Cập nhật giỏ hàng</button>
                        <a onclick="removeAllCart();" class="btn btn-warning">Xóa tất cả</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
<?php endif ?>
<script  type="text/javascript" charset="utf-8">
    function deleteOneCart(id){
        if (confirm("Bạn có chắc chắn xóa sản phẩm này.")) {
            window.location.href = "?cn=cart&m=delete&id="+id;
        }
        // else{
        //     window.location.href = "?cn=cart&m=index";
        // }
    }

    function removeAllCart() {
        if (confirm("Bạn có chắc chắn tất sản phẩm đã chọn.")) {
            window.location.href = "?cn=cart&m=remove";
        }
        // else{
        //     window.location.href = "?cn=cart&m=index";
        // }
    }
</script>
    <div class="heading-bar">
      <a class="more-btn">Tiến hành đặt hàng</a>
    </div>
    <div class="table_gio_hang">
      <form id="enableForm3" action="?cn=cart&m=orders" method="POST" class="form-horizontal">
        <div class="row">
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label class="col-md-5 control-label">Họ Tên (*)</label>
                <div class="col-md-7">
                  <input class="myinput" type="text" value="<?php echo get_session_fullname(); ?>" class="form-control" name="txtHoTen" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-5 control-label">Số điện thoại (*)</label>
                <div class="col-md-7">
                  <input class="myinput" type="text" value="<?php echo get_session_phone(); ?>" class="form-control" name="txtSoDienThoai" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-5 control-label">Email (*)</label>
                <div class="col-md-7">
                  <input class="myinput" type="email" value="<?php echo get_session_email(); ?>" class="form-control" name="txtEmail" />
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="form-group">
                <label class="col-md-5 control-label">Địa chỉ (*)</label>
                <div class="col-md-7">
                  <input class="myinput" type="text"  value="<?php echo get_session_address(); ?>" class="form-control" name="txtDiaChi" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-5 control-label">Ghi chú</label>
                <div class="col-md-7">
                  <textarea style="width: 550px;" name="txtGhiChu" ></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
                <input type="submit" name="btnSubmit" class="btn btn-info btn-block" value="Đặt hàng"/>
            </div>
        </div>
      </form>
    </div>
</div>