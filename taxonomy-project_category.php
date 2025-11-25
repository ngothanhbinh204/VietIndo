<?php
get_header();

// Get current term
$current_term = get_queried_object();
$banner_title = single_term_title('', false);
$banner_desc = term_description();
$banner_image = get_field('banner_image', 270);
// Get all project categories
$terms = get_terms(array(
    'taxonomy' => 'project_category',
    'hide_empty' => false,
));

// Get link to "All Projects" page
$all_projects_link = get_page_link_by_template('templates/project-list.php');
if (!$all_projects_link) {
    $all_projects_link = get_post_type_archive_link('project');
}

?>

<div data-scroll-container>
    <div class="project-page banner">
        <a class="img-ratio ratio:pt-[812_1920]" href="#">
            <?php if ($banner_image) : ?>
            <?php echo get_image_attrachment($banner_image); ?>
            <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/img/1.jpg" alt="">
            <?php endif; ?>
        </a>
        <div class="global-breadcrumb">
            <div class="container">
                <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
            </div>
        </div>
        <div class="banner-content">
            <h1 class="heading-banner font-black mb-6"><?php echo esc_html($banner_title); ?></h1>
            <?php if ($banner_desc) : ?>
            <div class="desc body-1 font-normal">
                <p><?php echo nl2br(esc_html($banner_desc)); ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <section class="project-1">
        <div class="container">
            <?php if ($terms && !is_wp_error($terms)) : ?>
            <ul class="project-nav">
                <li><a href="<?php echo esc_url($all_projects_link); ?>">Tất cả</a></li>
                <?php foreach ($terms as $term) : 
                        $active_class = ($term->term_id == $current_term->term_id) ? 'class="active"' : '';
                    ?>
                <li><a href="<?php echo get_term_link($term); ?>"
                        <?php echo $active_class; ?>><?php echo esc_html($term->name); ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </section>

    <section class="project-2 section-py">
        <div class="container">
            <div class="project-2-list grid lg:grid-cols-3 grid-cols-1 gap-base mt-base">
                <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); 
                        $p_id = get_the_ID();
                        $p_terms = get_the_terms($p_id, 'project_category');
                        $p_cat_name = ($p_terms && !is_wp_error($p_terms)) ? $p_terms[0]->name : '';
                        $p_info_list = get_field('project_info_list', $p_id);
                    ?>
                <div class="project-item rounded-5 overflow-hidden">
                    <div class="img">
                        <a class="img-ratio ratio:pt-[247_440]" href="<?php the_permalink(); ?>">
                            <?php echo get_image_post($p_id); ?>
                        </a>
                    </div>
                    <div class="content p-4 bg-Utility-50">
                        <div class="content-top">
                            <?php if ($p_cat_name) : ?>
                            <div class="category body-5 text-Utility-700 font-bold mb-1">
                                <?php echo esc_html($p_cat_name); ?></div>
                            <?php endif; ?>
                            <h3 class="heading-4 font-bold text-black"><a
                                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div>
                        <?php if ($p_info_list) : ?>
                        <div class="content-bottom mt-4">
                            <?php 
                                        // Limit to 2 items for grid view
                                        $count = 0;
                                        foreach ($p_info_list as $item) : 
                                            if ($count >= 2) break;
                                        ?>
                            <div class="item">
                                <div class="icon">
                                    <i class="<?php echo esc_attr($item['icon_class']); ?>"></i>
                                </div>
                                <div class="title"><?php echo esc_html($item['title']); ?></div>
                            </div>
                            <?php 
                                            $count++;
                                        endforeach; 
                                        ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php else: ?>
                <p><?php _e('Chưa có dự án nào trong danh mục này.', 'canhcamtheme'); ?></p>
                <?php endif; ?>
            </div>

            <div class="pagination mt-base">
                <?php
                echo paginate_links(array(
                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages,
                    'type' => 'list',
                    'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
                    'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
                ));
                ?>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>