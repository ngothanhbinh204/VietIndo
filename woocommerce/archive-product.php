<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header();

?>
<section class="product-1">
	<?php get_template_part('./modules/common/banner'); ?>
</section>
<section class="product-2 section-py">
	<div class="container">
		<div class="product-wrap flex flex-col md:flex-row gap-base">
			<div class="filter-product-mobile sm:hidden sticky top-[120px] z-[100]">
				<div
					class="toggle-filter flex items-center justify-between w-fit px-3 py-2 cursor-pointer">
					<div
						class="group-left flex items-center gap-2 bg-Primary-1 p-2 text-Neutral-White">
						<i class="fa-light fa-filter subheader-24"></i>
						<div class="label"><?php echo __('Bô lọc','canhcamtheme'); ?></div>
					</div>
				</div>
			</div>
			<div class="col-left lg:w-3/12 md:w-4/12 w-full">
				<div class="btn-close-filter-product-mobile">
					<i class="fa-light fa-xmark subheader-24"></i>
				</div>
				<div class="product-category flex items-center  gap-3 w-full mb-5 md:mb-0">
					<div class="product-item cursor-pointer w-full">
						<div class="product-item-heading flex items-center justify-between p-4 bg-Primary-1 text-Neutral-White">
							<div class="left flex items-center gap-3">
								<div class="title text-xl font-bold"><?php echo __('DANH SÁCH SẢN PHẨM', 'canhcamtheme'); ?></div>
							</div>
							<div class="icon-left"><i class="fa-solid fa-chevron-down"></i></div>
						</div>
						<ul class="product-main">
							<?php
							$current_term = get_queried_object(); // Lấy danh mục hiện tại

							$root_categories = get_terms(array(
								'taxonomy' => 'product_cat',
								'hide_empty' => false,
								'parent' => 0,
							));

							foreach ($root_categories as $root_cat) {
								$level1_categories = get_terms(array(
									'taxonomy' => 'product_cat',
									'hide_empty' => false,
									'parent' => $root_cat->term_id,
								));

								foreach ($level1_categories as $category) :

									$subcategories = get_terms(array(
										'taxonomy' => 'product_cat',
										'hide_empty' => false,
										'parent' => $category->term_id,
									));

									// Kiểm tra current ở cấp 1 hoặc cấp 2
									$is_current_level1 = isset($current_term->term_id) && $current_term->term_id === $category->term_id;
									$is_current_sub = false;

									foreach ($subcategories as $subcat) {
										if ($current_term->term_id === $subcat->term_id) {
											$is_current_sub = true;
											break;
										}
									}

									$has_children_class = !empty($subcategories) ? 'has-children' : '';
									$current_class = $is_current_level1 ? 'current' : '';
									$open_class = ($is_current_level1 || $is_current_sub) ? 'is-open' : ''; // THÊM class này để jQuery nhận diện

							?>
									<li class="<?php echo esc_attr(trim("$has_children_class $current_class $open_class")); ?>">
										<a href="<?php echo esc_url(get_term_link($category)); ?>">
											<?php echo esc_html($category->name); ?>
										</a>

										<?php if (!empty($subcategories)) : ?>
											<ul class="product-level-1" <?php echo $is_current_sub ? '' : 'style="display:none;"'; ?>>
												<?php foreach ($subcategories as $subcategory) :
													$sub_current_class = ($current_term->term_id === $subcategory->term_id) ? 'current' : '';
												?>
													<li class="<?php echo esc_attr($sub_current_class); ?>">
														<a href="<?php echo esc_url(get_term_link($subcategory)); ?>">
															<?php echo esc_html($subcategory->name); ?>
														</a>
													</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</li>
							<?php
								endforeach;
							}
							?>
						</ul>


					</div>
				</div>
				<div class="product-filter flex items-center  gap-3 w-full">
					<div class="product-item cursor-pointer w-full">
						<div class="product-item-heading flex items-center justify-between p-4 bg-Primary-1 text-Neutral-White">
							<div class="left flex items-center gap-3">
								<div class="title text-xl font-bold"><?php echo __('BỘ LỌC', 'canhcamtheme'); ?></div>
							</div>
							<div class="right flex items-center gap-3">
								<div class="delete-btn-fillter flex items-center gap-2"> <span><?php echo __('Xóa bộ lọc', 'canhcamtheme'); ?></span>
									<div class="icon-fillter"> <i class="fa-regular fa-arrows-rotate"></i></div>
								</div>
								<div class="icon-left"><i class="fa-solid fa-chevron-down"></i></div>
							</div>
						</div>
						<ul class="product-main">
							<li class="has-children"><a href="#"><?php echo __('Xuất xứ', 'canhcamtheme'); ?></a>
								<ul class="product-level-1">
									<?php echo do_shortcode('[facetwp facet="product_filter_source"]') ?>
								</ul>
							</li>
							<li class="has-children"><a href="#"><?php echo __('Mác thép', 'canhcamtheme'); ?></a>
								<ul class="product-level-1">
									<?php echo do_shortcode('[facetwp facet="products_filter_mas"]') ?>
								</ul>
							</li>
							<li class="has-children"><a href="#"><?php echo __('Nhà máy', 'canhcamtheme'); ?></a>
								<ul class="product-level-1">
									<?php echo do_shortcode('[facetwp facet="products_filter_factory"]') ?>
								</ul>
							</li>
							


						</ul>
					</div>
				</div>
			</div>
			<div class="col-right lg:w-9/12 md:w-8/12 w-full">
				<?php
				$current_term = get_queried_object();
				$category_title = esc_html($current_term->name);

				?>
				<h2 class="title-40 mb-base !font-normal"><?php echo $category_title; ?></h2>
				<div class="col-right-product-list grid xl:grid-cols-3 grid-cols-2 xl:gap-base gap-3 lg:mt-0 facetwp-template">


					<?php
					if (wc_get_loop_prop('total')) {
						while (have_posts()) {
							the_post();

							do_action('woocommerce_shop_loop');

							wc_get_template_part('content', 'product');
						}
					}
					?>

				</div>
				<div class="pagination mt-base">
					<?php echo do_shortcode('[facetwp facet="products_pagination_page"]') ?>
				</div>
			</div>
		</div>
	</div>
</section>
<style>
	.delete-btn-fillter.loading .icon-fillter i {
		animation: spin 1s linear infinite;
	}

	@keyframes spin {
		0% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(360deg);
		}
	}
</style>
<?php

get_footer();
?>