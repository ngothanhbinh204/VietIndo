<?php
$id_category = get_queried_object()->term_id;
$term = get_queried_object();
$taxonomy = !empty(get_queried_object()->taxonomy) ? get_queried_object()->taxonomy : '';
if ($id_category) {
	$id = $taxonomy . '_' . $id_category;
	$title = !empty($term) ? $term->name : '';
} else {
	$id = get_the_ID();
	$title = get_the_title($id);
}
$banner = get_field('banner_select_page', $id);
?>
<div class="global-breadcrumb">
	<div class="container">
		<nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
		</nav>
	</div>
</div>
<div class="caption">
	<h1 class="heading-banner font-black text-white relative z-10"><?php echo !empty($title) ? $title : ''; ?></h1>
</div>