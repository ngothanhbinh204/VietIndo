<?php
get_header();

$current_id = get_the_ID();
$sub_title = get_field('sub_title');
$gallery = get_field('project_gallery');
$info_list = get_field('project_info_list');

// Get related projects (same category)
$terms = get_the_terms($current_id, 'project_category');
$related_args = array(
    'post_type' => 'project',
    'posts_per_page' => 6,
    'post_status' => 'publish',
    'post__not_in' => array($current_id)
);

if ($terms && !is_wp_error($terms)) {
    $term_ids = wp_list_pluck($terms, 'term_id');
    $related_args['tax_query'] = array(
        array(
            'taxonomy' => 'project_category',
            'field' => 'term_id',
            'terms' => $term_ids,
        ),
    );
}

$related_query = new WP_Query($related_args);
?>

<div data-scroll-container>
    <main>
        <div class="global-breadcrumb">
            <div class="container">
                <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
            </div>
        </div>
        <section class="project-detail section-py">
            <div class="container">
                <div class="heading mb-6">
                    <?php if ($sub_title) : ?>
                    <div class="sub-title heading-5 font-bold text-Utility-700 mb-4"><?php echo esc_html($sub_title); ?>
                    </div>
                    <?php endif; ?>
                    <h2 class="heading-2 font-bold text-Primary-2"><?php the_title(); ?></h2>
                </div>

                <?php if ($gallery) : ?>
                <div class="slide-project">
                    <div class="project-slide-main mb-6 relative">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($gallery as $image) : ?>
                                <div class="swiper-slide">
                                    <div class="image">
                                        <a class="img img-ratio ratio:pt-[786_1400] rounded-5" data-fancybox="gallery"
                                            href="<?php echo esc_url($image['url']); ?>">
                                            <?php echo get_image_attrachment($image); ?>
                                        </a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="project-slide-thumbs relative flex items-center w-full justify-center">
                        <div class="project-slide-thumbs-wrapper w-full flex items-center md:gap-6 gap-3">
                            <div class="btn btn-sw-1 btn-prev blue"></div>
                            <div class="swiper w-full h-full">
                                <div class="swiper-wrapper">
                                    <?php foreach ($gallery as $image) : ?>
                                    <div class="swiper-slide">
                                        <div class="img img-ratio ratio:pt-[127_192] img-full h-full rounded-5">
                                            <?php echo get_image_attrachment($image); ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="btn btn-sw-1 btn-next blue"></div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="wrapper-project grid grid-cols-12 gap-base mt-base">
                    <div class="col-left lg:col-span-8 col-span-full">
                        <div class="format-content body-1">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="col-right lg:col-span-4 col-span-full">
                        <div class="box xl:p-10 p-5 bg-Primary-1 rounded-5 text-white">
                            <h3 class="heading-4 font-bold mb-8">Tổng quan dự án</h3>
                            <?php if ($info_list) : ?>
                            <div class="info-list flex flex-col gap-5">
                                <?php foreach ($info_list as $item) : ?>
                                <div class="item">
                                    <div class="sub-title"><?php echo esc_html($item['sub_title']); ?></div>
                                    <div class="title font-bold"><?php echo esc_html($item['title']); ?></div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php if ($related_query->have_posts()) : ?>
        <section class="project-detail-related section-py bg-Utility-50">
            <div class="container">
                <h2 class="heading-2 font-bold text-Primary-2 text-center mb-base">Dự án liên quan</h2>
                <div class="swiper-column-auto relative autoplay swiper-loop">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php while ($related_query->have_posts()) : $related_query->the_post(); 
                                    $r_id = get_the_ID();
                                    $r_terms = get_the_terms($r_id, 'project_category');
                                    $r_cat_name = ($r_terms && !is_wp_error($r_terms)) ? $r_terms[0]->name : '';
                                    $r_info_list = get_field('project_info_list', $r_id);
                                ?>
                            <div class="swiper-slide">
                                <div class="project-item rounded-5 overflow-hidden">
                                    <div class="img">
                                        <a class="img-ratio ratio:pt-[247_440]" href="<?php the_permalink(); ?>">
                                            <?php echo get_image_post($r_id); ?>
                                        </a>
                                    </div>
                                    <div class="content p-4 bg-Utility-50">
                                        <div class="content-top">
                                            <?php if ($r_cat_name) : ?>
                                            <div class="category body-5 text-Utility-700 font-bold mb-1">
                                                <?php echo esc_html($r_cat_name); ?></div>
                                            <?php endif; ?>
                                            <h3 class="heading-4 font-bold text-black"><a
                                                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        </div>
                                        <?php if ($r_info_list) : ?>
                                        <div class="content-bottom mt-4">
                                            <?php 
                                                        $count = 0;
                                                        foreach ($r_info_list as $item) : 
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
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; wp_reset_postdata(); ?>
    </main>
</div>

<?php get_footer(); ?>