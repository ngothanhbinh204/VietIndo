<?php

if (have_rows('home_section', get_the_ID())) {

    while (have_rows('home_section', get_the_ID())) {

        the_row();

        if (get_row_layout() == 'introduction_section') {

            $introduction_background = get_sub_field('introduction_background');

            $introduction_title = get_sub_field('introduction_title');

            $introduction_subtitle = get_sub_field('introduction_subtitle');

            $introduction_description = get_sub_field('introduction_description');

            $introduction_link = get_sub_field('introduction_link');

            $introduction_celebratingimage = get_sub_field('introduction_celebratingimage');

        }

    }

}

?>



<section class="home-2 pt-20 rem:pb-[333px]" setBackground="<?php echo !empty($introduction_background['url']) ? $introduction_background['url'] : '#'; ?>">

    <div class="container">

        <div class="home-2-main flex xl:rem:gap-[224px] md:gap-20 gap-base">

            <div class="col-left xl:rem:w-[840px] md:w-7/12">

                <h4 class="text-xl tracking-[-0.4px] font-bold text-Primary-1 mb-4"><?php echo !empty($introduction_title) ? $introduction_title : ''; ?></h4>

                <h3 class="title-40 !font-normal tracking-[-1.6px] mb-base"><?php echo !empty($introduction_subtitle) ? $introduction_subtitle : ''; ?></h3>

                <div class="format-content text-lg font-normal text-Neutral-950">

                    <?php echo !empty($introduction_description) ? $introduction_description : ''; ?>

                </div>

                <div class="home-2-btn inline-flex mt-base"><a class="button-primary" href="<?php echo !empty($introduction_link['url']) ? $introduction_link['url'] : '#'; ?>"> <span><?php echo !empty($introduction_link['title']) ? $introduction_link['title'] : ''; ?></span></a>

                </div>

            </div>

            <div class="col-right xl:w-[calc(100%-43.75rem-11.666666666666668rem)] md:w-5/12">

                <div class="image"> <a class="img-ratio ratio:pt-[350_336] lozad" href="#"><img class="lozad undefined" data-src="<?php echo !empty($introduction_celebratingimage['url']) ? $introduction_celebratingimage['url'] : ''; ?>" alt="<?php echo !empty($introduction_celebratingimage['alt']) ? $introduction_celebratingimage['alt'] : ''; ?>" /></a></div>

            </div>

        </div>

    </div>

</section>