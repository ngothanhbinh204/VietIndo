<?php
$ft_name = get_field('ft_name', 'option');
$ft_followus = get_field('ft_followus', 'option');
$ft_repeater_followus = get_field('ft_repeater_followus', 'option');

$ft_headoffice = get_field('ft_headoffice', 'option');
$ft_addressheadoffice = get_field('ft_addressheadoffice', 'option');
$repeater_office = get_field('repeater_office', 'option');

$ft_branch = get_field('ft_branch', 'option');
$ft_addressbranch = get_field('ft_addressbranch', 'option');
$repeater_branch = get_field('repeater_branch', 'option');

$ft_factory = get_field('ft_factory', 'option');
$ft_addressfactory = get_field('ft_addressfactory', 'option');
$repeater_factory = get_field('repeater_factory', 'option');

$ft_newsletter_title = get_field('ft_newsletter_title', 'option');
$ft_copyright = get_field('ft_copyright', 'option');
$ft_background = get_field('ft_background', 'option');

$ft_shortcode = get_field('ft_shortcode', 'option');
?>

<footer class="footer section-py bg-Primary-1">
	<div class="container-fluid">
		<div class="wrapper grid grid-cols-[4.2fr_2.8fr_2.5fr_2.5fr] gap-base">
			<div class="footer-column">
				<h3>Thông tin liên hệ</h3>
				<div class="contact-info">
					<div class="contact-item">
						<a href="#">
							<div class="icon">
								<i class="fa-solid fa-location-dot"></i>
							</div>
							<span
								>Văn phòng đại diện: Số 04, Đường 55-TML, Phường Cát Lái, TP.HCM</span
							></a
						>
					</div>
					<div class="contact-item">
						<a href="#">
							<div class="icon">
								<i class="fa-solid fa-location-dot"></i>
							</div>
							<span
								>Văn phòng đại diện: Số 04, Đường 55-TML, Phường Cát Lái, TP.HCM</span
							></a
						>
					</div>
					<div class="contact-item">
						<a href="#">
							<div class="icon">
								<i class="fa-solid fa-location-dot"></i>
							</div>
							<span
								>Văn phòng đại diện: Số 04, Đường 55-TML, Phường Cát Lái, TP.HCM</span
							></a
						>
					</div>
					<div class="contact-item">
						<a href="#">
							<div class="icon">
								<i class="fa-solid fa-location-dot"></i>
							</div>
							<span
								>Văn phòng đại diện: Số 04, Đường 55-TML, Phường Cát Lái, TP.HCM</span
							></a
						>
					</div>
				</div>
			</div>
			<div class="footer-column">
				<h3>Liên kết nhanh</h3>
				<ul class="footer-menu">
					<li><a href="#">Giới thiệu</a></li>
					<li><a href="#">Giới thiệu</a></li>
					<li><a href="#">Giới thiệu</a></li>
					<li><a href="#">Giới thiệu</a></li>
					<li><a href="#">Giới thiệu</a></li>
					<li><a href="#">Giới thiệu</a></li>
				</ul>
			</div>
			<div class="footer-column">
				<h3>Theo dõi chúng tôi</h3>
				<ul class="footer-social">
					<li>
						<a href="#">
							<div class="icon">
								<i class="fa-brands fa-facebook"></i>
							</div>
							<span>Facebook</span></a
						>
					</li>
					<li>
						<a href="#">
							<div class="icon">
								<i class="fa-brands fa-facebook"></i>
							</div>
							<span>Facebook</span></a
						>
					</li>
					<li>
						<a href="#">
							<div class="icon">
								<i class="fa-brands fa-facebook"></i>
							</div>
							<span>Facebook</span></a
						>
					</li>
				</ul>
			</div>
			<div class="footer-column">
				<h3>Đăng ký nhận thông tin</h3>
				<form>
					<div class="form-group">
						<input type="email" placeholder="Your email..." />
					</div>
					<div class="form-submit">
						<button class="btn btn-primary" type="submit"><span>GỬI</span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="tool-fixed-cta">
		<a class="btn btn-content" href="#">
			<div class="btn-icon tiktok">
				<div class="icon"><i class="fa-brands fa-tiktok"></i></div></div></a
		><a class="btn btn-content" href="#">
			<div class="btn-icon youtube">
				<div class="icon"><i class="fa-brands fa-youtube"></i></div></div></a
		><a class="btn btn-content" href="#">
			<div class="btn-icon facebook">
				<div class="icon"><i class="fa-brands fa-facebook"></i></div></div
		></a>
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
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

	<?php wp_footer() ?>
<?php endif; ?>
</body>

</html>