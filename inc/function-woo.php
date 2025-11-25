<?php

/**
 * Woo - add theme support
 */
function disable_shipping_calc_on_cart($show_shipping)
{
	if (is_cart()) {
		return false;
	}
	return $show_shipping;
}
// add_filter('woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99);


add_action('after_setup_theme', 'woocommerce_support');

function woocommerce_support()
{
	add_theme_support('woocommerce');
}

/**
 * Woo - Remove default styles except cart and checkout pages
 */
add_filter('woocommerce_enqueue_styles', 'custom_woocommerce_styles');
function custom_woocommerce_styles($enqueue_styles)
{
	// Chỉ giữ styles trên trang Cart và Checkout
	//  || is_checkout()
	if (is_cart() || !empty(is_wc_endpoint_url('order-received'))) {
		return $enqueue_styles; // Giữ nguyên styles của WooCommerce
	} else {
		return array(); // Không nạp styles trên các trang khác
	}
}


// Remove woo breadcrumb
// remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
// remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
// remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
// remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
// remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
// remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

// add_action('woocommerce_before_main_content', 'woocommerce_output_all_notices', 10);
// remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);

// remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

// Hook: woocommerce_single_product_summary.
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);




add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);
function new_loop_shop_per_page($cols)
{
	// $cols contains the current number of products per page based on the value stored on Options –> Reading
	// Return the number of products you wanna show per page.
	$cols = 9;
	return $cols;
}


// Change add to cart text on single product page
add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_add_to_cart_button_text_single');
function woocommerce_add_to_cart_button_text_single()
{
	echo __('Add to cart', 'canhcamtheme');
}




function ajax_qty_cart()
{
	// Check if the necessary POST parameters are set
	if (isset($_POST['hash'], $_POST['quantity'])) {
		// Sanitize the input to avoid security vulnerabilities
		$ITEM_KEY = sanitize_text_field($_POST['hash']);
		$POST_QUANTITY = intval($_POST['quantity']); // Ensure the quantity is an integer

		// Get the cart item array
		$cart_item = WC()->cart->get_cart_item($ITEM_KEY);

		// Check if the cart item exists and if the quantity is a positive number
		if ($cart_item && $POST_QUANTITY > 0) {
			// Apply the woocommerce_update_cart_validation filter
			$passed_validation = apply_filters('woocommerce_update_cart_validation', true, $ITEM_KEY, $cart_item, $POST_QUANTITY);
			if ($passed_validation) {
				// Update the cart item quantity
				WC()->cart->set_quantity($ITEM_KEY, $POST_QUANTITY, true); // true forces the quantity update

				// Refresh cart fragments to update on the frontend
				WC_AJAX::get_refreshed_fragments();

				// Recalculate totals and update the cart cookies
				WC()->cart->calculate_totals();
				WC()->cart->maybe_set_cart_cookies();
			}
		}
		if ($cart_item && $POST_QUANTITY === 0) {
			WC()->cart->remove_cart_item($ITEM_KEY);
			WC_AJAX::get_refreshed_fragments();
			WC()->cart->calculate_totals();
			WC()->cart->maybe_set_cart_cookies();
		}
	}

	wp_die();
}


add_action('wp_ajax_ajax_qty_cart', 'ajax_qty_cart');
add_action('wp_ajax_nopriv_ajax_qty_cart', 'ajax_qty_cart');


add_action('wp_footer', 'add_script_handle_quantity');
function add_script_handle_quantity()
{
?>
	<script>
		jQuery(function($) {
			// Định nghĩa hàm getDecimals trước
			const getDecimals = (num) => {
				const str = String(num);
				const match = str.match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
				return match ? Math.max(0, (match[1]?.length || 0) - (match[2] ? Number(match[2]) : 0)) : 0;
			};

			// Xử lý sự kiện click cho plus/minus
			$(document).on('click', '.plus, .minus', function(e) {
				e.preventDefault(); // Ngăn submit form mặc định gây reload trang

				// if ($(this).closest('#mini-cart-wrapper-inquiry').length) {
				// 	return;
				// }

				const $qty = $(this).closest('.btn-quantity').find('.qty-input');
				const isPlus = $(this).hasClass('plus');

				// Kiểm tra nếu đang trong mini-cart
				// const isMiniCart = $(this).closest('.mini-cart-item').length > 0;

				// Lấy và chuẩn hóa giá trị
				let currentVal = parseFloat($qty.val()) || 0;
				const max = parseFloat($qty.attr('max')) || Infinity;
				const min = parseFloat($qty.attr('min')) || 0;
				const step = parseFloat($qty.attr('step')) || 1;

				// Tính giá trị mới
				const stepDecimals = getDecimals(step);
				let newVal = isPlus ? currentVal + step : currentVal - step;

				// Giới hạn giá trị
				if (isPlus && newVal > max) {
					newVal = max;
				} else if (!isPlus && newVal < min) {
					newVal = min;
				}

				// Cập nhật giá trị
				$qty.val(newVal.toFixed(stepDecimals));

				// Trigger sự kiện
				$qty.trigger('change');

				// Nếu không phải mini-cart, kích hoạt sự kiện để cập nhật UI khác
				// if (!isMiniCart) {
				// 	$(document.body).trigger('updated_wc_div').trigger('wc_fragments_refreshed');
				// }
			});

			// Xử lý cập nhật số lượng cho tất cả các input (bao gồm cả mini-cart)
			$(document).on('change', 'input.qty-input', function() {
				// Bỏ qua xử lý cho inquiry cart
				// if ($(this).closest('#mini-cart-wrapper-inquiry').length || $(this).closest('.popup-detail').length) {
				// 	return;
				// }

				var item_key = $(this)
					.attr('name')
					.replace(/cart\[([\w]+)\]\[qty\]/g, '$1');
				var quantity = $(this).val();
				var currentInput = $(this);


				// Hiển thị loading
				$('.cart-badge').addClass('loading');
				$('.loading-container').addClass('active');

				// Nếu là mini-cart, hiển thị loading ở item đó
				// if ($(this).closest('.mini-cart-item').length) {
				//     var $cartItem = $(this).closest('.mini-cart-item');
				//     $cartItem.addClass('loading');
				//     $cartItem.append('<div class="loading-overlay"><span class="spinner"></span></div>');
				// }
				$('.mini-cart-wrapper').addClass('loading');
				$('.mini-cart-wrapper').append('<div class="loading-overlay"><span class="spinner"></span></div>');

				// Gửi AJAX request
				$.ajax({
					type: 'POST',
					url: lz.ajax_url,
					data: {
						action: 'ajax_qty_cart',
						hash: item_key,
						quantity: quantity,
					},
					success: function(response) {
						if (!response || response.error) {
							console.error('Quantity update Error: ' + response);
						} else {
							// Xử lý fragments để cập nhật mini-cart
							console.log(response.fragments);
							if (response.fragments) {
								$.each(response.fragments, function(key, value) {
									if (key === 'div.shopping-cart-content') {
										$('.shopping-cart-content').html(value);
									} else {
										$(key).replaceWith(value);
									}

								});

								// Cập nhật hash trong sessionStorage
								if (response.cart_hash) {
									sessionStorage.setItem('wc_cart_hash', response.cart_hash);
								}

								// Kích hoạt sự kiện để các plugin khác biết cart đã được cập nhật
								$(document.body).trigger('wc_fragments_refreshed');
							}

							// Cập nhật trang giỏ hàng nếu cần
							if (currentInput.closest('.cart-page').length) {
								updateCartPageNoResponse();
							}
						}
					},
					error: function() {
						console.error('Quantity update error');
					},
					complete: function() {
						// Loại bỏ tất cả trạng thái loading
						$('.loading-container').removeClass('active');
						$('.mini-cart-item.loading').removeClass('loading');
						$('.loading-overlay').remove();
						$('.cart-badge').removeClass('loading');
					},
				});
			});

			function updateCartPageNoResponse() {
				<?php
				global $wp;
				?>
				$.ajax({
					url: "<?= home_url($wp->request) ?>",
					beforeSend: function() {
						$('.loading-container').addClass('active')
					},
					success: function(response) {
						const cartList = $(response).find('.mini-cart-wrapper .middle .list');
						const cartCollaterals = $(response).find('.cart-collaterals');
						const empty = $(response).find('.empty-cart-content')
						if (cartList.length) {
							$('.mini-cart-wrapper .middle .list').html(cartList.html());
						}
						if (cartCollaterals.length) {
							$('.cart-collaterals').html(cartCollaterals.html());
						}
						if (empty.length) {
							$('.cart-page').html($(response).find('.cart-page').html());
						}
					},
					error: function() {
						console.error('Quantity update error');
					},
					complete: function() {
						$('.loading-container').removeClass('active');
						$('.mini-cart-item.loading').removeClass('loading');
						$('.loading-overlay').remove();
						$('.cart-badge').removeClass('loading');
					},
				})
			}

			window.lzWoo = {
				updateCartPageNoResponse: updateCartPageNoResponse
			}

			// Thêm CSS cho loading trong mini-cart
			$('<style>.mini-cart-item.loading{position:relative;opacity:.7;pointer-events:none}.loading-overlay{position:absolute;top:0;left:0;right:0;bottom:0;background:rgba(255,255,255,.5);display:flex;align-items:center;justify-content:center;z-index:5}.spinner{width:25px;height:25px;border:3px solid rgba(0,0,0,.1);border-radius:50%;border-top-color:#333;animation:spin 1s ease-in-out infinite}@keyframes spin{to{transform:rotate(360deg)}}</style>').appendTo('head');
		});
	</script>
<?php
};


add_action('wp_ajax_woo_ajax_add_to_cart', 'woo_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woo_ajax_add_to_cart', 'woo_ajax_add_to_cart');
function woo_ajax_add_to_cart()
{
	$product_id = apply_filters('ql_woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
	$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
	$variation_id = absint($_POST['variation_id']);
	$passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
	$product_status = get_post_status($product_id);
	if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
		do_action('ql_woocommerce_ajax_added_to_cart', $product_id);
		if ('yes' === get_option('ql_woocommerce_cart_redirect_after_add')) {
			wc_add_to_cart_message(array($product_id => $quantity), true);
		}
		WC_AJAX::get_refreshed_fragments();
	} else {
		$data = array(
			'error' => true,
			'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
		);
		echo wp_send_json($data);
	}
	wp_die();
}


add_filter('woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
function wc_refresh_mini_cart_count($fragments)
{
	ob_start();
	$items_count = WC()->cart->get_cart_contents_count();
	$has_quantity = $items_count > 0;
	// if ($has_quantity) {
	// 	$items_count = $items_count > 99 ? "99+" : $items_count;
	// } else {
	// 	$items_count = 0;
	// }
	echo '<div class="cart-quantity cart-quantity-header' . ($has_quantity ? ' show-quantity' : '') . '">' . $items_count . '</div>';
	$fragments['.cart-quantity-header'] = ob_get_clean();
	return $fragments;
}


add_filter('woocommerce_add_to_cart_fragments', 'wc_refresh_product_count');
function wc_refresh_product_count($fragments)
{
	ob_start();
	$cart_item_count = WC()->cart->get_cart_contents_count();

	echo '<span class="mini-cart-product-count">' . $cart_item_count . '</span>';

	$fragments['.mini-cart-product-count'] = ob_get_clean();
	return $fragments;
}

add_filter('woocommerce_add_to_cart_fragments', 'wc_refresh_product_total');
function wc_refresh_product_total($fragments)
{
	ob_start();
	$cart_total = WC()->cart->get_cart_subtotal();
?>
	<span class="mini-cart-total-price">
		<?php echo $cart_total; ?>
	</span>
<?php
	$fragments['.mini-cart-total-price'] = ob_get_clean();
	return $fragments;
}


//  *** Custom pagination for WooCommerce ***
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

// Disable to remove pagination
// add_action('woocommerce_after_shop_loop', 'custom_woocommerce_pagination', 10);

function custom_woocommerce_pagination()
{
	global $wp_query;
	// Overwrite default woocommerce pagination

	wp_bootstrap_pagination(array(
		'custom_query' => $wp_query
	));
}
// ! End Custom pagination for WooCommerce


// *** Auto select first variation ***
add_filter('woocommerce_dropdown_variation_attribute_options_args', 'fun_select_default_option', 10, 1);
function fun_select_default_option($args)
{
	$params = 'attribute_' . $args['attribute'];
	$currentUrl = $_SERVER['REQUEST_URI'];
	$active_first_variant = strpos($currentUrl, $params);
	if (count($args['options']) > 0)
		if ($active_first_variant === false)
			$args['selected'] = $args['options'][0];
	return $args;
}

remove_action('woocommerce_cart_is_empty', 'wc_empty_cart_message', 10);
add_action('woocommerce_cart_is_empty', 'custom_empty_cart_message', 10);

function custom_empty_cart_message()
{
	$html  = '<div class="empty-cart-content"><p class="cart-empty">';
	$html .= wp_kses_post(apply_filters('wc_empty_cart_message', __('Giỏ hàng đang trống, quay lại mua hàng ?', 'woocommerce')));
	echo $html . '</p></div>';
}



// *** Error message under field */ // Checkout form field
// add_filter('woocommerce_form_field', 'woocommerce_checkout_fields_inline_error', 10, 4);
function woocommerce_checkout_fields_inline_error($field, $key, $args, $value)
{
	if ($args['required']) {
		$error = '<span class="error" style="display:none">';
		$error .= sprintf(__('* Enter %s', 'canhcamtheme'), $args['label']);
		$error .= '</span>';

		// Insert the error after the input field
		$closing_div_pos = strrpos($field, '</p>');  // Assuming fields are wrapped in <p> tags
		if ($closing_div_pos !== false) {
			$field = substr_replace($field, $error, $closing_div_pos, 0);
		}
	}
	return $field;
}

// add_filter('woocommerce_form_field', 'checkout_fields_in_label_error', 10, 4);
// function checkout_fields_in_label_error($field, $key, $args, $value)
// {
//     if (strpos($field, '</span>') !== false && $args['required']) {
//         $error = '<span class="error" style="display:none">';
//         $error .= sprintf(__('%s là trường bắt buộc.', 'woocommerce'), '<strong>' . $args['label'] . '</strong>');
//         $error .= '</span>';
//         $field = substr_replace($field, $error, strpos($field, '</span>'), 0);
//     }
//     return $field;
// }


add_action('woocommerce_before_checkout_form', 'hide_checkout_coupon_form', 5);
function hide_checkout_coupon_form()
{
	echo '<style>.woocommerce-form-coupon-toggle {display:none;}</style>';
}

// *** Move coupon form to col right ***
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form');
add_action('woocommerce_checkout_after_order_review', 'woocommerce_checkout_coupon_form');

// *** Split Payment method + Order Total ***
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
add_action('woocommerce_checkout_shipping', 'woocommerce_checkout_payment', 20);

add_action('woocommerce_after_checkout_billing_form', 'devvn_xuat_hoa_don_vat');
function devvn_xuat_hoa_don_vat()
{
?>
	<style>
		.devvn_xuat_vat_wrap {
			display: none;
		}

		label.devvn_xuat_vat_input_label {
			display: block;
			cursor: pointer;
			margin-bottom: 0;
		}
	</style>
	<div class="devvn_xuat_hoa_don_do">
		<label class="devvn_xuat_vat_input_label">
			<input class="devvn_xuat_vat_input" type="checkbox" name="devvn_xuat_vat_input" value="1">
			<span><?php _e('Xuất hóa đơn', 'canhcamtheme'); ?></span>
		</label>
		<div class="devvn_xuat_vat_wrap">
			<p class="form-row form-row-first" id="billing_vat_company_field">
				<label for="billing_vat_company" class=""><?php _e('Tên công ty', 'canhcamtheme'); ?> <abbr class="required" title="bắt buộc">*</abbr></label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_vat_company" id="billing_vat_company" placeholder="" value="">
				</span>
			</p>
			<p class="form-row form-row-last" id="billing_vat_mst_field">
				<label for="billing_vat_mst" class=""><?php _e('MST công ty', 'canhcamtheme'); ?> <abbr class="required" title="bắt buộc">*</abbr></label>
				<span class="woocommerce-input-wrapper">
					<input type="text" class="input-text " name="billing_vat_mst" id="billing_vat_mst" placeholder="" value="">
				</span>
			</p>
			<p class="form-row form-row-wide " id="billing_vat_companyaddress_field">
				<label for="billing_vat_companyaddress" class=""><?php _e('Địa chỉ công ty', 'canhcamtheme'); ?> <abbr class="required" title="bắt buộc">*</abbr></label>
				<span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_vat_companyaddress" id="billing_vat_companyaddress" placeholder="" value=""></span>
			</p>
		</div>
	</div>
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				function check_vat() {
					var parentVAT = $('input.devvn_xuat_vat_input').closest('.devvn_xuat_hoa_don_do');
					var content = $('input.devvn_xuat_vat_input').closest('.devvn_xuat_hoa_don_do').find('.devvn_xuat_vat_wrap')
					if ($('input.devvn_xuat_vat_input').is(":checked")) {
						parentVAT.addClass('vat_active');
						content.slideDown()
					} else {
						parentVAT.removeClass('vat_active');
						content.slideUp()
					}
				}
				check_vat();
				$('input.devvn_xuat_vat_input').on('change', function() {
					check_vat();
				});
			});
		})(jQuery);
	</script>
<?php
}


add_action('woocommerce_checkout_process', 'vat_checkout_field_process');
function vat_checkout_field_process()
{
	if (isset($_POST['devvn_xuat_vat_input']) && !empty($_POST['devvn_xuat_vat_input'])) {
		if (empty($_POST['billing_vat_company'])) {
			wc_add_notice(__('Hãy nhập tên công ty', 'canhcamtheme'), 'error');
		}
		if (empty($_POST['billing_vat_mst'])) {
			wc_add_notice(__('Hãy nhập mã số thuế', 'canhcamtheme'), 'error');
		}
		if (empty($_POST['billing_vat_companyaddress'])) {
			wc_add_notice(__('Hãy nhập địa chỉ công ty', 'canhcamtheme'), 'error');
		}
	}
}


add_action('woocommerce_checkout_update_order_meta', 'vat_checkout_field_update_order_meta');
function vat_checkout_field_update_order_meta($order_id)
{
	$order = wc_get_order($order_id);
	if ($order && !is_wp_error($order) && isset($_POST['devvn_xuat_vat_input']) && !empty($_POST['devvn_xuat_vat_input'])) {
		$order->update_meta_data('devvn_xuat_vat_input', intval($_POST['devvn_xuat_vat_input']));
		if (isset($_POST['billing_vat_company']) && !empty($_POST['billing_vat_company'])) {
			$order->update_meta_data('billing_vat_company', sanitize_text_field($_POST['billing_vat_company']));
		}
		if (isset($_POST['billing_vat_mst']) && !empty($_POST['billing_vat_mst'])) {
			$order->update_meta_data('billing_vat_mst', sanitize_text_field($_POST['billing_vat_mst']));
		}
		if (isset($_POST['billing_vat_companyaddress']) && !empty($_POST['billing_vat_companyaddress'])) {
			$order->update_meta_data('billing_vat_companyaddress', sanitize_text_field($_POST['billing_vat_companyaddress']));
		}
		$order->save();
	}
}

add_action('woocommerce_admin_order_data_after_shipping_address', 'devvn_after_shipping_address_vat', 99);
function devvn_after_shipping_address_vat($order)
{
	$devvn_xuat_vat_input = $order->get_meta('devvn_xuat_vat_input');
	$billing_vat_company = $order->get_meta('billing_vat_company');
	$billing_vat_mst = $order->get_meta('billing_vat_mst');
	$billing_vat_companyaddress = $order->get_meta('billing_vat_companyaddress');
?>
	<p><strong><?php _e('Xuất hóa đơn', 'canhcamtheme'); ?>:</strong> <?php echo ($devvn_xuat_vat_input) ? _e('Có', 'canhcamtheme') : _e('Không', 'canhcamtheme'); ?></p>
	<?php
	if ($devvn_xuat_vat_input):
	?>
		<p>
			<strong><?php _e('Thông tin xuất hóa đơn', 'canhcamtheme'); ?>:</strong><br>
			<?php _e('Tên công ty', 'canhcamtheme'); ?>: <?php echo $billing_vat_company; ?><br>
			<?php _e('Mã số thuế', 'canhcamtheme'); ?>: <?php echo $billing_vat_mst; ?><br>
			<?php _e('Địa chỉ', 'canhcamtheme'); ?>: <?php echo $billing_vat_companyaddress; ?><br>
		</p>
<?php
	endif;
}


// Custom stock availability text
add_filter('woocommerce_get_availability_text', 'customizing_stock_availability_text', 1, 2);
function customizing_stock_availability_text($availability, $product)
{
	if (!$product->is_in_stock()) {
		$availability = __('Sold Out', 'woocommerce');
	} elseif ($product->managing_stock() && $product->is_on_backorder(1)) {
		$availability = $product->backorders_require_notification() ? __('Available on backorder', 'woocommerce') : '';
	} elseif ($product->managing_stock()) {
		$availability = __('Còn hàng.', 'woocommerce');
		$stock_amount = $product->get_stock_quantity();

		switch (get_option('woocommerce_stock_format')) {
			case 'low_amount':
				if ($stock_amount <= get_option('woocommerce_notify_low_stock_amount')) {
					/* translators: %s: stock amount */
					$availability = sprintf(__('Chỉ có %s còn lại!', 'woocommerce'), wc_format_stock_quantity_for_display($stock_amount, $product));
				}
				break;
			case '':
				/* translators: %s: stock amount */
				$availability = sprintf(__('Còn %s sản phẩm', 'woocommerce'), wc_format_stock_quantity_for_display($stock_amount, $product));
				break;
		}

		if ($product->backorders_allowed() && $product->backorders_require_notification()) {
			$availability .= ' ' . __('(có thể đặt trước)', 'woocommerce');
		}
	} else {
		$availability = '';
	}

	return $availability;
}

/**
 * Add minus/plus buttons to quantity inputs in cart
 */
// add_filter('woocommerce_cart_item_quantity', 'custom_cart_item_quantity', 10, 3);
// function custom_cart_item_quantity($product_quantity, $cart_item_key, $cart_item)
// {
//     $product = $cart_item['data'];
//     $max = $product->get_max_purchase_quantity();
//     $min = $product->get_min_purchase_quantity();

//     // Add qty-input class to the input field
//     $product_quantity = str_replace('input-text qty text', 'input-text qty text qty-input', $product_quantity);

//     $quantity_input = sprintf(
//         '<div class="quantity-wrapper mt-3 flex items-center gap-3">
//             <div class="label">%s</div>
//             <div class="btn-quantity quantity">
//                 <button type="button" class="minus"><i class="fa-light fa-minus"></i></button>
//                 %s
//                 <button type="button" class="plus"><i class="fa-light fa-plus"></i></button>
//             </div>
//         </div>',
//         __('Quantity', 'canhcamtheme'),
//         $product_quantity
//     );

//     return $quantity_input;
// }


// add_filter('woocommerce_quantity_input_args', 'custom_quantity_input_args', 10, 2);
// function custom_quantity_input_args($args, $product) {
//     $args['input_name'] = 'quantity'; // Đặt tên cho input
//     $args['class'] = 'qty-input';
//     return $args;
// }

// add_action('woocommerce_before_quantity_input_field', 'custom_quantity_wrapper_start');
// function custom_quantity_wrapper_start() {
//     echo '<div class="quantity-wrapper mt-3 flex flex-col gap-3"><div class="label">Quantity</div><div class="btn-quantity quantity"><button class="minus"><i class="fa-light fa-minus"></i></button>';
// }

// add_action('woocommerce_after_quantity_input_field', 'custom_quantity_wrapper_end');
// function custom_quantity_wrapper_end() {
//     echo '<button class="plus"><i class="fa-light fa-plus"></i></button></div></div>';
// }

// ====================== page checkout ======================

add_filter('woocommerce_enable_order_notes_field', '__return_false');



add_filter('woocommerce_sale_flash', 'devvn_woocommerce_sale_flash', 10, 3);
function devvn_woocommerce_sale_flash($html, $post, $product)
{
	return '<span class="onsale"><span>' . devvn_presentage_bubble($product) . '</span></span>';
}

function devvn_presentage_bubble($product)
{
	$post_id = $product->get_id();

	if ($product->is_type('simple') || $product->is_type('external')) {
		$regular_price  = $product->get_regular_price();
		$sale_price     = $product->get_sale_price();
		$bubble_content = round(((floatval($regular_price) - floatval($sale_price)) / floatval($regular_price)) * 100);
	} elseif ($product->is_type('variation')) {
		$regular_price  = $product->get_regular_price();
		$sale_price     = $product->get_sale_price();
		$bubble_content = round(((floatval($regular_price) - floatval($sale_price)) / floatval($regular_price)) * 100);
	} elseif ($product->is_type('variable')) {
		if ($bubble_content = devvn_percentage_get_cache($post_id)) {
			return devvn_percentage_format($bubble_content);
		}

		$available_variations = $product->get_available_variations();
		$maximumper           = 0;

		for ($i = 0; $i < count($available_variations); ++$i) {
			$variation_id     = $available_variations[$i]['variation_id'];
			$variable_product = new WC_Product_Variation($variation_id);
			if (! $variable_product->is_on_sale()) {
				continue;
			}
			$regular_price = $variable_product->get_regular_price();
			$sale_price    = $variable_product->get_sale_price();
			$percentage    = round(((floatval($regular_price) - floatval($sale_price)) / floatval($regular_price)) * 100);
			if ($percentage > $maximumper) {
				$maximumper = $percentage;
			}
		}

		$bubble_content = sprintf(__('%s', 'woocommerce'), $maximumper);

		devvn_percentage_set_cache($post_id, $bubble_content);
	} else {
		$bubble_content = __('Sale!', 'woocommerce');

		return $bubble_content;
	}

	return devvn_percentage_format($bubble_content);
}

function devvn_percentage_get_cache($post_id)
{
	return get_post_meta($post_id, '_devvn_product_percentage', true);
}

function devvn_percentage_set_cache($post_id, $bubble_content)
{
	update_post_meta($post_id, '_devvn_product_percentage', $bubble_content);
}

//Định dạng kết quả dạng -{value}%. Ví dụ -20%
function devvn_percentage_format($value)
{
	return str_replace('{value}', $value, '<span class="label-sale-price"><span>{value}%</span></span>');
}

// thêm phần trăm giảm giá vào giá sản phẩm
function add_sale_tag($product)
{
	// Sử dụng hàm devvn_presentage_bubble để lấy phần trăm giảm giá chính xác
	$percentage_value = strip_tags(devvn_presentage_bubble($product));
	$percentage_value = preg_replace('/[^0-9]/', '', $percentage_value);
	if ($percentage_value > 0) {
		// Trả về giá với phần trăm giảm giá
		return ' <div class="sale sale-value">(' . $percentage_value . '%)</div>';
		// return ' <div class="sale py-0.5 rem:px-[6px] bg-primary-Orange text-center subheader-20 text-white w-fit">' . $percentage_value . '%</div>';
	}
}

// thêm phần trăm giảm giá vào giá sản phẩm
add_filter('woocommerce_get_price_html', 'add_percentage_to_price', 20, 2);
function add_percentage_to_price($price_html, $product)
{
	// Only add percentage tag if product is on sale
	if ($product->is_on_sale()) {
		$sale_tag = add_sale_tag($product);
		if ($sale_tag) {
			$price_html = $price_html . $sale_tag;
		}
	}
	return $price_html;
}

// thêm phần trăm giảm giá vào giá sản phẩm biến thể
add_filter('woocommerce_available_variation', 'add_variation_percentage_to_variation_prices', 10, 3);
function add_variation_percentage_to_variation_prices($variation_data, $product, $variation)
{
	if ($variation->is_on_sale()) {
		$sale_tag = add_sale_tag($variation);
		if ($sale_tag) {
			$variation_data['price_html'] = $variation_data['price_html'] . $sale_tag;
		}
	}
	return $variation_data;
}

// Show minimun price of variation instead of range price
add_filter('woocommerce_variable_price_html', 'custom_variable_price_html', 10, 2);
function custom_variable_price_html($price, $product)
{
	$prices = $product->get_variation_prices(true);

	if (empty($prices['price'])) {
		return $price;
	}

	$min_price = current($prices['price']);
	$min_regular_price = current($prices['regular_price']);

	if ($product->is_on_sale()) {
		$price = wc_format_sale_price($min_regular_price, $min_price) . $product->get_price_suffix();
	} else {
		$price = wc_price($min_price) . $product->get_price_suffix();
	}

	return $price;
}




//! Fix price not render if product variation have same price
add_filter('woocommerce_show_variation_price', '__return_true');


function get_suggest_search()
{
	$value = $_GET['value'];
	$product_query = new WP_Query([
		'post_type' => 'product',
		'posts_per_page' => 10,
		's' => $value
	]);
	$news_query = new WP_Query([
		'post_type' => 'post',
		'posts_per_page' => 10,
		's' => $value
	]);
	$response = "";
	ob_start();
	if ($product_query->have_posts()) {
		echo '<div class="category-title">' . __("Product") . '</div>';
		while ($product_query->have_posts()) {
			$product_query->the_post();
			get_template_part('components/suggestSearch/suggestSearchItem', null, array('id' => get_the_ID()));
		}
		wp_reset_postdata();
	}
	if ($news_query->have_posts()) {
		echo '<div class="category-title">' . __("News") . '</div>';
		while ($news_query->have_posts()) {
			$news_query->the_post();
			get_template_part('components/suggestSearch/suggestSearchItem', null, array('id' => get_the_ID()));
		}
		wp_reset_postdata();
	}
	$response .= ob_get_clean();
	echo $response;
	wp_die();
}
add_action('wp_ajax_get_suggest_search', 'get_suggest_search');
add_action('wp_ajax_nopriv_get_suggest_search', 'get_suggest_search');



add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol($currency_symbol, $currency)
{
	switch ($currency) {
		case 'USD':
			$currency_symbol = 'USD';
			break;
		case 'VND':
			$currency_symbol = 'VND';
			break;
	}
	return $currency_symbol;
}


add_filter('woocommerce_get_price_html', 'swap_price_html', 100, 2);
function swap_price_html($price, $product)
{
	// return $product->price;
	if ($product->price > 0) {
		if ($product->price && isset($product->regular_price)) {
			$from = $product->regular_price;
			$to = $product->price;
			if ($from === $to) {
				return '<ins>' . ((is_numeric($to)) ? woocommerce_price($to) : $to) . '</ins><span class="screen-reader-text">' . __("Current price is", 'canhcamtheme') . ': ' . ((is_numeric($from)) ? woocommerce_price($from) : $from) . ' </span>';
			}
			if ($$from !== $to) {
				return '<ins>' . ((is_numeric($to)) ? woocommerce_price($to) : $to) . '</ins><span class="screen-reader-text">' . __("Current price is", 'canhcamtheme') . ': ' . ((is_numeric($from)) ? woocommerce_price($from) : $from) . ' </span>' . ' ' . '<del>' . ((is_numeric($from)) ? woocommerce_price($from) : $from) . ' </del><span class="screen-reader-text">' . __("Original price was", 'canhcamtheme') . ': ' . ((is_numeric($from)) ? woocommerce_price($from) : $from) . ' </span>';
			}
		} else {
			$to = $product->price;
			return '<ins>' . ((is_numeric($to)) ? woocommerce_price($to) : $to) . '</ins><span class="screen-reader-text">' . __("Current price is", 'canhcamtheme') . ': ' . ((is_numeric($to)) ? woocommerce_price($to) : $to) . ' </span>';
		}
	} else {
		return '';
	}
}
