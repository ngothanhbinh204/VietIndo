<?php
$id_category = get_queried_object()->term_id;
$taxonomy = get_queried_object()->taxonomy;
if ($id_category) {
	$id = $taxonomy . '_' . $id_category;
} else {
	$id = get_the_ID();
}
$banner = get_field('banner_select_page', $id);
?>
<?php if ($banner) : ?>
	<?php foreach ($banner as $item) : ?>
		<?php $image = get_the_post_thumbnail_url($item->ID, 'full'); ?>
		<div class="banner"> <a class="img-ratio ratio:pt-[600_1920]"><img src="<?php echo $image; ?>" alt="<?php echo $item->post_title; ?>" /></a>
			<?php get_template_part('template-parts/section', 'breadcrumb'); ?>
		</div>
	<?php endforeach; ?>
<?php endif; ?>