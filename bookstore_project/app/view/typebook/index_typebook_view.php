<div id="right">
	<h2>Thể loại: <span><i><?php echo $data['TenLoai']; ?></i></span></h2>
    <section class="grid-holder features-books">
    <?php foreach ($dataTypeBook as $key => $tBookSearch): ?>
    	<figure class="span4 slide first chinh1">
	            <a href="?cn=index&m=detail&name=<?php echo vn2latin($tBookSearch['TenSach'] ."-". $tBookSearch['id']); ?>"><img src="<?php echo PATH_IMG_BOOK . $tBookSearch['HinhAnh']; ?>" alt="<?php echo $tBookSearch['HinhAnh']; ?>" title="Xem chi tiết.." class="pro-img"/></a>
	            <p>
	                <span class="title">
	                    <a href="?cn=index&m=detail&name=<?php echo vn2latin($tBookSearch['TenSach'] ."-". $tBookSearch['id']); ?>" style="font-weight: bold;" title="<?php echo $tBookSearch['TenSach']; ?> - Xem chi tiết.."><?php echo $tBookSearch['TenSach']; ?></a>
	                </span>
	            </p>
	            <p>Tác giả:
	                <a class="nxb" href="? " title="<?php echo $tBookSearch['TenTG']; ?>"> <?php echo $tBookSearch['TenTG']; ?></a>
	            </p>
	            <p>Thể Loại:
	                <a class="nxb" href="? " title="<?php echo $tBookSearch['TenLoai']; ?>"> <?php echo $tBookSearch['TenLoai']; ?></a>
	            </p>
	            <p>Nhà xuất bản:
	                <a class="nxb" href="? " title="<?php echo $tBookSearch['TenNXB']; ?>"> <?php echo $tBookSearch['TenNXB']; ?></a>
	            </p>
	            <div class="cart-price">
	                <a class="cart-btn2" href="#">Thêm vào giỏ hàng</a>
	                <span class="price"><?php echo (!empty($tBookSearch['GiaMoi']) ? number_format($tBookSearch['GiaMoi']) : number_format($tBookSearch['GiaCu'])); ?>Đ</span>
	            </div>
	        </figure>
    <?php endforeach ?>
    </section>
</div>