<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            	<?php $msg->display(); ?>
            	<h3 class="text-center">Kindbook</h3>
            	<div class="col-md-3">
            		<a href="?sk=kindbook&m=add" title="" class="btn btn-info" style="margin-bottom:20px; ">
            		<i class="fa fa-plus-circle" aria-hidden="true"></i>  Thêm </a>

            		<a href="?sk=kindbook" title="" class="btn btn-danger" style="margin-bottom:20px; ">View All</a>
            	</div>
            	<div class="col-md-9">
            		<button type="button" class="btn btn-info pull-right" id="btnsearch" name="btnsearch">Search</button>
            		<input type="text" class="form-control pull-right" style="width: 300px;" name="txtsearch" id="txtsearch" value="" placeholder="Enter keyword...">
            	</div>
            	<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>create Time</th>
							<th colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						 <?php foreach ($dataAllKb as $key => $dataList): ?>
						 	<tr>
						 		<td><?php echo $i; ?></td>
						 		<?php $i++; ?>
						 		<td><?php echo $dataList['TenLoai']; ?></td>
						 		<td><?php echo $dataList['create_time']; ?></td>
						 		 <td><a href="?sk=kindbook&m=edit&id=<?php echo $dataList['id_loai']; ?>" class="btn btn-primary">Edit</a></td>
						 		<td><a  onclick="deleteData(<?php echo $dataList['id_loai']; ?>);" class="btn btn-primary">Delete</a></td>
							</tr>
						 <?php endforeach ?>
					</tbody>
				</table>
				<?php echo $dataPaging['html']; ?> <!-- Hiển thị phân trang -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
	function deleteData(id) {
		if (confirm("Bạn có muốn xóa?")) {
			window.location.href = "?sk=kindbook&m=delete&id="+id;
		}
		else{
			window.location.href = "?sk=kindbook";
		}
	}

	$(document).ready(function() {
		$('#btnsearch').click(function () {
			keyword = $.trim($('#txtsearch').val());
			window.location.href = "?sk=kindbook&m=index&page=1&keyword="+keyword;
		})
	});
</script>
