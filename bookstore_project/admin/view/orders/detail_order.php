<div class="content-wrapper right_col">
<style type="text/css" media="screen">
  th, td {
    border-bottom: 1px solid #ddd;
}
div.search {
	margin-right: 20px;
}
input{
	height: 33px;
	margin-right: 5px;
	width: 300px;
	font-size: 17px;
}
</style>
<?php 
$array_trang_thai = [
		'Chờ xác nhận',
		'Đã xác nhận',
		'Đã hủy',
];
 ?>
<div class="row">
		<h2 class="text-center">Chi tiết đơn hàng !!!</h2>
</div>
<div class="row">
    <div class="col-md-12" style="border-bottom: 2px dotted green ; margin: 20px 0px;background-color: #CCFFFF;">
      <div class="col-md-2">
        <p>
          <img width="100%" height="250px;" src="<?php echo PATH_IMG_BOOK . $model['HinhAnh'];  ?>" alt="">
        </p>
        <h3 class="text-center"><?php echo $model['TenSach']; ?></h3>
      </div>
      <div class="col-md-10" style="background-color: white;">
        <div class="table-responsive">
          <table class="table table-bordered" style="margin-top: 10px;">
            <thead>
              <tr>
                <th>Mã đơn hàng</th>
                <td><?php echo $model['id_hd']; ?></td>
              </tr>
              <tr>
        		<th>Họ tên</th>
              	<td><?php echo $model['TenKH']; ?></td>
              </tr>
              <tr>
        		<th>Số điện thoại</th>
              	<td><?php echo $model['SDT']; ?></td>
              </tr>
              <tr>
        		<th>Email</th>
              	<td><?php echo $model['Email']; ?></td>
              </tr>
              <tr>
        		<th>Trạng thái</th>
              	<td><?php echo $array_trang_thai[$model['TrangThai']]; ?></td>
              </tr>
              <tr>
        		<th>Địa chỉ</th>
              	<td><?php echo $model['DiaChi']; ?></td>
              </tr>
              <tr>
        		<th>Số lượng</th>
              	<td><?php echo number_format($model['SoLuong']); ?></td>
              </tr>
              <tr>
        		<th>Tổng tiền</th>
              	<td><?php echo number_format($model['ThanhTien']); ?></td>
              </tr>
              <tr>
        		<th>Ghi chú</th>
              	<td><?php echo $model['GhiChu']; ?></td>
              </tr>
              <tr>
        		<th>Ngày đặt</th>
              	<td><?php echo $model['create_time']; ?></td>
              </tr>
          	<?php if (isset($_GET['type']) && $_GET['type'] == 0): ?>
              <tr>
              	<th>Hành động</th>
	                <td>
	                	<button type="button" class="btn btn-small btn-primary" onclick="update(<?php echo $model['id_hd']; ?>,1);">Xác nhận</button>
	                	<button type="button" class="btn btn-small btn-danger" onclick="update(<?php echo $model['id_hd']; ?>,2);"> Hủy</button>
	                </td>
              </tr>
            <?php endif ?>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" charset="utf-8" >
	function update(id,type) {
		$.ajax({
			url : "?sk=orders&m=update",
			type: 'POST',
			data: {id:id,type:type},
			success : function (data) {
				data = $.trim(data);
				if (data == "ok") {
					alert("thao tac thanh cong");
					window.location.href = "?sk=detailOrder&id="+id+"&type=" + type;
				}
				else if(data == "err"){
					alert("co loi xay ra");
					window.location.href = "?sk=detailOrder&id="+id+"&type=" + type;
				}
				else if(data == "errup"){
					alert("Xac nhan that bai");
					window.location.href = "?sk=detailOrder&id="+id+"&type=" + type;
				}
				else if(data == "errdl"){
					alert("xoa that bai");
					window.location.href = "?sk=detailOrder&id="+id+"&type=" + type;
				}
			}
		});
	}
</script>