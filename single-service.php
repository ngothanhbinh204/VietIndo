<?php
global $post;
$shortcontent = get_field('shortcontent', $post->ID);

get_header();
?>
<?php get_template_part('template-parts/section', 'breadcrumb'); ?>


<section class="service-detail pt-5 xl:pb-20 pb-10">
    <div class="container">
        <div class="service-detail-main flex flex-col-reverse md:flex-row gap-5">
            <div class="col-left md:w-2/4 w-full flex flex-col items-center">
                <div class="content bg-Primary-4 px-10 py-10 md:py-0 flex flex-col flex-1 justify-center">
                    <h3 class="title-40 !font-normal mb-4"><?php the_title(); ?></h3>
                    <div class="format-content">
                        <div><?php echo !(empty($shortcontent)) ? $shortcontent : ''; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-right md:w-2/4 w-full">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="image"> <a class="img-ratio ratio:pt-[459_690]" href="#"><img class="lozad undefined" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>" /></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-service lg:rem:mt-[69px] mt-10">
            <div class="format-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/contact-service'); ?>

<section class="service-detail-2 section-py">
    <div class="container">
        <h2 class="title-40 !font-normal text-center mb-base"><?php echo __('Dịch vụ khác', 'canhcamtheme'); ?></h2>
        <div class="service-detail-2-slide relative">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                    $args = array(
                        'post_type' => 'service',
                        'orderby' => 'date',
                        'posts_per_page' => 4,
                        'post__not_in' => array(get_the_ID()),
                        'order' => 'DESC',
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()): while ($query->have_posts()): $query->the_post();
                    ?>
                            <div class="swiper-slide">
                                <div class="service-item group">
                                    <div class="image"> <a class="img-ratio ratio:pt-[382_680] zoom-img" href="<?php the_permalink(); ?>"><img class="lozad undefined" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>" /></a></div>
                                    <div class="content md:mt-6 mt-3">
                                        <h3 class="text-xl font-bold text-Neutral-950 md:mb-3 mb-1 leading-[1.3] group-hover:text-Primary-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="desc text-lg font-normal text-Neutral-500-main text-ellipsis line-clamp-2"><?php echo the_excerpt(); ?></div>
                                    </div>
                                </div>
                            </div>
                    <?php endwhile;
                    endif;
                    wp_reset_postdata(); ?>

                </div>
            </div>
            <div class="wrap-button-slide xl:block hidden">
                <div class="btn btn-prev btn-sw-1"></div>
                <div class="btn btn-next btn-sw-1"></div>
            </div>
            <div class="wrap-button-slide-mobile xl:hidden flex items-center justify-center gap-3 mt-base">
                <div class="btn btn-prev btn-sw-1"></div>
                <div class="btn btn-next btn-sw-1"></div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>