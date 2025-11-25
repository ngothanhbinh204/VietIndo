<?php
$sub_title = get_sub_field('sub_title');
$title = get_sub_field('title');
$gallery = get_sub_field('gallery');
?>
<section class="home-3 section-py">
	<div class="container-fluid">
		<div class="swiper-column-auto relative">
			<div class="wrapper flex items-center justify-between mb-base">
				<div class="left">
					<?php if ($sub_title) : ?>
						<div class="sub-title heading-5 font-bold text-Utility-700 mb-3" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1200"><?php echo esc_html($sub_title); ?></div>
					<?php endif; ?>
					<?php if ($title) : ?>
						<h2 class="heading-banner font-black text-Primary-2" data-aos="fade-right" data-aos-delay="400" data-aos-duration="1200"><?php echo esc_html($title); ?></h2>
					<?php endif; ?>
				</div>
				<div class="right" data-aos="fade-left" data-aos-delay="600" data-aos-duration="1200">
					<div class="arrow-button flex items-center gap-3">
						<div class="btn btn-sw-1 btn-prev blue"></div>
						<div class="btn btn-sw-1 btn-next blue"></div>
					</div>
				</div>
			</div>
			<div class="slide relative">
				<div class="swiper" data-aos="fade-up" data-aos-delay="800" data-aos-duration="1200">
					<div class="swiper-wrapper">
						<?php if ($gallery) : ?>
							<?php foreach ($gallery as $item) : ?>
								<div class="swiper-slide">
									<div class="img relative">
										<a class="img-ratio ratio:pt-[586_440] rounded-4" href="<?php echo esc_url($item['link']['url'] ?? '#'); ?>">
											<?php echo get_image_attrachment($item['image']); ?>
										</a>
										<div class="content wrap-item-height text-center">
											<div class="title heading-3 font-semibold text-white mb-3"> <a href="<?php echo esc_url($item['link']['url'] ?? '#'); ?>"><?php echo esc_html($item['title']); ?></a></div>
											<div class="desc body-1 text-Utility-white font-light item-var-height">
												<?php echo $item['description']; ?>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>