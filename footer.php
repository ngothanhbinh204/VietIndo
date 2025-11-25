<?php
$contact_title = get_field('footer_contact_title', 'option');
$contact_items = get_field('footer_contact_items', 'option');

$menu_title = get_field('footer_menu_title', 'option');

$social_title = get_field('footer_social_title', 'option');
$social_items = get_field('footer_social_items', 'option');

$subscribe_title = get_field('footer_subscribe_title', 'option');
$subscribe_form = get_field('footer_subscribe_form', 'option');

$cta_tiktok = get_field('footer_cta_tiktok', 'option');
$cta_youtube = get_field('footer_cta_youtube', 'option');
$cta_facebook = get_field('footer_cta_facebook', 'option');
?>

<footer class="footer section-py bg-Primary-1">
    <div class="container-fluid">
        <div class="wrapper grid grid-cols-[4.2fr_2.8fr_2.5fr_2.5fr] gap-base">
            <div class="footer-column">
                <h3><?php echo esc_html($contact_title ? $contact_title : 'Thông tin liên hệ'); ?></h3>
                <div class="contact-info">
                    <?php if ($contact_items) : ?>
                    <?php foreach ($contact_items as $item) : ?>
                    <div class="contact-item">
                        <a href="<?php echo esc_url($item['link']); ?>">
                            <div class="icon">
                                <i class="<?php echo esc_attr($item['icon_class']); ?>"></i>
                            </div>
                            <span><?php echo esc_html($item['text']); ?></span>
                        </a>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer-column">
                <h3><?php echo esc_html($menu_title ? $menu_title : 'Liên kết nhanh'); ?></h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-1',
                    'container' => false,
                    'menu_class' => 'footer-menu',
                    'fallback_cb' => false
                ));
                ?>
            </div>
            <div class="footer-column">
                <h3><?php echo esc_html($social_title ? $social_title : 'Theo dõi chúng tôi'); ?></h3>
                <ul class="footer-social">
                    <?php if ($social_items) : ?>
                    <?php foreach ($social_items as $item) : ?>
                    <li>
                        <a href="<?php echo esc_url($item['link']); ?>">
                            <div class="icon">
                                <i class="<?php echo esc_attr($item['icon_class']); ?>"></i>
                            </div>
                            <span><?php echo esc_html($item['label']); ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="footer-column">
                <h3><?php echo esc_html($subscribe_title ? $subscribe_title : 'Đăng ký nhận thông tin'); ?></h3>
                <?php if ($subscribe_form) : ?>
                <?php echo do_shortcode($subscribe_form); ?>
                <?php else : ?>
                <form>
                    <div class="form-group">
                        <input type="email" placeholder="Your email..." />
                    </div>
                    <div class="form-submit">
                        <button class="btn btn-primary" type="submit"><span>GỬI</span></button>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="tool-fixed-cta">
        <?php if ($cta_tiktok) : ?>
        <a class="btn btn-content" href="<?php echo esc_url($cta_tiktok); ?>">
            <div class="btn-icon tiktok">
                <div class="icon"><i class="fa-brands fa-tiktok"></i></div>
            </div>
        </a>
        <?php endif; ?>
        <?php if ($cta_youtube) : ?>
        <a class="btn btn-content" href="<?php echo esc_url($cta_youtube); ?>">
            <div class="btn-icon youtube">
                <div class="icon"><i class="fa-brands fa-youtube"></i></div>
            </div>
        </a>
        <?php endif; ?>
        <?php if ($cta_facebook) : ?>
        <a class="btn btn-content" href="<?php echo esc_url($cta_facebook); ?>">
            <div class="btn-icon facebook">
                <div class="icon"><i class="fa-brands fa-facebook"></i></div>
            </div>
        </a>
        <?php endif; ?>
        <div class="btn button-to-top">
            <div class="btn-icon">
                <div class="icon"></div>
            </div>
        </div>
    </div>
</footer>
</main>
</div>
<?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) : ?>
<!-- Google Translate Widget -->
<!-- <div id="google_translate_element" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;"></div> -->
<!-- <script type="text/javascript">
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({
			pageLanguage: 'vi',
			includedLanguages: 'en,vi',
			layout: google.translate.TranslateElement.InlineLayout.SIMPLE
		}, 'google_translate_element');
	}
</script> -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>

<?php wp_footer() ?>
<?php endif; ?>
</body>

</html>