<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;
$general_information = get_post_meta($product->get_id(), 'general_information', true);
$mechanical_properties = get_post_meta($product->get_id(), 'mechanical_properties', true);
$chemical_properties = get_post_meta($product->get_id(), 'chemical_properties', true);

$link_contact = get_field('link_contactproduct', 'option');
?>

<?php get_template_part('./template-parts/section', 'breadcrumb'); ?>

<section class="product-detail section-py">
	<div class="container">
		<div class="product-detail-main flex flex-col lg:flex-row gap-20">
			<div class="col-left lg:rem:w-[680px] w-full">
				<div class="product-slide-images flex flex-col-reverse lg:flex-row gap-5">
					<div class="product-slide-thumbs w-full lg:rem:w-[80px] flex-shrink-0 relative">
						<div class="lg:absolute top-0 left-0 h-full w-full lg:flex lg:flex-col flex-row lg:items-center">
							<div class="btn btn-prev btn-sw-1 blue"></div>
							<div class="swiper w-full h-full lg:rem:py-[29px] py-3">
								<div class="swiper-wrapper">
									<?php foreach ($product->get_gallery_image_ids() as $image_id) : ?>
										<div class="swiper-slide">
											<div class="img img-ratio img-full h-full"><img class="lozad undefined" data-src="<?php echo wp_get_attachment_url($image_id) ?>" alt="" />
											</div>
										</div>
									<?php endforeach; ?>

								</div>
							</div>
							<div class="btn btn-next btn-sw-1 blue"></div>
						</div>
					</div>
					<div class="product-slide-main relative lg:w-[calc(100%-4.166666666666667rem-1.04167rem)] w-full">
						<div class="swiper">
							<div class="swiper-wrapper">
								<?php foreach ($product->get_gallery_image_ids() as $image_id) : ?>
									<div class="swiper-slide"><a class="img img-ratio rounded-5" data-fancybox="product-detail"><img class="lozad undefined" data-src="<?php echo wp_get_attachment_url($image_id) ?>" alt="" /></a></div>
								<?php endforeach; ?>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-right lg:w-[calc(100%-35.41666666666667rem-4.16667rem)] w-full flex flex-col">
				<h1 class="product-title title-40 !font-normal mb-6"><?php echo $product->get_name() ?></h1>
				<div class="format-content">
					<?php echo $product->get_description() ?>
					<table>
						<?php foreach ($product->get_attributes() as $attribute) : ?>
							<tr>
								<td><?php echo wc_attribute_label($attribute->get_name()); ?>:</td>
								<td class="parameter">
									<?php
									// Lấy danh sách các giá trị của thuộc tính
									$values = [];

									if ($attribute->is_taxonomy()) {
										// Nếu là taxonomy attribute (vd: color, size), lấy terms
										$terms = wp_get_post_terms($product->get_id(), $attribute->get_name(), ['fields' => 'names']);
										$values = $terms;
									} else {
										// Nếu là custom attribute (vd: nhập tay)
										$values = $attribute->get_options();
									}

									// Hiển thị ra chuỗi phân cách bằng dấu phẩy
									echo implode(', ', $values);
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>

				</div>
				<div class="product-wrap-contact mt-auto">
				<div class="product-btn-contact"> <a class="btn btn-primary" href="<?php echo !empty($link_contact) ? $link_contact['url'] : '#' ?>">
					<span><?php echo !empty($link_contact) ? $link_contact['title'] : __('Liên hệ tư vấn', 'canhcamtheme') ?></span>
				</a></div>
					<div class="product-detail-share mt-3"> <span><?php echo __('Chia sẻ:', 'canhcamtheme') ?></span>
						<div class="social"> <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>"><i class="fa-brands fa-facebook-f"></i></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="product-detail-tab" data-toggle="tabslet">
	<ul class="tabslet-tab product-detail-list">
		<li class="active"><a href="#tab1"><?php echo __('Thông tin chung', 'canhcamtheme') ?></a></li>
		<li><a href="#tab2"><?php echo __('Tính chất cơ lý', 'canhcamtheme') ?></a></li>
		<li><a href="#tab3"><?php echo __('Tính chất hóa học', 'canhcamtheme') ?></a></li>
	</ul>
	<div class="product-detail-tab-content bg-Utility-50 section-py">
		<div class="container">

			<div class="tabslet-content active" id="tab1">
				<div class="general-info">
					<div class="format-content">
						<?php echo !empty($general_information) ? $general_information : __('Không có thông tin', 'canhcamtheme') ?>
						<div class="button-read-more flex items-center justify-center mt-base"><a href="#"> <span><?php echo __('Xem thêm','canhcamtheme');?></span><i class="fa-light fa-angle-down"></i></a></div>
					</div>
				</div>
			</div>
			<div class="tabslet-content" id="tab2">
				<div class="format-content">
					<?php echo !empty($mechanical_properties) ? $mechanical_properties : __('Không có thông tin', 'canhcamtheme') ?>
				</div>
			</div>
			<div class="tabslet-content" id="tab3">
				<div class="format-content">
					<?php echo !empty($chemical_properties) ? $chemical_properties : __('Không có thông tin', 'canhcamtheme') ?>
				</div>
			</div>

		</div>
	</div>
</div>

<section class="product-detail-2 section-py">
	<div class="container">
		<div class="heading flex items-center xl:justify-center justify-between xl:mb-0 mb-base">
			<h2 class="xl:text-center text-left heading-2 text-Primary-2 font-bold xl:mb-base mb-0"><?php echo __('Sản phẩm liên quan', 'canhcamtheme') ?></h2>
			<div class="btn-mobile xl:hidden flex items-center gap-3">
				<div class="btn btn-prev btn-sw-1"></div>
				<div class="btn btn-next btn-sw-1"></div>
			</div>
		</div>
		<div class="product-detail-2-related relative">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php
					$current_product_id = $product->get_id();

					// Lấy taxonomy terms của sản phẩm hiện tại (vd: product_cat)
					$current_terms = wp_get_post_terms($current_product_id, 'product_cat', ['fields' => 'ids']);

					$args = array(
						'post_type' => 'product',
						'posts_per_page' => 6,
						'orderby' => 'date',
						'order' => 'DESC',
						'post__not_in' => array($current_product_id),
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'term_id',
								'terms'    => $current_terms,
							),
						),
					);

					$products = new WP_Query($args);

					while ($products->have_posts()) : $products->the_post();
						$loop_product = wc_get_product(get_the_ID()); // 🔧 Đây là sản phẩm trong vòng lặp
					?>
						<div class="swiper-slide">
							<div class="product-item bg-Utility-50 md:p-5 p-2 group rounded-5 overflow-hidden"">
								<div class="image">
									<a class="img-ratio zoom-img-1 rounded-5" href="<?php echo get_the_permalink(); ?>">
										<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" />
									</a>
								</div>
								<div class="content pt-6">
									<h3 class="heading-4 text-Utility-Black font-bold group-hover:text-Primary-2">
										<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
									</h3>
									<div class="product-parameter flex flex-col gap-3 mt-3">
										<?php foreach ($loop_product->get_attributes() as $attribute): ?>
											<div class="product-info flex items-center gap-2">
												<div class="left flex-shrink-0">
													<div class="title text-Neutral-500-main font-normal">
														<?php echo wc_attribute_label($attribute->get_name()); ?>:
													</div>
												</div>
												<div class="right">
													<div class="text text-Utility-700 font-normal">
														<?php
														$values = [];

														if ($attribute->is_taxonomy()) {
															$terms = wp_get_post_terms($loop_product->get_id(), $attribute->get_name(), ['fields' => 'names']);
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
									<div class="product-btn inline-flex mt-6">
										<a class="btn btn-primary" href="<?php echo get_the_permalink(); ?>">
											<span><?php echo __('Xem thêm', 'canhcamtheme'); ?></span>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
			<div class="wrap-button-slide">
				<div class="btn btn-prev btn-sw-1 blue"></div>
				<div class="btn btn-next btn-sw-1 blue"></div>
			</div>
		</div>
	</div>
</section>

<?php do_action('woocommerce_after_single_product'); ?>