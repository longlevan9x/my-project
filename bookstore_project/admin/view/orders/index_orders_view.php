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
	<?php if (!empty($dataAllOrders)): ?>
		<div class="row">
		<h2 class="text-center">Danh sách đơn hàng !!!</h2>
		</div>
		<div class="row search" style="">
  	 <button type="button" name="btnSearch" class="btn btn-primary pull-right" id="btnSearch">Search</button>
  	 <input type="text" name="txtsearch" id="txtsearch" class="pull-right" placeholder="Nhap tu tim kiem">
		</div>
	<?php else: ?>
	  <div class="row">
	    <h2 class="text-center">Khong co don hang !!!</h2>
	  </div>
	<?php endif ?>
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
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Qty</th>
                <th>Money</th>
                <th>Create</th>
                <th>Note</th>
                <th colspan="2" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php if (isset($listOrder['listorder'])): ?>
            	<?php $i=1; ?>
	            <?php foreach ($listOrder['listorder'] as $key => $val): ?>
	              	<tr>
		                <td><?php echo $i; ?></td>
		                <td><?php echo $val['TenKH']; ?></td>
		                <td><?php echo $val['SDT']; ?></td>
		                <td><?php echo $val['Email']; ?></td>
		                <td><?php echo $val['DiaChi']; ?></td>
		                <td><?php echo $val['SoLuong']; ?></td>
		                <td><?php echo number_format($val['ThanhTien']); ?></td>
		                <td><?php echo $val['create_time']; ?></td>
		                <td><?php echo $val['GhiChu']; ?></td>
		                <td><button type="button" class="btn btn-small btn-primary" onclick="update(<?php echo $val['id_hd']; ?>,1);">Xác nhận</button></td>
		                <td><button type="button" class="btn btn-small btn-danger" onclick="update(<?php echo $val['id_hd']; ?>,2);"> Hủy</button></td>
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
	});
</script>