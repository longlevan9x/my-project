
</section>
        <section class="span3">
            <div class="side-holder">
                <article class="banner-ad">
                    <img src="public/images/khuyenmai.jpg" alt=""/>
                </article>
            </div>
            <div class="side-holder">
                <article class="shop-by-list">
                    <h2>Danh mục sản phẩm</h2>
                    <div class="side-inner-holder">
                        <strong class="title">Thể loại</strong>
                        <ul class="side-list">
                            <?php foreach ($typeBook as $key => $listTypebook): ?>
                                <li><a href="?cn=typebook&m=index&id=<?php echo $listTypebook['id_loai']; ?>" title="<?php echo $listTypebook['TenLoai']; ?>"><?php echo $listTypebook['TenLoai']; ?></a></li>
                            <?php endforeach ?>
                        </ul>
                        <strong class="title">Giá</strong>
                        <ul class="side-list">
                            <li class="active"><a href="?cn=index&m=Sach_theo_gia&id=1">Từ 0đ - 500,000đ</a></li>
                            <li><a href="?cn=index&m=Sach_theo_gia&id=2">Từ 500,000đ - 1,000,000đ</a></li>
                            <li><a href="?cn=index&m=Sach_theo_gia&id=3">Lớn hơn 1,000,000đ</a></li>
                        </ul>
                        <strong class="title">Tác giả</strong>
                        <ul class="side-list">
                            <?php foreach ($author as $key => $listAuthor): ?>
                                <li><a href="?cn=author&m=index&id=<?php echo $listAuthor['id_tg']; ?>"><?php echo $listAuthor['TenTG']; ?></a></li>
                            <?php endforeach ?>
                        </ul>
                        <strong class="title">Nhà xuất bản:</strong>
                        <ul class="side-list">
                            <?php foreach ($publisher as $key => $listPublisher): ?>
                                <li><a href="?cn=publisher&m=index&id=<?php echo $listPublisher['id_nxb']; ?>"><?php echo $listPublisher['TenNXB']; ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </article>
            </div>
            <div class="side-holder">
                <article class="l-reviews">
                    <h2>Sách xem nhiều nhất</h2>
                    <div class="side-inner-holder">
                        <article class="r-post sach_xem_nhieu">
                            <div class="r-img-title">
                                <a href="#"><img src=""/></a>
                                <div class="r-det-holder span6">
                                    <strong class="r-author">Tên sách: <a href="#">Dế mèn phiêu lưu kí</a></strong>
                                </div>
                                <div class="r-det-holder span6">
                                    <span class="r-by">Tên tác giả:<a href="#">Tô Hoài</a></span>
                                    <span class="r-by">Giá: 120000 đ</span>
                                    <span class="r-by">Số lượt xem: 355</span>
                                </div>
                            </div>
                        </article>
                    </div>
                </article>
            </div>
        </section>
    </section>
    </section>
    <section class="container-fluid footer-top1">
    <section class="container">
        <section class="row-fluid">
            <figure class="span3">
                <h4>Hỗ trợ khách hàng</h4>
                <p><a href="tel://01213111994">Hotline: 0121.311.1994</a></p>
                <p><a href="">Các câu hỏi thường gặp</a></p>
                <p><a href="">Gửi yêu cầu hỗ trợ</a></p>
                <p><a href="">Hướng dẫn đặt hàng</a></p>
                <p><a href="">Phương thức vận chuyển</a></p>
                <p><a href="">Chính sách đổi trả</a></p>
            </figure>
            <figure class="span3">
                <h4>Tài khoản của bạn</h4>
                <p><a href="login.php">Đăng nhập</a></p>
                <p><a href="login.php?dn=register">Đăng ký</a></p>
            </figure>
            <figure class="span3">
                <h4>Về cửa hàng</h4>
                <p><a href="?cn=home&method=lienhe">Địa chỉ</a></p>
                <p><a href="?cn=home&method=gioithieu">Giới thiệu cửa hàng</a></p>
                <p><a href="">Tuyển dụng</a></p>
                <p><a href="">Chính sách bảo mật</a></p>
            </figure>
            <figure class="span3">
                <h4>Thời gian mở cửa</h4>
                <p><a>Thứ Hai-Thứ Sáu ______ 8,00-18,00</a></p>
                <p><a>Thứ bảy ____________ 9,00-18,00</a></p>
                <p><a>Chủ Nhật _____________10.00-16.00</a></p>
            </figure>
        </section>
    </section>
</section>