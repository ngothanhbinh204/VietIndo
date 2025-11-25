<?php

if (have_rows('home_section', get_the_ID())) {

	while (have_rows('home_section', get_the_ID())) {

		the_row();

		if (get_row_layout() == 'service_section') {

			$service_tilte = get_sub_field('service_tilte');

			$service_subtitle = get_sub_field('service_subtitle');

			$secvire_linkseeall = get_sub_field('secvire_linkseeall');

			$service_listposts = get_sub_field('service_listposts');
		}
	}
}

?>



<section class="home-5 section-py bg-linear-6">

	<div class="container">

		<div class="home-5-top flex flex-col md:flex-row md:items-center items-start justify-between gap-base mb-base">

			<div class="left">

				<h4 class="text-xl font-bold text-Primary-1 tracking-[-0.4px] mb-4"><?php echo !empty($service_tilte) ? $service_tilte : ''; ?></h4>

				<h3 class="title-40 !font-normal "><?php echo !empty($service_subtitle) ? $service_subtitle : ''; ?></h3>

			</div>

			<div class="right">

				<div class="home--5-btn"><a class="button-primary" href="<?php echo !empty($secvire_linkseeall['url']) ? $secvire_linkseeall['url'] : '#'; ?>"> <span><?php echo !empty($secvire_linkseeall['title']) ? $secvire_linkseeall['title'] : ''; ?></span></a>

				</div>

			</div>

		</div>

		<div class="home-5-list flex gap-5">

			<?php if (!empty($service_listposts)): ?>

				<?php $i = 0; ?>

				<?php foreach ($service_listposts as $item): ?>

					<?php $postService = get_post($item->ID); ?>

					<div class="item <?php echo $i === 0 ? 'active' : ''; ?> lg:rem:h-[480px] relative flex items-end flex-1 transition-all duration-500 ease-in-out overflow-hidden">

						<div class="image relative">

							<?php if (!empty($postService) && !empty($postService->ID)) : ?>
								<a href="<?php echo esc_url(get_permalink($postService->ID)); ?>">
									<?php
									$thumbnail_url = get_the_post_thumbnail_url($postService->ID);
									if (!empty($thumbnail_url)) : ?>
										<img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo !empty($postService->post_name) ? esc_attr($postService->post_name) : ''; ?>">
									<?php endif; ?>
								</a>
							<?php endif; ?>


							<div class="content text-center absolute rem:bottom-[52px] w-full">

								<h2 class="text-32 text-Neutral-White font-bold"><?php echo $postService->post_title; ?></h2>

							</div>

						</div>

					</div>

					<?php $i++; ?>

				<?php endforeach; ?>

			<?php endif; ?>



		</div>

	</div>

</section>