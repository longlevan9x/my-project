<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <div id="right">
        <section class="b-detail-holder">
            <article class="title-holder">
                <div class="span6">
                    <h2><?php echo $infoData['TenSach']; ?></h2>
                </div>
            </article>
            <div class="book-i-caption">
                <div class="span6 b-img-holder">
                    <span class='zoom' id='ex1'> <img src='<?php echo PATH_IMG_BOOK.$infoData['HinhAnh']; ?>' height="219" width="300" id='jack' alt=''/></span>
                </div>
                <div class="span6">
                    <strong class="title">Tổng quan</strong>
                    <p class="text_chi_tiet">Thể loại: <a href=""><?php echo $infoData['TenLoai']; ?></a></p>
                    <p class="text_chi_tiet">Nhà xuất bản: <a href=""><?php echo $infoData['TenNXB']; ?></a></p>
                    <p class="text_chi_tiet">Tác giả: <a href="">Nam Cao</a></p>
                    <p class="text_chi_tiet">Giá bìa: <?php echo number_format($infoData['GiaCu']); ?>₫</p>
                    <p class="text_chi_tiet">Giá bán: <span class="giamoi_chitiet"><?php echo (!empty($infoData['GiaMoi']) ? number_format($infoData['GiaMoi']) : number_format($infoData['GiaCu'])); ?> ₫</span></p>
                    <p class="text_chi_tiet">Số trang: <?php echo $infoData['SoTrang']; ?> trang</p>
                    <p class="text_chi_tiet">Số lượt xem: <?php echo $infoData['SoLuotXem']; ?></p>
                    <div class="comm-nav">
                        <strong class="title2">Số lượng mua</strong>
                        <ul><form method="POST" action="?cn=cart&m=add&id=<?php echo $infoData['id']; ?>">
                                <li><input name="txtSoLuong" class="txtSoLuong" type="text" value="1" required pattern="[0-9]{1,3}" title="Số lượng phải là số "/></li>
                            <li><input type="submit" value="Thêm vào giỏ hàng" class="more-btn"/></li>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <section class="related-book">
                <div class="heading-bar">
                    <h2>Sách liên quan</h2>
                    <span class="h-line"></span>
                </div>
                <div class="slider6">
                <?php foreach ($dataTypeBook as $key => $val): ?>
                    <div class="slide">
                        <a href="?cn=index&m=detail&name=<?php echo vn2latin($val['TenSach'].'-'.$val['id']); ?>"><img src="<?php echo PATH_IMG_BOOK.$val['HinhAnh']; ?>" title="Xem chi tiết..." alt="" class="pro-img"/></a>
                        <h4><a href="" title="<?php echo $val['TenSach']; ?> - Xem chi tiết.."><?php echo $val['TenSach']; ?></a></h4>
                        <div class="cart-price">
                            <a class="cart-btn2" href="#">Add to Cart</a>
                            <span class="price"><?php echo (!empty($val['GiaMoi']) ? $val['GiaMoi'] : $val['GiaCu']); ?> ₫</span>
                        </div>
                    </div>
                <?php endforeach ?>
                </div>
            </section>
            <section class="reviews-section">
                <figure class="left-sec">
                    <div class="r-title-bar">
                        <strong>Hỏi, Đáp Về Sản Phẩm</strong>
                    </div>
                    <ul class="review-list">
                        <li>
                            <input name="" type="text" placeholder="Hãy đặt câu hỏi..."/>
                        </li>
                        <p>Các câu hỏi thường gặp về sản phẩm:</p>
                        <p>- Chế độ bảo hành cùng cách thức vận chuyển sản phẩm này thế nào?</p>
                        <p>- Kích thước sản phẩm này ?</p>
                        <p>- Sản phẩm này có dễ dùng không ?</p>
                        <p><span>Các câu hỏi liên quan đến sản phẩm hư hỏng, cần đổi trả, v.v ... vui lòng truy cập trang hỗ trợ</span></p>
                    </ul>
                    <a href="#" class="grey-btn">Gửi câu hỏi</a>
                </figure>
                <figure class="right-sec">
                  <div>
                    <div class="fb-comments" data-width="100%" data-numposts="5"></div>
                  </div>
                </figure>
            </section>
        </section>
    </div>