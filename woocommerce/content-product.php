<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if (! is_a($product, WC_Product::class) || ! $product->is_visible()) {
	return;
}

if (isset($args["productID"])) {
	$product = wc_get_product($args["productID"]);
}

?>
<div class="product-item bg-Utility-50 md:p-5 p-2 group rounded-5 overflow-hidden">
	<div class="image"><a class="img-ratio zoom-img-1 rounded-5" href="<?php the_permalink($product->get_id()); ?>"><img src="<?php echo get_the_post_thumbnail_url($product->get_id(), 'full'); ?>" alt="" /></a></div>
	<div class="content pt-6">
		<h3 class="heading-4 text-Utility-Black font-bold group-hover:text-Primary-2"><a href="<?php the_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a></h3>
		<div class="product-parameter flex flex-col gap-3 mt-3">
			<?php foreach ($product->get_attributes() as $attribute): ?>

				<div class="product-info flex items-center gap-2">
					<div class="left flex-shrink-0">
						<div class="title text-Neutral-500-main font-normal"><?php echo wc_attribute_label($attribute->get_name()); ?>:</div>
					</div>
					<div class="right">
						<div class="text text-Neutral-700 font-normal tracking-[-0.32px]">
							<?php
							$values = [];

							if ($attribute->is_taxonomy()) {
								$terms = wp_get_post_terms($product->get_id(), $attribute->get_name(), ['fields' => 'names']);
								$values = $terms;
							} else {
								$values = $attribute->get_options();
							}

							echo implode(', ', $values);
							?>

						</div>
					</div>
				</div>
			<?php endforeach; ?>

		</div>
		<div class="product-btn inline-flex mt-6"><a class="btn btn-primary" href="<?php the_permalink($product->get_id()); ?>"> <span><?php echo __('Xem thêm', 'canhcamtheme'); ?></span></a>
		</div>
	</div>
</div>