
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            	<h3><?php $msg->display(); ?></h3>
            	<?php if (isset($_SESSION['error']) && !empty($_SESSION['error']) ): ?>
            		<div class="row">
            			<ul>
            				<?php foreach ($_SESSION['error'] as $key => $error): ?>
            					<?php if (!empty($error)): ?>
            						<li><?php echo $error; ?></li>
            					<?php endif ?>
            				<?php endforeach ?>
            			</ul>
            		</div>
            	<?php endif ?>
            	<h2 class="text-center">Add Book</h2>
            	<a href="?sk=book" title="" class="btn btn-warning"><i class="fa fa-step-backward" aria-hidden="true"></i>   Trở lại</a>
            	<br/><br/>
            	<form action="?sk=book&m=add" method="post" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="form-group">
						<label for="txtNamebook">Tên sách</label>
						<input type="text" class="form-control" id="txtNamebook" name="txtNamebook" placeholder="Tên sách....">
					</div>
					<div class="form-group">
						<label for="slcAuthor">Chọn tác giả</label> &nbsp;
						<select name="slcAuthor" id="slcAuthor" class="form-control" style="width: 300px;"> <!-- nhận giá trị ở thẻ value -->
							<?php foreach ($dataAuthor as $key => $listAuthor): ?>
								<option value="<?php echo $listAuthor['id_tg']; ?>"><?php echo $listAuthor['TenTG']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="slcPublisher">Chọn nhà xuất bản</label> &nbsp;
						<select name="slcPublisher" id="slcPublisher" class="form-control" style="width: 300px;"> 
							<?php foreach ($dataPublisher as $key => $listPublisher): ?>
								<option value="<?php echo $listPublisher['id_nxb']; ?>"><?php echo $listPublisher['TenNXB']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="slcKindBooks">Chọn thể loại sách</label> &nbsp;
						<select name="slcKindBooks" id="slcKindBooks" class="form-control" style="width: 300px;"> 
							<?php foreach ($dataKindbook as $key => $listKindbook): ?>
								<option value="<?php echo $listKindbook['id_loai']; ?>"><?php echo $listKindbook['TenLoai']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
					    <label for="txtFileLogo">Chọn ảnh sách</label>
					    <input type="file" id="txtFileLogo" name="txtFileLogo">
					    <p class="help-block">Ví dụ: jpg,png.</p>
					</div>
					<div class="form-group">
						<label for="txtCostBook">Giá ban đầu</label>
						<input type="text" class="form-control" id="txtCostBook" name="txtCostBook" placeholder="Giá sách....">
					</div>
					<div class="form-group">
						<label for="txtQTYbook">Số lượng sách</label>
						<input type="text" class="form-control" id="txtQTYbook" name="txtQTYbook" placeholder="Số lượng sách....">
					</div>
					<div class="form-group">
						<label for="txtPageBook">Số trang</label>
						<input type="text" class="form-control" id="txtPageBook" name="txtPageBook" placeholder="Số trang....">
					</div>
					<button type="submit" name="btnSubmit" class="btn btn-info">Thêm</button>
				</form>	
            </div>
        </div>
    </div>
</div>