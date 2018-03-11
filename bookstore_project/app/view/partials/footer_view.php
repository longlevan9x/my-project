<?php
$data = get_data('footer');
?>
<section class="container-fluid footer-top2">
                <section class="social-ico-bar">
                    <section class="container">
                        <section class="row-fluid">

                        </section>
                    </section>
                </section>
                <section class="container">
                    <section class="row-fluid">
                        <?= $data['meta_value']; ?>
                    </section>
                </section>
            </section>
            <footer id="main-footer">
                <section class="social-ico-bar">
                    <section class="container">
                        <section class="row-fluid">
                            <article class="span6">
                                <p>© 2016 - Bản quyền của developer [LPHP1608E]</p>
                            </article>
                            <article class="span6 copy-right">
                                <p>Cửa hàng <a href="?cn=home">Trung Tâm T3H</a></p>
                            </article>
                        </section>
                    </section>
                </section>
            </footer>
        </div>
    </body>
<?php ob_end_flush(); ?>
</html>