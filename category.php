<?php get_header(); ?>

<?php
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$args = array(
    'post_type' => 'post',
	'post_status' => 'publish',
    'posts_per_page' => 10,
    'paged' => $paged,
	 'orderby' => 'date',   // Sắp xếp theo ngày đăng
    'order' => 'DESC',     // Theo thứ tự mới nhất -> cũ nhất
);

$custom_query = new WP_Query($args);
?>

<section class="news">
    <?php get_template_part('modules/common/banner'); ?>


</section>
<section class="news-1 pt-20">
    <div class="container">

        <?php if ($custom_query->have_posts()): ?>
            <?php $custom_query->the_post(); ?>
            <div class="news-main flex">
                <div class="col-left rem:w-[920px]">
                    <div class="image"> <a class="img-ratio ratio:pt-[613_920] lozad" href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt=""></a></div>
                </div>
                <div class="col-right flex-1 bg-Utility-50 px-10 py-15 flex flex-col justify-center">
                    <div class="date bg-Primary-1 inline-flex text-Neutral-White w-16 h-16 flex-shrink-0 flex-col items-center gap-1 text-center justify-center"><?php echo date('d/m/Y', strtotime(get_the_date('Y-m-d'))); ?></div>
                    <div class="content flex flex-col gap-3 text-Utility-Black">
                        <a href="<?php the_permalink(); ?>"><h3 class="heading-4 font-bold"><?php the_title(); ?></h3></a>
                        <div class="desc"><?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<section class="news-2 py-10">
    <div class="container">
        <div class="news-2-list grid lg:grid-cols-3 gap-base md:grid-cols-2">
            <?php
            $count = 0;
            while ($custom_query->have_posts()):
                $custom_query->the_post();
                $count++;
            ?>
                <div class="item group">
                    <div class="image">
                        <a class="img-ratio ratio:pt-[280_320] lozad zoom-img" href="<?php the_permalink(); ?>">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="">
                        </a>
                    </div>
                    <div class="content pt-6 flex gap-4">
                        <div
                            class="date text-sm bg-Primary-1 inline-flex text-Neutral-White w-16 h-16 flex-shrink-0 flex-col items-center gap-1 text-center justify-center">
                            <div class="day text-2xl font-bold text-Neutral-White"><?php echo date('d', strtotime(get_the_date('Y-m-d'))); ?></div>
                            <div class="month text-sm text-white font-bold"><?php echo date('m/Y', strtotime(get_the_date('Y-m-d'))); ?></div>
                        </div>
                        <div class="content-news flex-1">
                            <h3 class="text-lg font-semibold text-Neutral-950 tracking-[-0.36px] group-hover:text-Primary-1">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="desc text-Neutral-700 tracking-[-0.32px] font-normal"><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="pagination mt-base">
            <?php
            echo paginate_links(array(
                'total' => $custom_query->max_num_pages,
                'current' => max(1, get_query_var('paged')),
                'type' => 'list',
                'prev_text' => __('«'),
                'next_text' => __('»'),
            ));
            ?>
        </div>
    </div>
</section>

<?php
wp_reset_postdata();
get_footer(); ?>