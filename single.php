<?php get_header(); ?>
<section class="news-detail">
    <?php get_template_part('template-parts/section', 'breadcrumb'); ?>
</section>
<section class="news-detail-2 section-py">
    <div class="wrapper rem:w-[1160px] mx-auto">
        <div class="heading pb-5 border-b border-b-Neutral-200 flex gap-5">
            <div
                class="date text-sm bg-Primary-1 inline-flex text-Neutral-White w-16 h-16 flex-shrink-0 flex-col items-center gap-1 text-center justify-center">
                <div class="day text-2xl font-bold text-Neutral-White"><?php echo date('d', strtotime(get_the_date('Y-m-d'))); ?></div>
                <div class="month text-sm text-white font-bold"><?php echo date('m/Y', strtotime(get_the_date('Y-m-d'))); ?></div>
            </div>
            <h2 class="heading-2 text-Primary-2 mb-3 flex-1"><?php the_title(); ?></h2>
        </div>
        <div class="format-content">
            <p><?php the_content(); ?></p>
            <div class="news-detail-2-share flex items-center gap-5"><span class="font-bold text-Neutral-950"><?php echo __('Chia sẻ:', 'canhcamtheme'); ?></span>
                <div class="news-detail-2-social flex items-center gap-3">
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_the_permalink(); ?>"><i class="fa-solid fa-link"></i></a>
                    <a href="https://www.youtube.com/share?url=<?php echo get_the_permalink(); ?>"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
            
        </div>
    </div>
</section>
<section class="news-detail-3 section-py bg-Utility-50">
    <div class="container">
        <h2 class="heading-2 text-Primary-2 text-center mb-base"><?php echo __('Tin tức liên quan', 'canhcamtheme'); ?></h2>
        <div class="news-slide relative">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                    $categories = get_the_category();
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 6,
                        'post__not_in' => array(get_the_ID()),
                        'category__in' => array($categories[0]->term_id),
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="swiper-slide">
                                <div class="item group">
                                    <div class="image"> <a class="img-ratio ratio:pt-[280_320] zoom-img rounded-5" href="<?php echo get_the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt=""></a></div>
                                    <div class="content pt-6 flex flex-col gap-4">
                                        <div class="date bg-Primary-1 inline-flex text-Neutral-White w-16 h-16 flex-shrink-0 flex-col items-center gap-1 text-center justify-center rounded-1"><?php echo date('d/m/Y', strtotime(get_the_date('Y-m-d'))); ?></div>
                                        <h3 class="heading-5 font-semibold text-Utility-Black group-hover:text-Primary-1 mb-3 line-clamp-2"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="desc text-Neutral-700 tracking-[-0.32px] font-normal"><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></div>
                                    </div>
                                </div>
                            </div>
                    <?php endwhile;
                    endif;
                    wp_reset_postdata(); ?>
                   
                </div>
            </div>
            <div class="wrap-button-slide">
                <div class="btn btn-prev btn-sw-1 blue"></div>
                <div class="btn btn-next btn-sw-1 blue"></div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>