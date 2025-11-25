<?php

/*

 Template Name: Page - E-Catalogue

 */





?>

<?php get_header(); ?>



<section class="catalog-1">

	<?php get_template_part('modules/common/banner'); ?>

</section>

<section class="catalog-2 section-py">

	<div class="container">

		<div class="heading mb-base">

			<h4 class="text-xl font-bold text-Primary-1 tracking-[-0.4px] mb-4"><?php echo __('E- CATALOGUE', 'canhcamtheme'); ?></h4>

			<h3 class="title-40 !font-normal "><?php echo __('Đồng hành cùng giá trị cộng hưởng', 'canhcamtheme'); ?></h3>

		</div>



		<div class="catalog-2-list grid xl:grid-cols-4 grid-cols-2 md:gap-base gap-3">

			<?php

			$paged = get_query_var('paged') ? get_query_var('paged') : 1;

			$args = array(
				'post_type' => 'catalogue',
				'posts_per_page' => 12,
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => 'DESC',
				'paged' => $paged,
				'facetwp' => true,
			);

			$query = new WP_Query($args);

			if ($query->have_posts()): while ($query->have_posts()): $query->the_post();

					$file_url = get_field('attFile');

			?>

					<div class="item p-4 bg-Neutral-50 group">

						<div class="image"> <a class="img-ratio ratio:pt-[405_288] lozad zoom-img" href="<?php echo !empty($file_url) ? $file_url['url'] : ''; ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>"></a></div>

						<div class="content mt-4">

							<h3 class="text-xl font-bold text-Neutral-950 group-hover:text-Primary-1"><a href="<?php echo !empty($file_url) ? $file_url['url'] : ''; ?>" target="_blank"><?php the_title(); ?></a></h3>

						</div>

					</div>

			<?php endwhile;

			endif;

			wp_reset_postdata(); ?>

		</div>



		<div class="pagination mt-base">

			<?php echo do_shortcode('[facetwp facet="catelouge"]') ?>

		</div>

	</div>

</section>







<?php get_footer(); ?>