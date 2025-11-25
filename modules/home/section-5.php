<?php
$sub_title = get_sub_field('sub_title');
$title = get_sub_field('title');
$button = get_sub_field('button');
$partners_top = get_sub_field('partners_top');
$partners_bottom = get_sub_field('partners_bottom');
?>
<section class="home-5 section-py">
	<div class="container-fluid">
		<div class="wrapper grid xl:grid-cols-[30.9%_69.1%] grid-cols-1" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="1200">
			<div class="col-left">
				<div class="heading mb-base">
					<?php if ($sub_title) : ?>
						<div class="sub-title heading-5 font-bold text-white mb-3"><?php echo esc_html($sub_title); ?></div>
					<?php endif; ?>
					<?php if ($title) : ?>
						<h2 class="heading-banner font-black"><?php echo esc_html($title); ?></h2>
					<?php endif; ?>
				</div>
				<?php if ($button) : ?>
					<div class="button-more"><a class="btn btn-primary white" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target']); ?>"> <span><?php echo esc_html($button['title']); ?></span></a></div>
				<?php endif; ?>
			</div>
			<div class="col-right bg-Utility-100">
				<div class="slide-top">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php if ($partners_top) : ?>
								<?php foreach ($partners_top as $item) : ?>
									<div class="swiper-slide"><a class="item-logo" href="<?php echo esc_url($item['link']['url'] ?? '#'); ?>">
											<?php echo get_image_attrachment($item['image']); ?>
										</a></div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="slide-bottom">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php if ($partners_bottom) : ?>
								<?php foreach ($partners_bottom as $item) : ?>
									<div class="swiper-slide"><a class="item-logo" href="<?php echo esc_url($item['link']['url'] ?? '#'); ?>">
											<?php echo get_image_attrachment($item['image']); ?>
										</a></div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>