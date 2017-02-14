
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            	<h2><?php $msg->display(); ?></h2>
            	<h2 class="text-center">Add kindbook</h2>
            	<a href="?sk=kindbook" title="" class="btn btn-warning"><i class="fa fa-step-backward" aria-hidden="true"></i>   Trở lại</a>
            	<br/><br/>
            	<form action="?sk=kindbook&m=add" method="post" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="form-group">
						<label for="txtNameKB">Tên thể loại sách</label>
						<input type="text" class="form-control" id="txtNameKB" name="txtNameKB" placeholder="Tên thể loại sách sách....">
					</div>
					<button type="submit" name="btnSubmit" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm</button>
				</form>	
            </div>
        </div>
    </div>
</div>