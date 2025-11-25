<?php
function log_dump($data)
{
	// Use the PHP ob_start function to capture the output of the var_dump function
	ob_start();
	var_dump($data);
	$dump = ob_get_clean();

	// Use the PHP highlight_string function to highlight the syntax
	$highlighted = highlight_string("<?php\n" . $dump . "\n?>", true);

	// Remove the PHP tags and wrap the highlighted code in a <pre> tag
	$formatted = '<pre>' . substr($highlighted, 27, -8) . '</pre>';

	// Add custom CSS styles for the .php and .hlt classes
	$custom_css = 'pre {position: static;
		background: #ffffff80;
		// max-height: 50vh;
		width: 100vw;
	}
	pre::-webkit-scrollbar{
	width: 1rem;}';

	// Wrap the custom CSS in a <style> tag
	$formatted_css = '<style>' . $custom_css . '</style>';
	echo ($formatted_css . $formatted);
}

function empty_content($str)
{
	return trim(str_replace('&nbsp;', '', strip_tags($str, '<img>'))) == '';
}

add_filter('wp_nav_menu_items', 'add_custom_li_to_menu', 10, 2);
function add_custom_li_to_menu($items, $args)
{
    if ($args->theme_location == 'header-menu') {
		$items .= '<div class="header-search text-Primary-1"><a href="#"><i class="fa-regular fa-magnifying-glass"></i></a></div>';
	}
	return $items;
}

add_filter('nav_menu_css_class', 'custom_menu_item_active_by_template', 10, 2);
function custom_menu_item_active_by_template($classes, $item) {
    // Ánh xạ post type => page ID
    $post_type_page_map = [
        'service'     => 24,
        'recruitment' => 20,
    ];

    // Lặp qua từng post type trong ánh xạ
    foreach ($post_type_page_map as $post_type => $page_id) {
        if (is_singular($post_type)) {
            // Lấy ID đã dịch nếu dùng WPML
            $translated_id = apply_filters('wpml_object_id', $page_id, 'page', true);

            if ($item->object === 'page' && $item->object_id == $translated_id) {
                $classes[] = 'current-menu-item';
                break; // đã match thì thoát vòng lặp
            }
        }
    }

    return $classes;
}


?>