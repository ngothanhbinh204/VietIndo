<?php

/*

 Template Name: Page - Recruitment

 */

$rcm_title = get_field('rcm_title');

$rcm_description = get_field('rcm_description');

$rcm_regime = get_field('rcm_regime');

$rcm_repeater_regime = get_field('rcm_repeater_regime');

$rcm_job = get_field('rcm_job');

?>

<?php get_header(); ?>

<?php get_template_part('modules/common/banner'); ?>



<section class="recruitment-1 section-py">

	<div class="container">

		<div class="container">

			<div class="recruitment-1-heading">

				<h2 class="heading-1 text-Primary-2 mb-base"><?php echo !(empty($rcm_title)) ? $rcm_title : ''; ?></h2>

				<div class="format-content text-lg font-normal">

					<?php echo !(empty($rcm_description)) ? $rcm_description : ''; ?>

				</div>

			</div>

		</div>

	</div>

</section>

<section class="recruitment-2 section-py bg-Primary-1">

	<div class="container">
		<div class="heading text-Neutral-White">
			<h2 class="heading-1 font-bold"><?php echo !(empty($rcm_regime)) ? $rcm_regime : ''; ?></h2>
		</div>

		<div class="recruitment-list mt-base grid lg:grid-cols-3 md:grid-cols-2 gap-base md:gap-0">
			<?php if (!empty($rcm_repeater_regime)) : ?>
				<?php foreach ($rcm_repeater_regime as $item) : ?>

					<div class="recruitment-item">
						<div class="recruitment-image relative group block overflow-hidden">
							<a href="#" class="img-ratio ratio:pt-[340_465]"><img src="<?php echo !(empty($item['image']['url'])) ? $item['image']['url'] : ''; ?>" alt="<?php echo !(empty($item['image']['alt'])) ? $item['image']['alt'] : ''; ?>"></a>
							<div class="content absolute bottom-0 left-0 w-full wrap-item-height z-10">
								<h3 class="title heading-4 font-bold text-white"><?php echo !(empty($item['name'])) ? $item['name'] : ''; ?></h3>
								<div class="desc item-var-height pt-6"><?php echo !(empty($item['content'])) ? $item['content'] : ''; ?></div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="recruitment-3 section-py">
	<div class="container">
		<div class="heading mb-base">
			<h2 class="heading-1 font-bold text-Primary-2"><?php echo !(empty($rcm_job)) ? $rcm_job : ''; ?></h2>
		</div>
		<div class="recruitment-table table-responsive">
			<table class="w-full border-collapse">
				<thead>
					<tr>
						<td class="text-center"><?php echo __('STT', 'canhcamtheme'); ?></td>
						<td class="rem:max-w-[700px] w-full"><?php echo __('VỊ TRÍ TUYỂN DỤNG', 'canhcamtheme'); ?></td>
						<td class="text-center"><?php echo __('KHU VỰC', 'canhcamtheme'); ?></td>
						<td class="text-center"><?php echo __('HẠN NỘP HỒ SƠ', 'canhcamtheme'); ?></td>
					</tr>
				</thead>
				<tbody>


					<?php

					$index = 1;
					$args = array(
						'post_type' => 'recruitment',
						'post_status' => 'publish',
						'orderby' => 'date',
						'order' => 'DESC',
					);
					$query = new WP_Query($args);
					if ($query->have_posts()): while ($query->have_posts()): $query->the_post();
							$address = get_field('address');
							$deadlineapply = get_field('deadlineapply');
					?>
							<tr <?php echo ($index >= 6) ? 'class="hidden"' : ''; ?>>
								<td class="text-center p-3"><?php echo $index; ?></td>
								<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
								<td class="text-center"><?php echo !empty($address) ? $address : ''; ?></td>
								<td class="text-center"><?php echo !empty($deadlineapply) ? $deadlineapply : ''; ?></td>
							</tr>
					<?php $index++;
						endwhile;
					endif;
					wp_reset_postdata(); ?>


				</tbody>

			</table>

		</div>

		<div class="more flex-center mt-base relative z-50">

			<div class="button text-Primary-1"><a class="flex items-center gap-3" href="#"><span class="font-semibold"><?php echo __('Xem thêm', 'canhcamtheme'); ?></span>
					<div class="icon"> <i class="fa-regular fa-chevron-down"></i></div>
				</a></div>
		</div>

	</div>

</section>





<?php get_footer(); ?>