<div id="right">
	<h2>Hiển thị Nhà xuất bản: <span><i><?php echo $data['TenNXB']; ?></i></span></h2>
    <section class="grid-holder features-books">
    <?php foreach ($dataPublisher as $key => $listPbSearch): ?>
    	<figure class="span4 slide first chinh1">
	            <a href="?cn=index&m=detail&name=<?php echo vn2latin($listPbSearch['TenSach']."-".$listPbSearch['id']); ?>"><img src="<?php echo PATH_IMG_BOOK . $listPbSearch['HinhAnh']; ?>" alt="<?php echo $listPbSearch['HinhAnh']; ?>" title="Xem chi tiết..." class="pro-img"/></a>
	            <p>
	                <span class="title">
	                    <a href="?cn=index&m=detail&name=<?php echo vn2latin($listPbSearch['TenSach']."-".$listPbSearch['id']); ?>" style="font-weight: bold;" title="<?php echo $listPbSearch['TenSach']; ?> - Xem chi tiết.."><?php echo $listPbSearch['TenSach']; ?></a>
	                </span>
	            </p>
	            <p>Tác giả:
	                <a class="nxb" href="? " title="<?php echo $listPbSearch['TenTG']; ?>"> <?php echo $listPbSearch['TenTG']; ?></a>
	            </p>
	            <p>Thể Loại:
	                <a class="nxb" href="? " title="<?php echo $listPbSearch['TenLoai']; ?>"> <?php echo $listPbSearch['TenLoai']; ?></a>
	            </p>
	            <p>Nhà xuất bản:
	                <a class="nxb" href="? " title="<?php echo $listPbSearch['TenNXB']; ?>"> <?php echo $listPbSearch['TenNXB']; ?></a>
	            </p>
	            <div class="cart-price">
	                <a class="cart-btn2" href="#">Thêm vào giỏ hàng</a>
	                <span class="price"><?php echo (!empty($listPbSearch['GiaMoi']) ? number_format($listPbSearch['GiaMoi']) : number_format($listPbSearch['GiaCu'])); ?>Đ</span>
	            </div>
	        </figure>
    <?php endforeach ?>
    </section>
</div>