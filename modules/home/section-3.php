<?php

if (have_rows('home_section', get_the_ID())) {

	while (have_rows('home_section', get_the_ID())) {

		the_row();

		if (get_row_layout() == 'product_section') {

			$product_title = get_sub_field('product_title');

			$product_subtilte = get_sub_field('product_subtilte');

			$product_list_taxonomy = get_sub_field('product_list_taxonomy');
		}
	}
}

?>



<section class="home-3 bg-Primary-2 lg:pt-20 lg:pb-0 pt-10 pb-10 relative overflow-hidden">

	<div class="home-3-svg absolute left-[-12rem] z-10">

		<div class="image rem:w-[883px]"><a class="ratio-contain ratio:pt-[654_883] lozad" href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/home-3-svg.svg" alt=""></a></div>

	</div>

	<div class="container">

		<div class="wrap" data-toggle="tabslet">

			<?php if (!empty($product_list_taxonomy)): ?>

				<?php $i = 1; ?>

				<?php foreach ($product_list_taxonomy as $term_id): ?>

					<?php

					$term = get_term($term_id, 'product_cat'); // Thay bằng taxonomy thật nếu khác

					$name_bonus = get_field('name_bonus', $term); // Custom field

					$is_active = $i === 1 ? 'active' : '';

					?>

					<div class="tabslet-content <?php echo $is_active; ?>" id="tab<?php echo $i; ?>">

						<div class="home-3-main flex flex-col md:flex-row items-center lg:rem:gap-[115px] gap-base md:pb-28 pb-6">

							<div class="col-left lg:rem:w-[609px] md:w-7/12 w-full">

								<div class="home-3-top">

									<h4 class="text-xl font-bold text-Primary-1 tracking-[-0.4px] mb-4">

										<?php echo !empty($product_title) ? $product_title : ''; ?>

									</h4>

									<h3 class="title-40 !font-normal mb-base !text-Neutral-White lg:mb-15 mb-base">

										<?php echo !empty($product_subtilte) ? $product_subtilte : ''; ?>

									</h3>

								</div>

								<div class="home-3-content flex flex-col md:rem:gap-[26px] gap-3">

									<?php if (!empty($name_bonus)): ?>

										<h3 class="text-2xl font-bold text-Neutral-White">

											<?php echo esc_html($name_bonus); ?>

										</h3>

									<?php endif; ?>



									<?php if (!empty($term->description)): ?>

										<div class="format-content">

											<div class="desc text-lg font-normal text-Neutral-White">

												<?php echo esc_html($term->description); ?>

											</div>

										</div>

									<?php endif; ?>



									<div class="home-3-btn">

										<?php if (!empty($term)) : ?>
											<a href="<?php echo esc_url(get_term_link($term)); ?>">
												<?php echo __('Xem thêm', 'canhcamtheme'); ?>
											</a>
										<?php endif; ?>


									</div>

								</div>

							</div>

							<div class="col-right lg:w-[calc(100%-31.71875rem-5.989583333333334rem)] md:w-5/12 w-full">



								<?php

								$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);

								$image_url = wp_get_attachment_url($thumbnail_id);

								?>

								<?php if (!empty($image_url)): ?>

									<div class="image">

										<a class="img-ratio ratio:pt-[425_680] lozad" href="<?php echo esc_url(get_term_link($term)); ?>">

											<img class="lozad" data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($term->name); ?>" />

										</a>

									</div>

								<?php endif; ?>





							</div>

						</div>

					</div>

					<?php $i++; ?>

				<?php endforeach; ?>

			<?php endif; ?>







			<ul class="tabslet-tab home-3-nav">



				<?php if (!empty($product_list_taxonomy)): ?>

					<?php $i = 1; ?>

					<?php foreach ($product_list_taxonomy as $term_id): ?>

						<?php $term = get_term($term_id); ?>

						<?php if (!empty($term) && !is_wp_error($term) && !empty($term->name)) : ?>
							<li class="<?php echo $i === 1 ? 'active' : ''; ?>">
								<a href="#tab<?php echo $i; ?>"><?php echo esc_html($term->name); ?></a>
							</li>
						<?php endif; ?>

						<?php $i++; ?>

					<?php endforeach; ?>

				<?php endif; ?>




			</ul>

		</div>

	</div>

</section>