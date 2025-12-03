<?php
// Custom field class for page
function add_field_custom_class_body()
{
	acf_add_local_field_group(array(
		'key' => 'class_body',
		'title' => 'Body: Add Class',
		'fields' => array(),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
	));
	acf_add_local_field(array(
		'key' => 'add_class_body',
		'label' => 'Add class body',
		'name' => 'Add class body',
		'type' => 'text',
		'parent' => 'class_body',
	));
}
add_action('acf/init', 'add_field_custom_class_body');

//

function add_field_select_banner()
{
	acf_add_local_field_group(array(
		'key' => 'select_banner',
		'title' => 'Banner: Select Page',
		'fields' => array(),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
			array(
				array(
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'category',
				),
			),
            array(
                array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'product_cat',
                ),
            ),
			// Thêm taxonomy ở dưới
			// array(
			// 	array(
			// 		'param' => 'taxonomy',
			// 		'operator' => '==',
			// 		'value' => 'danh-muc-san-pham'
			// 	)
			// )
		),
	));
	acf_add_local_field(array(
		'key' => 'banner_select_page',
		'label' => 'Chọn banner hiển thị',
		'name' => 'Chọn banner hiển thị',
		'type' => 'post_object',
		'post_type' => 'banner',
		'multiple' => 1,
		'parent' => 'select_banner',
	));
}
add_action('acf/init', 'add_field_select_banner');

function add_theme_config_options()
{
	// Add the field group
	acf_add_local_field_group(array(
		'key' => 'group_theme_config',
		'title' => 'Theme Configuration',
		'fields' => array(
			array(
				'key' => 'tab_config',
				'label' => 'Config',
				'name' => 'tab_config',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_config_head',
				'label' => 'Config Head',
				'name' => 'config_head',
				'type' => 'textarea',
				'instructions' => 'Add custom code for header (CSS, meta tags, etc)',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 4,
				'new_lines' => '',
			),
			array(
				'key' => 'field_config_body',
				'label' => 'Config Body',
				'name' => 'config_body',
				'type' => 'textarea',
				'instructions' => 'Add custom code for body (JS, tracking code, etc)',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 4,
				'new_lines' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	));
}
add_action('acf/init', 'add_theme_config_options');




// Register Custom Post Type for Recruitment
function create_recruitment_post_type() {
    $labels = array(
        'name'                  => _x('Tuyển dụng', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Tuyển dụng', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Tuyển dụng', 'text_domain'),
        'name_admin_bar'        => __('Tuyển dụng', 'text_domain'),
        'archives'              => __('Recruitment Archives', 'text_domain'),
        'attributes'            => __('Recruitment Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Recruitment:', 'text_domain'),
        'all_items'             => __('All Recruitments', 'text_domain'),
        'add_new_item'          => __('Add New Recruitment', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Recruitment', 'text_domain'),
        'edit_item'             => __('Edit Recruitment', 'text_domain'),
        'update_item'           => __('Update Recruitment', 'text_domain'),
        'view_item'             => __('View Recruitment', 'text_domain'),
        'view_items'            => __('View Recruitments', 'text_domain'),
        'search_items'          => __('Search Recruitment', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
    );

    $args = array(
        'label'                 => __('Recruitment', 'text_domain'),
        'description'           => __('Post Type for Recruitment', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'              => true,
        'show_in_menu'         => true,
        'menu_position'         => 20,
		'menu_icon'            => 'dashicons-buddicons-buddypress-logo',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );

    register_post_type('recruitment', $args);
}

// Hook into the 'init' action
add_action('init', 'create_recruitment_post_type');


// Register Custom Taxonomy for Recruitment
function create_recruitment_taxonomy() {
    $labels = array(
        'name'              => _x('Categories', 'taxonomy general name', 'text_domain'),
        'singular_name'     => _x('Category', 'taxonomy singular name', 'text_domain'),
        'search_items'      => __('Search Recruitment Categories', 'text_domain'),
        'all_items'         => __('All Recruitment Categories', 'text_domain'),
        'parent_item'       => __('Parent Recruitment Category', 'text_domain'),
        'parent_item_colon' => __('Parent Recruitment Category:', 'text_domain'),
        'edit_item'         => __('Edit Recruitment Category', 'text_domain'),
        'update_item'       => __('Update Recruitment Category', 'text_domain'),
        'add_new_item'      => __('Add New Recruitment Category', 'text_domain'),
        'new_item_name'     => __('New Recruitment Category Name', 'text_domain'),
        'menu_name'         => __('Category', 'text_domain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'          => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'recruitment-category'),
    );

    register_taxonomy('recruitment_category', array('recruitment'), $args);
}

// Hook into the 'init' action
add_action('init', 'create_recruitment_taxonomy');




// Register Custom Post Type for Project
function create_project_post_type() {
    $labels = array(
        'name'                  => _x('Dự án', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Dự án', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Dự án', 'text_domain'),
        'name_admin_bar'        => __('Dự án', 'text_domain'),
        'archives'              => __('Project Archives', 'text_domain'),
        'attributes'            => __('Project Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Project:', 'text_domain'),
        'all_items'             => __('All Projects', 'text_domain'),
        'add_new_item'          => __('Add New Project', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Project', 'text_domain'),
        'edit_item'             => __('Edit Project', 'text_domain'),
        'update_item'           => __('Update Project', 'text_domain'),
        'view_item'             => __('View Project', 'text_domain'),
        'view_items'            => __('View Projects', 'text_domain'),
        'search_items'          => __('Search Project', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
    );

    $args = array(
        'label'                 => __('Project', 'text_domain'),
        'description'           => __('Post Type for Project', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'              => true,
        'show_in_menu'         => true,
        'menu_position'         => 20,
		'menu_icon'            => 'dashicons-building',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );

    register_post_type('project', $args);
}

// Hook into the 'init' action
add_action('init', 'create_project_post_type');


// Register Custom Taxonomy for Project
function create_project_taxonomy() {
    $labels = array(
        'name'              => _x('Categories', 'taxonomy general name', 'text_domain'),
        'singular_name'     => _x('Category', 'taxonomy singular name', 'text_domain'),
        'search_items'      => __('Search Project Categories', 'text_domain'),
        'all_items'         => __('All Project Categories', 'text_domain'),
        'parent_item'       => __('Parent Project Category', 'text_domain'),
        'parent_item_colon' => __('Parent Project Category:', 'text_domain'),
        'edit_item'         => __('Edit Project Category', 'text_domain'),
        'update_item'       => __('Update Project Category', 'text_domain'),
        'add_new_item'      => __('Add New Project Category', 'text_domain'),
        'new_item_name'     => __('New Project Category Name', 'text_domain'),
        'menu_name'         => __('Category', 'text_domain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'          => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'project-category'),
    );

    register_taxonomy('project_category', array('project'), $args);
}

// Hook into the 'init' action
add_action('init', 'create_project_taxonomy');