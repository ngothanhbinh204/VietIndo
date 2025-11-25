<?php
$sub_title = get_sub_field('sub_title');
$title = get_sub_field('title');
$products_list = get_sub_field('products_list');
$button = get_sub_field('button');
?>
<section class="home-4 section-py bg-Utility-50">
    <div class="container-fluid">
        <div class="heading xl:rem:mb-[57px] mb-base">
            <?php if ($sub_title) : ?>
            <div class="sub-title heading-5 font-bold text-Utility-700 mb-3" data-aos="fade-right" data-aos-delay="200"
                data-aos-duration="1200"><?php echo esc_html($sub_title); ?></div>
            <?php endif; ?>
            <?php if ($title) : ?>
            <h2 class="heading-banner font-black text-Utility-900" data-aos="fade-right" data-aos-delay="400"
                data-aos-duration="1200"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
        </div>
        <div class="wrapper grid xl:grid-cols-[34.8%_1fr] grid-cols-1 xl:rem:gap-[279px] gap-base">
            <div class="col-left">
                <div class="wrapper flex flex-col gap-8" data-aos="fade-right" data-aos-delay="600"
                    data-aos-duration="1200">
                    <?php if ($products_list) : ?>
                    <?php foreach ($products_list as $item) : ?>
                    <div class="item p-3 rounded-full flex items-center gap-5">
                        <div class="img rem:w-[140px]"><a class="img-ratio rounded-full"
                                href="<?php echo esc_url($item['link']['url'] ?? '#'); ?>">
                                <?php echo get_image_attrachment($item['image_icon']); ?>
                            </a></div>
                        <div class="content flex-1">
                            <div class="content-top">
                                <h3 class="heading-3 font-semibold text-Utility-900 rem:mb-[3px]"><a
                                        href="<?php echo esc_url($item['link']['url'] ?? '#'); ?>"><?php echo esc_html($item['title']); ?></a>
                                </h3>
                                <div class="parameter body-1 font-normal"><?php echo esc_html($item['parameter']); ?>
                                </div>
                            </div>
                            <div class="content-bottom">
                                <div class="button-more"><a class="btn btn-secondary"
                                        href="<?php echo esc_url($item['link']['url'] ?? '#'); ?>"> <span>Xem chi
                                            tiết</span>
                                        <div class="icon"> <i class="fa-solid fa-chevron-right"></i></div>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php if ($button) : ?>
                <div class="button-more xl:mt-25 mt-base"><a class="btn btn-primary"
                        href="<?php echo esc_url($button['url']); ?>"
                        target="<?php echo esc_attr($button['target']); ?>">
                        <span><?php echo esc_html($button['title']); ?></span></a></div>
                <?php endif; ?>
            </div>
            <div class="col-right" data-aos="fade-left" data-aos-delay="800" data-aos-duration="1200">
                <?php if ($products_list) : ?>
                <?php foreach ($products_list as $item) : ?>
                <div class="img img-ratio ratio:pt-[602_881] rem:rounded-[40px]">
                    <?php echo get_image_attrachment($item['image_large']); ?>
                    <div class="content-img">
                        <?php if (!empty($item['features'])) : ?>
                        <?php foreach ($item['features'] as $feature) : ?>
                        <div class="item">
                            <h3><?php echo esc_html($feature['title']); ?></h3>
                            <div class="sub-title"><?php echo esc_html($feature['sub_title']); ?></div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="img-small  rem:w-[240px]">
                        <div class="image img-ratio rem:rounded-[40px]">
                            <?php echo get_image_attrachment($item['image_small']); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>