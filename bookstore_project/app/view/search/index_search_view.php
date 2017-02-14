<div id="right">
    <h2>Tìm kiếm sách</h2>
    <section class="grid-holder features-books">
    	<?php foreach ($dataAllSearch as $key => $listBooksearch): ?>
			 <figure class="span4 slide first chinh1">
	            <a href="?cn=index&m=detail&name=<?php echo vn2latin($listBooksearch['TenSach']."-".$listBooksearch['id']); ?>"><img src="<?php echo PATH_IMG_BOOK . $listBooksearch['HinhAnh']; ?>" alt="<?php echo $listBooksearch['HinhAnh']; ?>" title="Xem chi tiết.." class="pro-img"/></a>
	            <p>
	                <span class="title">
	                    <a href="?cn=index&m=detail&name=<?php echo vn2latin($listBooksearch['TenSach']."-".$listBooksearch['id']); ?>" style="font-weight: bold;" title="<?php echo $listBooksearch['TenSach']; ?> - Xem chi tiết.."><?php echo $listBooksearch['TenSach']; ?></a>
	                </span>
	            </p>
	            <p>Tác giả:
	                <a class="nxb" href="? " title="<?php echo $listBooksearch['TenTG']; ?>"> <?php echo $listBooksearch['TenTG']; ?></a>
	            </p>
	            <p>Thể Loại:
	                <a class="nxb" href="? " title="<?php echo $listBooksearch['TenLoai']; ?>"> <?php echo $listBooksearch['TenLoai']; ?></a>
	            </p>
	            <p>Nhà xuất bản:
	                <a class="nxb" href="? " title="<?php echo $listBooksearch['TenNXB']; ?>"> <?php echo $listBooksearch['TenNXB']; ?></a>
	            </p>
	            <div class="cart-price">
	                <a class="cart-btn2" href="#">Thêm vào giỏ hàng</a>
	                <span class="price"><?php echo (!empty($listBooksearch['GiaMoi']) ? number_format($listBooksearch['GiaMoi']) : number_format($listBooksearch['GiaCu'])); ?>Đ</span>
	            </div>
	        </figure>
    	<?php endforeach ?>
    	<div class="row" style="clear: both;">
    		<?php echo $dataPaging['html']; ?>
    	</div>
    </section>

    
</div>