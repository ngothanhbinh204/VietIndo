<?php

if (have_rows('home_section', get_the_ID())) {

	while (have_rows('home_section', get_the_ID())) {

		the_row();

		if (get_row_layout() == 'partner_section') {

			$partner_ablumlogo = get_sub_field('partner_ablumlogo');
		}
	}
}

?>



<section class="home-4 bg-Neutral-White">

	<div class="home-4-slide">

		<div class="swiper">

			<div class="swiper-wrapper">

				<?php if (!empty($partner_ablumlogo)): ?>

					<?php foreach ($partner_ablumlogo as $item): ?>

						<div class="swiper-slide">

							<div class="image rem:w-[165px]">

								<a class="img-ratio lozad" href="#">

									<?php if (!empty($item['url'])) : ?>
										<img src="<?php echo esc_url($item['url']); ?>" alt="<?php echo !empty($item['alt']) ? esc_attr($item['alt']) : ''; ?>">
									<?php endif; ?>


								</a>
							</div>

						</div>

					<?php endforeach; ?>

				<?php endif; ?>

			</div>

		</div>

	</div>

</section>