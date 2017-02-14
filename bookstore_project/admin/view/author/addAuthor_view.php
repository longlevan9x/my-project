
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            	<h3><?php $msg->display(); ?></h3>
            	<h2 class="text-center">Add Author</h2>
            	<a href="?sk=author" title="" class="btn btn-warning"><i class="fa fa-step-backward" aria-hidden="true"></i>   Trở lại</a>
            	<br/><br/>
            	<form action="?sk=author&m=add" method="post" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="form-group">
						<label for="txtNameAuthor">Tên tác giả</label>
						<input type="text" class="form-control" id="txtNameAuthor" name="txtName" placeholder="Tên tác giả....">
					</div>
					<div class="form-group">
					    <label for="txtPhone">Số điện thoại</label>
					    <input type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder="Điện thoại...">
					</div>
					<div class="form-group">
					    <label for="txtAddress">Địa chỉ</label>
					    <input type="text" class="form-control" id="txtAddress" name="txtAddress" placeholder="Địa chỉ...">
					</div>
					<div class="form-group">
					    <label for="txtFileLogo">Chọn Logo</label>
					    <input type="file" id="txtFileLogo" name="txtFileLogo">
					    <p class="help-block">Ví dụ: '.jpg','.png'.</p>
					</div>
					<button type="submit" name="btnSubmit" class="btn btn-info">Thêm</button>
				</form>	
            </div>
        </div>
    </div>
</div>