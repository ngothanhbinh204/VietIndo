<?php
$background_image = get_sub_field('background_image');
$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$description = get_sub_field('description');
$button = get_sub_field('button');
?>
<section class="home-7 section-py" setBackground="<?php echo esc_url($background_image['url'] ?? './img/bg-origin.png'); ?>">
	<div class="container-fluid">
		<div class="wrap-content">
			<div class="wrap-heading">
				<?php if ($title) : ?>
					<h2 class="heading-banner font-black mb-4" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1200"><?php echo esc_html($title); ?></h2>
				<?php endif; ?>
				<?php if ($sub_title) : ?>
					<div class="sub-title body-1 font-bold mb-4" data-aos="fade-right" data-aos-delay="400" data-aos-duration="1200"><?php echo esc_html($sub_title); ?></div>
				<?php endif; ?>
				<?php if ($description) : ?>
					<div class="desc body-1 font-normal" data-aos="fade-right" data-aos-delay="600" data-aos-duration="1200">
						<?php echo $description; ?>
					</div>
				<?php endif; ?>
			</div>
			<?php if ($button) : ?>
				<div class="button-more mt-base" data-aos="fade-right" data-aos-delay="800" data-aos-duration="1200"><a class="btn btn-primary white" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target']); ?>"> <span><?php echo esc_html($button['title']); ?></span></a></div>
			<?php endif; ?>
		</div>
	</div>
</section>
