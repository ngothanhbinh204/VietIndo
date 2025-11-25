<?php

/*

 Template Name: Page - Services

 */

?>

<?php get_header(); ?>

<section class="service-1">

    <?php get_template_part('modules/common/banner'); ?>

</section>



<section class="service-2 section-py">

    <div class="container">

        <div class="heading mb-base">

            <h4 class="text-xl font-bold text-Primary-1 tracking-[-0.4px] mb-4"><?php echo __('DỊCH VỤ', 'canhcamtheme'); ?></h4>

            <h3 class="title-40 !font-normal "><?php echo __('Giải pháp thép chất lượng cho mọi công trình', 'canhcamtheme'); ?></h3>

        </div>

        <div class="service-2-list grid grid-cols-2 md:gap-base gap-3">



            <?php

            $args = array(

                'post_type' => 'service',

                'orderby' => 'date',

                'order' => 'DESC',

            );

            $query = new WP_Query($args);

            if ($query->have_posts()): while ($query->have_posts()): $query->the_post();

            ?>

                    <div class="service-item group">

                        <div class="image"> <a class="img-ratio ratio:pt-[382_680] zoom-img" href="<?php the_permalink(); ?>"><img class="lozad undefined" data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>" /></a></div>

                        <div class="content md:mt-6 mt-3">

                            <h3 class="text-xl font-bold text-Neutral-950 md:mb-3 mb-1 leading-[1.3] group-hover:text-Primary-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                            <div class="desc text-lg font-normal text-Neutral-500-main text-ellipsis line-clamp-2"><?php echo get_the_excerpt(); ?></div>

                        </div>

                    </div>

            <?php endwhile;

            endif;

            wp_reset_postdata(); ?>





        </div>

    </div>

</section>



<?php get_footer(); ?>