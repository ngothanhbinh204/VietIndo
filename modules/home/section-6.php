<?php
if (have_rows('home_section', get_the_ID())) {
    while (have_rows('home_section', get_the_ID())) {
        the_row();
        if (get_row_layout() == 'news_section') {
            $news_title = get_sub_field('news_title');
            $news_subtitle = get_sub_field('news_subtitle');
            $new_linkseeall = get_sub_field('new_linkseeall');
            $news_listposts = get_sub_field('news_listposts');
            $news_listposts2 = get_sub_field('news_listposts2');
        }
    }
}
?>
<section class="home-6 section-py">
    <div class="container">
        <div class="home-6-top flex flex-col md:flex-row items-start md:items-center justify-between gap-base mb-base">
            <div class="left">
                <h4 class="text-xl font-bold text-Primary-1 tracking-[-0.4px] mb-4"><?php echo !empty($news_title) ? $news_title : __('TIN TỨC', 'canhcamtheme'); ?></h4>
                <h3 class="title-40 !font-normal"><?php echo !empty($news_subtitle) ? $news_subtitle : ''; ?></h3>
            </div>
            <div class="right">
                <div class="home--5-btn"><a class="button-primary" href="<?php echo !empty($new_linkseeall) ? $new_linkseeall['url'] : '#'; ?>"> <span><?php echo __('Xem tất cả', 'canhcamtheme'); ?></span></a>
                </div>
            </div>
        </div>
        <div class="home-6-main flex flex-col md:flex-row gap-base">
            <?php if (!empty($news_listposts)): ?>
                <?php foreach ($news_listposts as $item): ?>
                    <?php $post = get_post($item->ID); ?>
                    <div class="col-left md:w-6/12 w-full">
                        <div class="item group">
                            <div class="image"> <a class="img-ratio ratio:pt-[280_680] lozad zoom-img" href="<?php echo get_permalink($post->ID); ?>"><img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="<?php echo $post->post_name; ?>"></a></div>
                            <div class="content pt-6 flex flex-col gap-4">
                                <div class="date"><?php echo date('d.m.Y', strtotime($post->post_date)); ?></div>
                                <h3 class="text-2xl font-bold text-Neutral-950 tracking-[-0.48px] group-hover:text-Primary-1"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h3>
                                <div class="desc text-Neutral-700 tracking-[-0.32px] font-normal"><?php echo get_the_excerpt($post->ID); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="col-right md:w-6/12 w-full flex gap-base">

                <?php if (!empty($news_listposts2)): ?>
                    <?php
                    $first_post = $news_listposts2[0] ?? null;
                    $second_post = $news_listposts2[1] ?? null;
                    ?>

                    <?php if ($first_post): ?>
                        <?php $post = get_post($first_post->ID); ?>
                        <div class="col-left w-2/4">
                            <div class="item group">
                                <div class="image">
                                    <a class="img-ratio ratio:pt-[280_320] lozad zoom-img" href="<?php echo get_permalink($post->ID); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="<?php echo $post->post_name; ?>">
                                    </a>
                                </div>
                                <div class="content pt-6 flex flex-col gap-4">
                                    <div class="date"><?php echo date('d.m.Y', strtotime($post->post_date)); ?></div>
                                    <h3 class="text-lg font-semibold text-Neutral-950 tracking-[-0.36px] group-hover:text-Primary-1">
                                        <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                                    </h3>
                                    <div class="desc text-Neutral-700 tracking-[-0.32px] font-normal">
                                        <?php echo get_the_excerpt($post->ID); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($second_post): ?>
                        <?php $post = get_post($second_post->ID); ?>
                        <div class="col-right w-2/4 flex flex-col gap-4">
                            <div class="item group">
                                <div class="image">
                                    <a class="img-ratio ratio:pt-[280_320] lozad zoom-img" href="<?php echo get_permalink($post->ID); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="<?php echo $post->post_name; ?>">
                                    </a>
                                </div>
                                <div class="content pt-6 flex flex-col gap-4">
                                    <div class="date"><?php echo date('d.m.Y', strtotime($post->post_date)); ?></div>
                                    <h3 class="text-lg font-semibold text-Neutral-950 tracking-[-0.36px] group-hover:text-Primary-1">
                                        <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a>
                                    </h3>
                                    <div class="desc text-Neutral-700 tracking-[-0.32px] font-normal">
                                        <?php echo get_the_excerpt($post->ID); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>


            </div>
        </div>
    </div>
</section>