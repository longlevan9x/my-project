
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            	<h3><?php $msg->display(); ?></h3>
            	<h2 class="text-center">Edit Author</h2>
            	<a href="?sk=author" title="" class="btn btn-warning"><i class="fa fa-step-backward" aria-hidden="true"></i>   Trở lại</a>
            	<br/><br/>
            	<form action="?sk=author&m=edit&id=<?php echo $dataEditAt['id_tg']; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="form-group">
						<label for="txtNameAuthor">Tên tác giả</label>
						<input type="text" class="form-control" id="txtNameAuthor" name="txtName" value="<?php echo $dataEditAt['TenTG']; ?>" placeholder="Tên tác giả....">
						<input type="hidden" class="form-control" id="hddName" name="hddName" value="<?php echo $dataEditAt['TenTG']; ?>">
					</div>
					<div class="form-group">
					    <label for="txtPhone">Số điện thoại</label>
					    <input type="text" class="form-control" id="txtPhone" name="txtPhone" value="<?php echo $dataEditAt['SDTTG']; ?>" placeholder="Điện thoại...">
					</div>
					<div class="form-group">
					    <label for="txtAddress">Địa chỉ</label>
					    <input type="text" class="form-control" id="txtAddress" name="txtAddress" value="<?php echo $dataEditAt['DiaChiTG']; ?>" placeholder="Địa chỉ...">
					</div>
					<div class="form-group">
					    <label for="txtAddress">Ảnh</label>
					    <img src="<?php echo PATH_IMG_AUTHOR.$dataEditAt['img_path']; ?>" alt="<?php echo $dataEditAt['img_path']; ?>" title="<?php echo $dataEditAt['img_path']; ?>" style="width: 100px;">
					</div>
					<div class="form-group">
					    <label for="txtFileLogo">Chọn Logo</label>
					    <input type="file" id="txtFileLogo" name="txtFileLogo">
					    <p class="help-block">Ví dụ: '.jpg','.png'.</p>
					    <input type="hidden" name="hddFileName" value="<?php echo $dataEditAt['img_path']; ?>">
					</div>
					<button type="submit" name="btnSubmitEdit" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span>  Sửa</button>
				</form>	
            </div>
        </div>
    </div>
</div>