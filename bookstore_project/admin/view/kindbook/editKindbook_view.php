<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            	<h2><?php $msg->display(); ?></h2>
            	<h2 class="text-center">Edit Kindbook</h2>
            	<a href="?sk=kindbook" title="" class="btn btn-warning"><i class="fa fa-step-backward" aria-hidden="true"></i>   Trở lại</a>
            	<br/><br/>
            	<form action="?sk=kindbook&m=edit&id=<?php echo $dataKb['id_loai']; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            		<div class="form-group">
						<label for="txtNameKB">Tên thể loại sách</label>
						<input type="text" class="form-control" id="txtNameKB" name="txtNameKB" value="<?php echo $dataKb['TenLoai']; ?>" placeholder="Tên thể loại sách sách....">
						<input type="hidden" class="form-control" id="hddName" name="hddName" value="<?php echo $dataKb['TenLoai']; ?>">
					</div>
					<button type="submit" name="btnSubmitEdit" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span>&nbsp;Sửa</button>
            	</form>
            </div>
        </div>
    </div>
</div>