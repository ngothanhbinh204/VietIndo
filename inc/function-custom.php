<?php
function log_dump($data)
{
	ob_start();
	var_dump($data);
	$dump = ob_get_clean();

	$highlighted = highlight_string("<?php\n" . $dump . "\n?>", true);
$formatted = '
<pre>' . substr($highlighted, 27, -8) . '</pre>';

$custom_css = 'pre {position: static;
background: #ffffff80;
// max-height: 50vh;
width: 100vw;
}
pre::-webkit-scrollbar{
width: 1rem;}';

$formatted_css='<style>
'. $custom_css . '
</style>';
echo ($formatted_css . $formatted);
}

function empty_content($str)
{
return trim(str_replace('&nbsp;', '', strip_tags($str, '<img>'))) == '';
}

// add_filter('wp_nav_menu_items', 'add_custom_li_to_menu', 10, 2);
// function add_custom_li_to_menu($items, $args)
// {
// if ($args->theme_location == 'header-menu') {
// $items .= '<div class="header-search text-Primary-1"><a href="#"><i class="fa-regular fa-magnifying-glass"></i></a>
    // </div>';
// }
// return $items;
// }

add_filter('nav_menu_css_class', 'custom_menu_item_active_by_template', 10, 2);
function custom_menu_item_active_by_template($classes, $item) {
// Ánh xạ post type => page ID
$post_type_page_map = [
'service' => 24,
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

function custom_wpml_language_switcher_markup() {
$languages = icl_get_languages('skip_missing=1');

if (empty($languages)) {
return '';
}

$output = '';
$current_lang_li = '';
$dropdown_list_html = '';
$has_other_languages = count($languages) > 1;

$wrapper_class = 'header-language' . (!$has_other_languages ? ' no-dropdown' : '');

$output .= '<div class="' . $wrapper_class . '">';

    foreach ($languages as $lang) {
    $flag_url = $lang['country_flag_url'];

    if ($lang['active']) {
    $current_lang_li .= '<li class="wpml-ls-current-language">';
        $current_lang_li .= '<a href="' . $lang['url'] . '"' . ($has_other_languages ? '
            class="has-dropdown"' : '') . '>';

            $current_lang_li .= '<div class="flag"><img src="' . esc_url($flag_url) . '"
                    alt="' . esc_attr($lang['translated_name']) . '" /></div>';

            $current_lang_li .= '<span class="wpml-ls-native">' . esc_html(strtoupper($lang['code'])) .
                '</span>';
            $current_lang_li .= '</a>';
        $current_lang_li .= '</li>';
    }

    if (!$lang['active']) {
    $dropdown_list_html .= '<li>';
        $dropdown_list_html .= '<a href="' . $lang['url'] . '">';
            $dropdown_list_html .= '<span>' . esc_html(strtoupper($lang['code'])) . '</span>';
            $dropdown_list_html .= '</a>';
        $dropdown_list_html .= '</li>';
    }
    }

    $output .= '<div class="header-language-active">
        <ul>';
            $output .= $current_lang_li;
            $output .= '</ul>
    </div>';

    if ($has_other_languages) {
    $output .= '<div class="header-language-list">';
        $output .= '<ul>';
            $output .= $dropdown_list_html;
            $output .= '</ul>';
        $output .= '</div>';
    }

    $output .= '</div>';

return $output;
}

add_shortcode('custom_wpml_switcher', 'custom_wpml_language_switcher_markup');
?>