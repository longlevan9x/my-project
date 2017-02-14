<div id="right">
	<h2>Hiển thị theo <span><mark><i>giá < 500,000Đ</i></mark></span></h2>
    <section class="grid-holder features-books">
    <?php foreach ($priceBookLess500 as $key => $listAtSearch): ?>
    	<figure class="span4 slide first chinh1">
	            <a href="?cn=index&m=detail&name=<?php echo vn2latin($listAtSearch['TenSach']."-".$listAtSearch['id']); ?>"><img src="<?php echo PATH_IMG_BOOK . $listAtSearch['HinhAnh']; ?>" alt="<?php echo $listAtSearch['HinhAnh']; ?>" title="Xem chi tiết..." class="pro-img"/></a>
	            <p>
	                <span class="title">
	                    <a href="?cn=index&m=detail&name=<?php echo vn2latin($listAtSearch['TenSach']."-".$listAtSearch['id']); ?>" style="font-weight: bold;" title="<?php echo $listAtSearch['TenSach']; ?> - Xem chi tiết.."><?php echo $listAtSearch['TenSach']; ?></a>
	                </span>
	            </p>
	            <p>Tác giả:
	                <a class="nxb" href="? " title="<?php echo $listAtSearch['TenTG']; ?>"> <?php echo $listAtSearch['TenTG']; ?></a>
	            </p>
	            <p>Thể Loại:
	                <a class="nxb" href="? " title="<?php echo $listAtSearch['TenLoai']; ?>"> <?php echo $listAtSearch['TenLoai']; ?></a>
	            </p>
	            <p>Nhà xuất bản:
	                <a class="nxb" href="? " title="<?php echo $listAtSearch['TenNXB']; ?>"> <?php echo $listAtSearch['TenNXB']; ?></a>
	            </p>
	            <div class="cart-price">
	                <a class="cart-btn2" href="#">Thêm vào giỏ hàng</a>
	                <span class="price"><?php echo (!empty($listAtSearch['GiaMoi']) ? number_format($listAtSearch['GiaMoi']) : number_format($listAtSearch['GiaCu'])); ?>Đ</span>
	            </div>
	        </figure>
    <?php endforeach ?>
    </section>
</div>