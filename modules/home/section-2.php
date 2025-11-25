<?php

$sub_title = get_sub_field('sub_title');

$title = get_sub_field('title');

$description = get_sub_field('description');

$button = get_sub_field('button');

$statistics = get_sub_field('statistics');

?>

<section class="home-2 section-py bg-Utility-50">

    <div class="container">

        <div class="wrap-heading mx-auto rem:max-w-[1022px] w-full text-center">

            <?php if ($sub_title) : ?>

            <div class="sub-title heading-5 font-bold text-Utility-700 mb-3" data-aos="fade-up" data-aos-delay="200"
                data-aos-duration="1200"><?php echo esc_html($sub_title); ?></div>

            <?php endif; ?>

            <?php if ($title) : ?>

            <h2 class="heading-banner font-black text-Primary-2 mb-base" data-aos="fade-up" data-aos-delay="400"
                data-aos-duration="1200"><?php echo esc_html($title); ?></h2>

            <?php endif; ?>

            <?php if ($description) : ?>

            <div class="format-content body-1 font-normal text-black" data-aos="fade-up" data-aos-delay="600"
                data-aos-duration="1200">

                <?php echo $description; ?>

            </div>

            <?php endif; ?>

            <?php if ($button) : ?>

            <div class="button-more mt-base" data-aos="fade-up" data-aos-delay="800" data-aos-duration="1200"><a
                    class="btn btn-primary" href="<?php echo esc_url($button['url']); ?>"
                    target="<?php echo esc_attr($button['target']); ?>">
                    <span><?php echo esc_html($button['title']); ?></span></a></div>

            <?php endif; ?>

        </div>

        <?php if ($statistics) : ?>

        <div class="wrap-list grid lg:grid-cols-4 grid-cols-2 gap-base xl:mt-20 mt-base" data-aos="fade-up"
            data-aos-delay="1000" data-aos-duration="1200">

            <?php foreach ($statistics as $item) : ?>

            <div class="item">

                <div class="content">

                    <div class="number countup" data-number="<?php echo esc_attr($item['number']); ?>"> <span
                            class="count-value"></span><span
                            class="suffix"><?php echo esc_html($item['suffix']); ?></span></div>

                    <div class="title body-1 font-normal text-black">

                        <p><?php echo esc_html($item['title']); ?></p>

                    </div>

                </div>

            </div>

            <?php endforeach; ?>

        </div>

        <?php endif; ?>

    </div>

</section>