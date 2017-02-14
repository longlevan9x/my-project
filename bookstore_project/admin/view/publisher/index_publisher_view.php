
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
           	 	<h3><?php echo $msg->display(); ?></h3>
            	<h3 class="text-center">Nhà xuất bản</h3>
            	<div class="col-md-3">
            		<a href="?sk=publisher&m=add" title="" class="btn btn-info" style="margin-bottom:20px; ">
            		<i class="fa fa-plus-circle" aria-hidden="true"></i>  Thêm</a>
            		<a href="?sk=publisher" title="" class="btn btn-danger" style="margin-bottom:20px; ">View All</a>
            	</div>
            	<div class="col-md-9">
            		<button type="button" class="btn btn-info pull-right" id="btnsearch" name="btnsearch">Search</button>
            		<input type="text" class="form-control pull-right" style="width: 300px;" name="txtsearch" id="txtsearch" value="<?php echo $keyword; ?>" placeholder="Enter keyword...">
            	</div>
            	<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Logo</th>
							<th>Phone</th>
							<th>Address</th>
							<th>create Time</th>
							<th colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
						 <?php $i = 1; ?>
						 <?php foreach ($dataPublisher as $key => $dataList): ?>
						 	<tr>
						 		<td><?php echo $i; ?></td>
						 		<?php $i++; ?>
						 		<td><?php echo $dataList['TenNXB']; ?></td>
						 		<td><img style="width:100px;heith:100px;" src="<?php echo PATH_IMG_PUBLISHER.$dataList['logo_NXB']; ?>" alt="<?php $dataList['logo_NXB']; ?>"></td>
						 		<td><?php echo $dataList['SDTNXB']; ?></td>
						 		<td><?php echo $dataList['DiaChiNXB']; ?></td>
						 		<td><?php echo $dataList['create_time']; ?></td>
						 		<td><a href="?sk=publisher&m=edit&id=<?php echo $dataList['id_nxb']; ?>" class="btn btn-primary">Edit</a></td>
						 		<td><a  onclick="deleteData(<?php echo $dataList['id_nxb']; ?>);" class="btn btn-primary">Delete</a></td>
							</tr>
						 <?php endforeach ?>
					</tbody>
				</table>
				<?php echo $dataPaging['html']; ?>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript" charset="utf-8" >
	function deleteData(id) {
		if (confirm("Bạn có muốn xóa?")) {
			window.location.href = "?sk=publisher&m=delete&id="+id;
		}
		else{
			window.location.href = "?sk=publisher";
		}
	}

	$(document).ready(function() {
		$('#btnsearch').click(function(){
			var keyword = $.trim($("#txtsearch").val());
			window.location.href = "?sk=publisher&m=index&page=1&keyword="+keyword;
		});
	});
</script>

