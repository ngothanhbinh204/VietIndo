<?php
/*
 Template Name: Page - Project List
 */
get_header();
$banner_image = get_field('banner_image');
$banner_title = get_field('banner_title');
$banner_desc = get_field('banner_description');
$featured_project = get_field('featured_project');

// Get all project categories
$terms = get_terms(array(
    'taxonomy' => 'project_category',
    'hide_empty' => false,
));

// Pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'project',
    'posts_per_page' => 3,
    'paged' => $paged,
    'post_status' => 'publish'
);

// Exclude featured project from main list if selected
if ($featured_project) {
    $args['post__not_in'] = array($featured_project->ID);
}

$project_query = new WP_Query($args);
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
            <h1 class="heading-banner font-black mb-6"><?php echo esc_html($banner_title ? $banner_title : 'Dự án'); ?>
            </h1>
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
                <li><a href="<?php echo get_permalink(); ?>" class="active">Tất cả</a></li>
                <?php foreach ($terms as $term) : ?>
                <li><a href="<?php echo get_term_link($term); ?>"><?php echo esc_html($term->name); ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </section>

    <section class="project-2 section-py">
        <div class="container">
            <?php if ($featured_project) : 
                    $f_id = $featured_project->ID;
                    $f_sub_title = get_field('sub_title', $f_id);
                    $f_info_list = get_field('project_info_list', $f_id);
                    $f_terms = get_the_terms($f_id, 'project_category');
                    $f_cat_name = ($f_terms && !is_wp_error($f_terms)) ? $f_terms[0]->name : '';
                ?>
            <div class="project-2-main">
                <div class="col-left">
                    <div class="box">
                        <div class="box-top">
                            <?php if ($f_cat_name) : ?>
                            <div class="sub-title heading-5 font-bold text-Utility-700 mb-3">
                                <?php echo esc_html($f_cat_name); ?></div>
                            <?php endif; ?>
                            <h2 class="heading-4 font-bold text-Primary-2 mb-7"><?php echo get_the_title($f_id); ?></h2>
                        </div>
                        <?php if ($f_info_list) : ?>
                        <div class="box-bottom flex flex-col gap-4 mb-7">
                            <?php foreach ($f_info_list as $item) : ?>
                            <div class="item">
                                <div class="icon">
                                    <i class="<?php echo esc_attr($item['icon_class']); ?>"></i>
                                </div>
                                <div class="info">
                                    <div class="sub-title"><?php echo esc_html($item['sub_title']); ?></div>
                                    <div class="title font-bold"><?php echo esc_html($item['title']); ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <div class="button-more"> <a class="btn btn-primary" href="<?php echo get_permalink($f_id); ?>">
                                <span>Xem thêm</span></a></div>
                    </div>
                </div>
                <div class="col-right">
                    <div class="img img-ratio ratio:pt-[480_920] h-full zoom-img">
                        <a href="<?php echo get_permalink($f_id); ?>">
                            <?php echo get_image_post($f_id); ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="project-2-list grid lg:grid-cols-3 grid-cols-1 gap-base mt-base">
                <?php if ($project_query->have_posts()) : ?>
                <?php while ($project_query->have_posts()) : $project_query->the_post(); 
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
                <?php endif; ?>
            </div>

            <div class="pagination mt-base">
                <?php
                    echo paginate_links(array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $project_query->max_num_pages,
                        'type' => 'list',
                        'prev_text' => '<i class="fa-solid fa-chevron-left"></i>',
                        'next_text' => '<i class="fa-solid fa-chevron-right"></i>',
                    ));
                    ?>
            </div>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>