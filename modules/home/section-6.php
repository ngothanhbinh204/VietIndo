<?php
$sub_title = get_sub_field('sub_title');
$title = get_sub_field('title');
$args = array(
	'post_type' => 'post',
	'posts_per_page' => 6,
	'post_status' => 'publish'
);
$news_query = new WP_Query($args);
?>
<section class="home-6 section-py">
	<div class="container-fluid">
		<div class="wrapper flex items-center justify-between mb-base">
			<div class="left">
				<?php if ($sub_title) : ?>
					<div class="sub-title heading-5 font-bold text-Utility-700 mb-3" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1200"><?php echo esc_html($sub_title); ?></div>
				<?php endif; ?>
				<?php if ($title) : ?>
					<h2 class="heading-banner font-black text-Primary-2" data-aos="fade-right" data-aos-delay="400" data-aos-duration="1200"><?php echo esc_html($title); ?></h2>
				<?php endif; ?>
			</div>
			<div class="right">
				<div class="arrow-button flex items-center gap-3" data-aos="fade-left" data-aos-delay="600" data-aos-duration="1200">
					<div class="btn btn-sw-1 btn-prev blue"></div>
					<div class="btn btn-sw-1 btn-next blue"></div>
				</div>
			</div>
		</div>
		<div class="slide relative" data-aos="fade-up" data-aos-delay="800" data-aos-duration="1200">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php if ($news_query->have_posts()) : ?>
						<?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
							<div class="swiper-slide">
								<div class="news-item grid grid-cols-2">
									<div class="img"> <a class="img-ratio ratio:pt-[286_430]" href="<?php the_permalink(); ?>">
											<?php echo get_image_post(get_the_ID()); ?>
										</a></div>
									<div class="content px-10 oy-6 bg-Utility-50">
										<div class="content-top">
											<div class="date"><?php echo get_the_date('d.m.Y'); ?></div>
											<div class="category"><?php
																	$categories = get_the_category();
																	if (!empty($categories)) {
																		echo esc_html($categories[0]->name);
																	}
																	?></div>
										</div>
										<div class="content-bottom">
											<h3 class="heading-3 font-semibold line-clamp-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>