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
	<?php if (!empty($dataAllOrders)): ?>
        <?php $title = 'Danh sách đơn hàng !!!'; ?>
    <?php else: ?>
        <?php $title = 'Khong co don hang !!!'; ?>
    <?php endif ?>

    <div class="row">
				<h2 class="text-center"><?= $title; ?></h2>
		</div>
		<div class=" col-md-4" style="">
  	 		<div class="form-group">
  	 			<label for="input" class="col-sm-3 control-label">Trạng thái:</label>
  	 			<div class="col-sm-6">
  	 				<form action="?sk=orders" id="form-order" method="get" accept-charset="utf-8">
  	 					<select name="type" id="trangthai" class="form-control" required="required">
			  	 			<option value="0" <?php echo isset($_GET['type']) && $_GET['type'] == 0 ? 'selected' : '' ?>>Chờ xác nhận</option>
			  	 			<option value="1" <?php echo isset($_GET['type']) && $_GET['type'] == 1 ? 'selected' : '' ?>>Đã xác nhận</option>
			  	 			<option value="2" <?php echo isset($_GET['type']) && $_GET['type'] == 2 ? 'selected' : '' ?>>Đã hủy</option>
			  	 		</select>

  	 				</form>
                </div>
                <div class=" search col-sm-2" style="">
                    <a href="?sk=orders&m=export-excel" data-count-order="<?= count($dataAllOrders); ?>" id="export_excel" target="_blank" class="btn btn-primary pull-right">Xuất Excel</a>
                </div>
            </div>
		</div>
		<div class="row search col-md-7" style="">
  	 		<button type="button" name="btnSearch" class="btn btn-primary pull-right" id="btnSearch">Search</button>
  	 		<input type="text" name="txtsearch" id="txtsearch" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" class="pull-right" placeholder="Nhap tu tim kiem">
		</div>
  <?php foreach ($dataAllOrders as $key => $listOrder): ?>
  <div class="row">
    <div class="col-md-12" style="border-bottom: 2px dotted green ; margin: 20px 0px;background-color: #CCFFFF;">
      <div class="col-md-2">
        <p>
          <img width="100%" height="250px;" src="<?php echo PATH_IMG_BOOK . $listOrder['imgbook'];  ?>" alt="">
        </p>
        <h3 class="text-center"><?php echo $listOrder['namebook']; ?></h3>
      </div>
      <div class="col-md-10" style="background-color: white;">
        <div class="table-responsive">
          <table class="table table-bordered" style="margin-top: 10px;">
            <thead>
              <tr>
                <th>Mã đơn hàng</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <!-- <th>Address</th> -->
                <th>Trạng thái</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
	            <?php if (isset($_GET['type']) && $_GET['type'] == 0): ?>
            		<th colspan="2" class="text-center">Action</th>
                <?php endif ?>
              </tr>
            </thead>
            <tbody>
            <?php if (isset($listOrder['listorder'])): ?>
            	<?php $i=1; ?>
	            <?php foreach ($listOrder['listorder'] as $key => $val): ?>
	              	<tr>
		                <td><a href="?sk=detailOrder&id=<?= $val['id_hd'] ?>&type=<?= $val['TrangThai'] ?>"><?php echo $val['id_hd']; ?></a></td>
		                <td><?php echo $val['TenKH']; ?></td>
		                <td><?php echo $val['SDT']; ?></td>
		                <td><?php echo $val['Email']; ?></td>
		                <!-- <td><?php echo $val['DiaChi']; ?></td> -->
		                <td><?php echo $array_trang_thai[$val['TrangThai']]; ?></td>
		                <td><?php echo $val['SoLuong']; ?></td>
		                <td><?php echo number_format($val['ThanhTien']); ?></td>
		                <?php if (isset($_GET['type']) && $_GET['type'] == 0): ?>
			                <td>
			                	<button type="button" class="btn btn-small btn-primary" onclick="update(<?php echo $val['id_hd']; ?>,1);">Xác nhận</button>
			                </td>
			                <td>
			                	<button type="button" class="btn btn-small btn-danger" onclick="update(<?php echo $val['id_hd']; ?>,2);"> Hủy</button>
			                </td>
		                <?php endif ?>
	              	</tr>
	              <?php $i++; ?>
	            <?php endforeach ?>
            <?php endif ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>
<?php echo $dataPaging['html']; ?>
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
					window.location.reload(true);
				}
				else if(data == "err"){
					alert("co loi xay ra");
					window.location.reload(true);
				}
				else if(data == "errup"){
					alert("Xac nhan that bai");
					window.location.reload(true);
				}
				else if(data == "errdl"){
					alert("xoa that bai");
					window.location.reload(true);
				}
			}
		});
	}

	$(document).ready(function() {
		$('#btnSearch').click(function(){
			var keyword = $.trim($('#txtsearch').val());
			window.location.href = "?sk=orders&m=index&page=1&keyword="+keyword;
		});
		$('#trangthai').change(function (event) {
			// $('#form-order').submit();
			let type = $(this).val();
			window.location.href = "?sk=orders&m=index&page=1&type="+type;
		});
		$('#export_excel').click(function (event) {
		    event.preventDefault();
            let order_quantity = $(this).data('count-order');
            if (order_quantity <= 0) {
                alert("Không có dữ liệu để export");
            }
            else {
                window.location.href = $(this).attr('href') + "&type=" + <?php echo isset($_GET['type']) ? $_GET['type'] : '' ?>;
            }
        });
	});
</script>