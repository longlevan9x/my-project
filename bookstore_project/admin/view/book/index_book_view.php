<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            	<h3><?php $msg->display(); ?></h3>
            	<h3 class="text-center">Add book</h3>
            	<div class="col-md-3">
            		<a href="?sk=book&m=add" title="" class="btn btn-info" style="margin-bottom:20px; ">
            		<i class="fa fa-plus-circle" aria-hidden="true"></i>  Thêm </a>

            		<a href="?sk=book" title="" class="btn btn-danger" style="margin-bottom:20px; ">View All</a>
            	</div>
            	<div class="col-md-9">
            		<button type="button" class="btn btn-info pull-right" id="btnsearch" name="btnsearch">Search</button>
            		<input type="text" class="form-control pull-right" style="width: 300px;" name="txtsearch" id="txtsearch" value="" placeholder="Enter keyword...">
            	</div>
            	<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Tên sách</th>
							<th>Ảnh bìa</th>
							<th>Giá cũ</th>
							<th>Giá mới</th>
							<th>Số lượng</th>
							<th>Số trang</th>
							<th>Nhà xuất bản</th>
							<th>Tác giả</th>
							<th>Thể loại</th>
							<th>Lượt xem</th>
							<th>Ngày đăng</th>
							<th colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
						 <?php $i = 1; ?>
						 <?php foreach ($dataAllBook as $key => $dataList): ?>
						 	<tr>
						 		<td><?php echo $i; ?></td>
						 		<?php $i++; ?>
						 		<td><?php echo $dataList['TenSach']; ?></td>
						 		<td><img style="width:100px;heith:100px;" src="<?php echo PATH_IMG_BOOK.$dataList['HinhAnh']; ?>" alt="<?php $dataList['HinhAnh']; ?>" title="<?php $dataList['HinhAnh']; ?>"></td>
						 		<td><?php echo number_format($dataList['GiaCu']); ?></td>
						 		<td><?php echo number_format($dataList['GiaMoi']); ?></td>
						 		<td><?php echo number_format($dataList['SoLuong']); ?></td>
						 		<td><?php echo number_format($dataList['SoTrang']); ?></td>
						 		<td><?php echo $dataList['TenNXB']; ?></td>
						 		<td><?php echo $dataList['TenTG']; ?></td>
						 		<td><?php echo $dataList['TenLoai']; ?></td>

						 		<!-- Tên nhà xuất bản -->
						 		<!-- <?php foreach ($dataPublisher as $key => $listPublisher): ?>
						 			<?php if ( $dataList['id_nxb'] == $listPublisher['id_nxb']): ?>
										<td><?php echo $listPublisher['TenNXB']; ?></td>
						 			<?php endif ?>
								<?php endforeach ?> -->
								<!-- Tên tác giả -->
						 		<!-- <?php foreach ($dataAuthor as $key => $listAuthor): ?>
						 			<?php if ( $dataList['id_tg'] == $listAuthor['id_tg']): ?>
										<td><?php echo $listAuthor['TenTG']; ?></td>
						 			<?php endif ?>
								<?php endforeach ?> -->
								<!-- Loại sách -->
						 		<!-- <?php foreach ($dataKindbook as $key => $listKind): ?>
						 			<?php if ( $dataList['id_loai'] === $listKind['id_loai']): ?>
										<td><?php echo $listKind['TenLoai']; ?></td>
						 			<?php endif ?>
								<?php endforeach ?> -->

						 		<td><?php echo $dataList['SoLuotXem']; ?></td>
						 		<td><?php echo $dataList['create_time']; ?></td>
						 		<td><a href="?sk=book&m=edit&id=<?php echo $dataList['id']; ?>" class="btn btn-primary">Edit</a></td>
						 		<td><a  onclick="deleteData(<?php echo $dataList['id']; ?>);" class="btn btn-primary">Delete</a></td> 
							</tr>
						 <?php endforeach ?>
					</tbody>
				</table>
				<?php echo $dataPaging['html']; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
	function deleteData(id) {
		if (confirm("Bạn có muốn xóa")) {
			window.location.href = "?sk=book&m=delete&id="+id;
		}
		else{
			window.location.href = "?sk=book";
		}
	}
	$(document).ready(function() {
		$('#btnsearch').click(function(){
			var keyword = $.trim($('#txtsearch').val());
			window.location.href = "?sk=book&m=index&page=1&keyword="+keyword;
		});
	});
</script>