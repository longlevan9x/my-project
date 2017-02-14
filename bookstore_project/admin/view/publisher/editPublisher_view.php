
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            	<h2><?php $msg->display(); ?></h2>
            	<h2 class="text-center">Edit Publisher</h2>
            	<a href="?sk=publisher" title="" class="btn btn-warning"><i class="fa fa-step-backward" aria-hidden="true"></i>   Trở lại</a>
            	<br/><br/>
            	<form action="?sk=publisher&m=edit&id=<?php echo $dataInfo['id_nxb']; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="form-group">
						<label for="txtNamePublisher">Tên nhà xuất bản</label>
						<input type="text" class="form-control" id="txtNamePublisher" name="txtName" value="<?php echo $dataInfo['TenNXB']; ?>" placeholder="Tên nhà xuất bản....">
						<input type="hidden" name="hddNametb" value="<?php echo $dataInfo['TenNXB']; ?>"/>
					</div>
					<div class="form-group">
					    <label for="txtPhone">Số điện thoại</label>
					    <input type="text" class="form-control" id="txtPhone" name="txtPhone" value="<?php echo $dataInfo['SDTNXB']; ?>" placeholder="Điện thoại...">
					</div>
					<div class="form-group">
					    <label for="txtAddress">Địa chỉ</label>
					    <input type="text" class="form-control" id="txtAddress" name="txtAddress" value="<?php echo $dataInfo['DiaChiNXB']; ?>" placeholder="Địa chỉ...">
					</div>
					<div class="form-group">
					    <label for="txtDateCreate">Ngày tạo</label>
					    <input type="text" class="form-control" id="txtDateCreate" name="txtDateCreate" value="<?php echo $dataInfo['create_time']; ?>"  readonly="true" placeholder="Ngày tạo..">
					</div>
					<div class="form-group">
						<p>Logo</p>
					    <img  style="width: 100px;" src="<?php echo PATH_IMG_PUBLISHER.$dataInfo['logo_NXB']; ?>" alt="<?php echo $dataInfo['logo_NXB']; ?>" />
					</div>
					<div class="form-group">
					    <label for="txtFileLogo">Chọn Logo mới</label>
					    <input type="file" id="txtFileLogo" name="txtFileLogo" src="<?php echo PATH_IMG_PUBLISHER.$dataInfo['logo_NXB']; ?>" />
					    <input type="hidden" name="hddFile" value="<?php echo $dataInfo['logo_NXB']; ?>">
					    <p class="help-block">'.jpg','.png'.</p>
					</div>
					<button type="submit" name="btnSubmitEdit" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span>Sửa.</button>
				</form>
            </div>
        </div>
    </div>
</div>
<!-- không được sửa tên, ngày khởi tạo -->