<?php
/*
 Template Name: Page - About us
 */
$overview = get_field('overview');
$vision_mission = get_field('vision_mission');
$valuecore = get_field('valuecore');
$history_bussiness = get_field('history_bussiness');
$rewards = get_field('rewards');

?>
<?php get_header(); ?>


<section class="about-1">
    <?php get_template_part('modules/common/banner'); ?>
</section>

<?php if (!empty($overview)) : ?>
    <section class="about-2 lg:pt-20 pt-10 rem:pb-[407px]" setBackground="<?php echo !empty($overview['overview_image']['url']) ? $overview['overview_image']['url'] : ''; ?>">
        <div class="container">
            <div class="about-2-content">
                <h4 class="heading-5 text-Utility-700 mb-4"><?php echo !empty($overview['overview_title']) ? $overview['overview_title'] : ''; ?></h4>
                <h3 class="heading-2 mb-base text-Primary-2"><?php echo !empty($overview['overview_subtitle']) ? $overview['overview_subtitle'] : ''; ?></h3>
                <div class="format-content body-1 font-normal">
                    <?php echo !empty($overview['overview_content']) ? $overview['overview_content'] : ''; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($vision_mission)) : ?>
    <section class="about-3 section-py">
        <div class="container">
            <div class="about-3-main flex flex-col md:flex-row lg:gap-20 gap-10 items-center">
                <div class="col-left lg:rem:w-[720px] md:w-7/12 w-full">
                    <h4 class="heading-5 font-bold text-Utility-700 mb-4"><?php echo !empty($vision_mission['vision_title']) ? $vision_mission['vision_title'] : ''; ?></h4>
                    <h3 class="heading-2 mb-base text-Primary-2">
                        <div><?php echo !empty($vision_mission['vision_content']) ? $vision_mission['vision_content'] : ''; ?></div>
                    </h3>
                </div>
                <div class="col-right lg:w-[calc(100%-37.5rem-4.16667rem)] md:w-5/12 w-full">
                    <div class="image"> <a class="img-ratio ratio:pt-[573_600] lozad" href="#"><img src="<?php echo !empty($vision_mission['vision_image']['url']) ? $vision_mission['vision_image']['url'] : ''; ?>" alt=""></a></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($vision_mission)) : ?>
    <section class="about-4 bg-Primary-1 relative overflow-hidden">
        <div class="about-4-main flex flex-col-reverse md:flex-row gap-12 items-center lg:rem:pr-[260px] pr-4">
            <div class="col-left md:w-[calc(100%-31.25rem-2.5rem)] relative left-0  w-full">
                <div class="image"> <a class="ratio-contain ratio:pt-[840_1193px]" href="#"><img src="<?php echo !empty($vision_mission['mission_image']['url']) ? $vision_mission['mission_image']['url'] : ''; ?>" alt=""></a></div>
            </div>
            <div class="col-right md:rem:w-[600px]  w-full">
                <div class="wrapper flex justify-end">
                    <div class="about-4-content pt-10 md:pt-0 text-white">
                        <h4 class="heading-5 font-bold mb-4"><?php echo !empty($vision_mission['mission_title']) ? $vision_mission['mission_title'] : ''; ?></h4>
                        <div class="format-content title-40 !text-Neutral-White !font-normal">
                            <div><?php echo !empty($vision_mission['mission_content']) ? $vision_mission['mission_content'] : ''; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($valuecore)) : ?>
    <section class="about-5 section-py">
        <div class="container">
            <div class="about-5-main flex flex-col lg:flex-row lg:gap-16 gap-10">
                <div class="col-left lg:rem:w-[320px] w-full">
                    <h4 class="heading-5 text-Utility-700 mb-4"><?php echo !empty($valuecore['vc_title']) ? $valuecore['vc_title'] : ''; ?></h4>
                    <h2 class="heading-2 text-Primary-2">
                        <div><?php echo !empty($valuecore['vc_subtitle']) ? $valuecore['vc_subtitle'] : ''; ?></div>
                    </h2>
                </div>
                <div class="col-right lg:w-[calc(100%-16.666666666666668rem-3.33333rem)] w-full">
                    <div class="about-5-list grid md:grid-cols-3 grid-cols-2 gap-8">
                        <?php if (!empty($valuecore['vc_listvalue'])) : ?>
                            <?php foreach ($valuecore['vc_listvalue'] as $item) : ?>
                                <div class="item">
                                    <div class="top">
                                        <h3 class="text-xl font-bold mb-3"><?php echo !empty($item['valuename']) ? $item['valuename'] : ''; ?></h3>
                                        <div class="desc text-Utility-700 font-normal"><?php echo !empty($item['valuecontent']) ? $item['valuecontent'] : ''; ?></div>
                                    </div>
                                    <div class="bottom">
                                        <div class="icon"> <a href="#"><?php echo !empty($item['valueicon']) ? $item['valueicon'] : ''; ?></a></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php if (!empty($history_bussiness)) : ?>
    <section class="about-6 section-py bg-Utility-50">
        <div class="container">
            <div class="heading mb-16">
                <h4 class="heading-5 text-Utility-700 mb-4"><?php echo !empty($history_bussiness['hb_title']) ? $history_bussiness['hb_title'] : ''; ?></h4>
                <h3 class="heading-2 text-Primary-2"><?php echo !empty($history_bussiness['hb_subtilte']) ? $history_bussiness['hb_subtilte'] : ''; ?></h3>
            </div>
            <div class="wrap-slide-years">
                <div class="relative">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php if (!empty($history_bussiness['hs_listyears'])) : ?>
                                <?php foreach ($history_bussiness['hs_listyears'] as $item) : ?>
                                    <div class="swiper-slide">
                                        <div class="item-history flex flex-col gap-6">
                                            <div class="img">
                                                <div class="rem:h-[213px]  overflow-hidden img-full"><img class="lozad undefined" data-src="<?php echo !empty($item['imageyear']['url']) ? $item['imageyear']['url'] : ''; ?>" alt="" />
                                                </div>
                                            </div>
                                            <div class="wrap flex flex-col gap-3">
                                                <div class="line-year flex flex-col items-center">
                                                    <div class="circle rounded-full border border-transparent p-2 bg-Utility-50">
                                                        <div class="dot w-full h-full rounded-full bg-Utility-700"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content h-full md:rem:h-[213px]">
                                                <div class="wrap-content  text-center">
                                                    <div class="format-content text-Neutral-700 font-normal"><?php echo !empty($item['contentyear']) ? $item['contentyear'] : ''; ?></div>
                                                    <div class="number mt-6 text-2xl font-bold text-Neutral-950"><?php echo !empty($item['year']) ? $item['year'] : ''; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="wrap-button-slide">
                    <div class="btn btn-prev btn-sw-1 blue"></div>
                    <div class="btn btn-next btn-sw-1 blue"></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($rewards)) : ?>
    <section class="about-7 section-py">
        <div class="container">
            <div class="heading mb-base">
                <h4 class="heading-5 text-Utility-700 mb-4"><?php echo !empty($rewards['rw_title']) ? $rewards['rw_title'] : ''; ?></h4>
                <h3 class="heading-2 text-Primary-2"><?php echo !empty($rewards['rw_subtitle']) ? $rewards['rw_subtitle'] : ''; ?></h3>
            </div>
            <div class="certification-slide relative">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php if (!empty($rewards['rw_list'])) : ?>
                            <?php foreach ($rewards['rw_list'] as $item) : ?>
                        <div class="swiper-slide">
                            <div class="item">
                                <div class="image"> <a class="img-ratio ratio:pt-[350_248] lozad" data-fancybox><img src="<?php echo !empty($item['imagereward']['url']) ? $item['imagereward']['url'] : ''; ?>" alt=""></a></div>
                                        <div class="content mt-4 text-center">
                                            <h3 class="text-xl font-bold text-Neutral-950 tracking-[-0.4px]"><?php echo !empty($item['contentreward']) ? $item['contentreward'] : ''; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="wrap-button-slide">
                    <div class="btn btn-prev btn-sw-1 blue"></div>
                    <div class="btn btn-next btn-sw-1 blue"></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>