<div id="right">
    <h2>Sách mới</h2>
    <section class="grid-holder features-books">
    <?php foreach ($dataAllBook as $key => $listBook): ?>
        <figure class="span4 slide first chinh1">
            <a href="?cn=index&m=detail&name=<?php echo vn2latin($listBook['TenSach'].'-'.$listBook['id']); ?>"><img src="<?php echo PATH_IMG_BOOK . $listBook['HinhAnh']; ?>" alt="<?php echo $listBook['HinhAnh']; ?>" title="Xem chi tiết..." class="pro-img"/></a>
            <p>
                <span class="title">
                    <a href="?cn=index&m=detail&name=<?php echo vn2latin($listBook['TenSach'].'-'.$listBook['id']); ?>" style="font-weight: bold;" title="<?php echo $listBook['TenSach']; ?> - Xem chi tiết.."><?php echo $listBook['TenSach']; ?></a>
                </span>
            </p>
            <p>Tác giả:
                <a class="nxb" href="? " title="<?php echo $listBook['TenTG']; ?>"> <?php echo $listBook['TenTG']; ?></a>
            </p>
            <p>Thể Loại:
                <a class="nxb" href="? " title="<?php echo $listBook['TenLoai']; ?>"> <?php echo $listBook['TenLoai']; ?></a>
            </p>
            <p>Nhà xuất bản:
                <a class="nxb" href="? " title="<?php echo $listBook['TenNXB']; ?>"> <?php echo $listBook['TenNXB']; ?></a>
            </p>
            <p>Số lượt xem:
                <a class="nxb" href="? " title="<?php echo $listBook['SoLuotXem']; ?>"> <?php echo $listBook['SoLuotXem']; ?></a>
            </p>
            <div class="cart-price">
                <a class="cart-btn2" href="?cn=cart&m=add&id=<?php echo $listBook['id']; ?>">Thêm vào giỏ hàng</a>
                <span class="price"><?php echo (!empty($listBook['GiaMoi']) ? number_format($listBook['GiaMoi']) : number_format($listBook['GiaCu'])); ?>Đ</span>
            </div>
        </figure>
    <?php endforeach ?>
        <div class="clear" style="clear: both;">
            <?php echo $dataPaging['html']; ?>
        </div>
        
    </section>
</div>