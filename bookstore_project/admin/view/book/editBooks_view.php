
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            	<h3><?php $msg->display(); ?></h3>
            	<br/><br/>
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
            	<h2 class="text-center">Edit Book</h2>
            	<a href="?sk=book" title="" class="btn btn-warning"><i class="fa fa-step-backward" aria-hidden="true"></i>   Trở lại</a>
            	<br/><br/>
            	<form action="?sk=book&m=edit&id=<?php echo $dataBook['id']; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="form-group">
						<label for="txtNamebook">Tên sách</label>
						<input type="text" class="form-control" id="txtNamebook" name="txtNamebook" value="<?php echo $dataBook['TenSach']; ?>" placeholder="Tên sách....">
						<input type="hidden" name="hddNameB" value="<?php echo $dataBook['TenSach']; ?>">
					</div>
					<div class="form-group">
						<label for="slcAuthor">Chọn tác giả</label> &nbsp;
						<select name="slcAuthor" id="slcAuthor" class="form-control" style="width: 300px;"> <!-- nhận giá trị ở thẻ value -->
							<?php foreach ($dataAuthor as $key => $listAuthor): ?>
								<option value="<?php echo $listAuthor['id_tg']; ?>" <?php echo ($listAuthor['id_tg'] == $dataBook['id_tg']) ? 'selected="selected"' : ''; ?> ><?php echo $listAuthor['TenTG']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="slcPublisher">Chọn nhà xuất bản</label> &nbsp;
						<select name="slcPublisher" id="slcPublisher" class="form-control" style="width: 300px;"> 
							<?php foreach ($dataPublisher as $key => $listPublisher): ?>
								<option value="<?php echo $listPublisher['id_nxb']; ?>" <?php echo ($listPublisher['id_nxb'] == $dataBook['id_nxb']) ? 'selected="selected"' : ''; ?> ><?php echo $listPublisher['TenNXB']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="slcKindBooks">Chọn thể loại sách</label> &nbsp;
						<select name="slcKindBooks" id="slcKindBooks" class="form-control" style="width: 300px;"> 
							<?php foreach ($dataKindbook as $key => $listKindbook): ?>
								<option value="<?php echo $listKindbook['id_loai']; ?>" <?php echo ($listKindbook['id_loai'] == $dataBook['id_loai']) ? 'selected="selected"' : ''; ?> ><?php echo $listKindbook['TenLoai']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label for="slcSttBooks">Thông tin hàng</label> &nbsp;
						<select name="slcSttBooks" id="slcSttBooks" class="form-control" style="width: 300px;"> 
							<option value="1">Còn hàng</option>
							<option value="0">Hết hàng</option>
						</select>
					</div>
					<div class="form-group">
						<label>Ảnh sách</label><br>
					    <img src="<?php echo PATH_IMG_BOOK.$dataBook['HinhAnh']; ?>" alt="" style="width:120px;" title="<?php echo $dataBook['HinhAnh']; ?>">
					    <input type="hidden" name="txtHddFile" value="<?php echo $dataBook['HinhAnh']; ?>">
					</div>
					<div class="form-group">
					    <label for="txtFileLogo">Chọn ảnh sách mới</label>
					    <input type="file" id="txtFileLogo" name="txtFileLogo" >
					    <p class="help-block">Ví dụ: jpg,png.</p>
					</div>
					<div class="form-group">
						<label for="txtCostBook">Giá ban đầu</label>
						<input type="text" class="form-control" id="txtCostBook" name="txtCostBook" value="<?php echo $dataBook['GiaCu']; ?>" readonly="true" placeholder="Giá sách....">
					</div>
					<div class="form-group">
						<label for="txtNewCostBook">Giá mới</label>
						<input type="text" class="form-control" id="txtNewCostBook" name="txtNewCostBook" value="" placeholder="Giá mới....">
					</div>
					<div class="form-group">
						<label for="txtQTYbook">Số lượng sách</label>
						<input type="text" class="form-control" id="txtQTYbook" name="txtQTYbook" value="<?php echo $dataBook['SoLuong']; ?>" placeholder="Số lượng sách....">
					</div>
					<div class="form-group">
						<label for="txtPageBook">Số trang</label>
						<input type="text" class="form-control" id="txtPageBook" name="txtPageBook" value="<?php echo $dataBook['SoTrang']; ?>" placeholder="Số trang....">
					</div>
					<div class="form-group">
						<label for="txtCreateDate">Ngày tạo</label>
						<input type="text" class="form-control" id="txtCreateDate" name="txtCreateDate" value="<?php echo $dataBook['create_time']; ?>" readonly="true" placeholder="Số trang....">
					</div>
					<button type="submit" name="btnSubmitEdit" class="btn btn-info">Sửa</button>
				</form>	
            </div>
        </div>
    </div>
</div>
<!-- không được sửa tên, ngày khởi tạo -->