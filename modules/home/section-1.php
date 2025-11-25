<?php
$banner_slider = get_sub_field('banner_slider');
?>
<section class="home-1">
	<div class="slide relative">
		<div class="swiper">
			<div class="swiper-wrapper">
				<?php if ($banner_slider) : ?>
					<?php foreach ($banner_slider as $item) : ?>
						<div class="swiper-slide">
							<div class="home-1-banner relative">
								<a class="img-ratio ratio:pt-[820_1920]" href="<?php echo esc_url($item['link']['url'] ?? '#'); ?>">
									<?php echo get_image_attrachment($item['image']); ?>
								</a>
								<div class="home-1-content text-white">
									<?php if (!empty($item['sub_title'])) : ?>
										<div class="sub-title heading-3 font-semibold mb-3" data-aos="fade-left" data-aos-delay="200" data-aos-duration="1200">
											<?php echo esc_html($item['sub_title']); ?>
										</div>
									<?php endif; ?>
									<?php if (!empty($item['title'])) : ?>
										<h1 data-aos="fade-left" data-aos-delay="400" data-aos-duration="1200">
											<?php echo esc_html($item['title']); ?>
										</h1>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="wrap-button-slide">
			<div class="btn btn-sw-1 btn-prev"></div>
			<div class="btn btn-sw-1 btn-next"></div>
		</div>
	</div>
</section>