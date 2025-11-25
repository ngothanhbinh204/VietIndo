<?php
/*
 Template Name: Page - Contact
 */
$contact_title = get_field('contact_title');
$contact_repeater = get_field('contact_repeater');
$contact_google_map = get_field('contact_google_map');
$contact_form_content = get_field('contact_form_content');
$contact_shortcode = get_field('contact_shortcode');
?>
<?php get_header(); ?>

<?php get_template_part('template-parts/section', 'breadcrumb'); ?>
<section class="contact section-py">
	<!-- <div class="contact-bg absolute right-0 top-0  -z-1 rem:w-[624px]">
		<div class="image img-ratio ratio:pt-[878_624]"><img class="w-full h-full" src="<?php echo get_template_directory_uri(); ?>/img/bg-contact.svg" alt=""></div>
	</div> -->
	<div class="container">
		<div class="contact-main flex flex-col lg:flex-row gap-20">
			<div class="col-left lg:rem:w-[560px] w-full">
				<h2 class="heading-2 text-Primary-2 mb-6 uppercase"><?php echo $contact_title; ?></h2>
				<div class="contact-box">
					<div class="contact-list flex flex-col gap-5">
						<?php if (have_rows('contact_repeater')) : ?>
							<?php while (have_rows('contact_repeater')) : the_row(); ?>
								<?php
								$icon = get_sub_field('contact_icon');
								$info = get_sub_field('contact_info');
								$detail = get_sub_field('contact_detail');
								?>
								<div class="contact-item"><span class="text-lg"><?php echo $icon; ?></span>
									<div class="contact-wrap flex flex-col gap-2">
										<div class="top font-bold rem:mb-[6px]">
											<div><?php echo $info; ?></div>
										</div>
										<div class="bottom font-normal text-Neutral-500">
											<div><?php echo $detail; ?></div>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>

						<div class="map">
							<?php echo $contact_google_map; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-right flex-1 lg:p-12 p-5 bg-Neutral-White w-full">
				<div class="title text-xl text-center text-black font-normal">
					<?php echo $contact_form_content; ?>
				</div>
				<?php if (!empty($contact_shortcode)) : ?>
					<?php echo do_shortcode($contact_shortcode); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>