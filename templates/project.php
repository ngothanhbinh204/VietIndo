<?php
/*
 Template Name: Page - Project
 */

$section_1 = get_field('section_1');
$section_2 = get_field('section_2');
$section_3 = get_field('section_3');
$section_4 = get_field('section_4');
$section_5 = get_field('section_5');

?>

<?php get_header(); ?>


<section class="project-1">
    <?php get_template_part('template-parts/section', 'breadcrumb'); ?>
</section>

<?php if (!empty($section_1)) : ?>
    <section class="project-2 bg-Primary-1 pt-10">
        <div class="container-fluid">
            <div class="image relative"> <a class="img-ratio ratio:pt-[796_1840]" href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_1['s1_background']['url']) ? $section_1['s1_background']['url'] : ''; ?>" alt="<?php echo !empty($section_1['s1_background']['alt']) ? $section_1['s1_background']['alt'] : ''; ?>" /></a>
                <div class="content">
                    <h1><?php echo !empty($section_1['s1_title']) ? $section_1['s1_title'] : ''; ?></h1>
                    <h2><?php echo !empty($section_1['s1_content']) ? $section_1['s1_content'] : ''; ?></h2>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($section_2)) : ?>
    <section class="project-3 bg-Primary-1">
        <div class="container-fluid">
            <div class="wrap flex gap-6 items-center section-40">
                <div class="number-title text-2xl font-bold text-Neutral-White"><?php echo !empty($section_2['s2_part']) ? $section_2['s2_part'] : ''; ?></div>
                <div class="line flex-1 bg-linear-line h-[1px]"></div>
                <h2 class="title-48 !text-Neutral-White"><?php echo !empty($section_2['s2_namepart']) ? $section_2['s2_namepart'] : ''; ?></h2>
                <div class="line flex-1 bg-linear-line h-[1px]"></div>
                <div class="number-title text-2xl font-bold text-Neutral-White"><?php echo !empty($section_2['s2_part']) ? $section_2['s2_part'] : ''; ?></div>
            </div>
            <div class="project-3-main flex flex-col lg:flex-row gap-base">
                <div class="col-left lg:w-2/4 w-full">
                    <div class="content xl:p-16 p-8 bg-Primary-2 h-full">
                        <h3 class="text-2xl font-bold text-Neutral-White pl-6 border-l border-l-Secondary-2 tracking-[-0.48px] mb-6 leading-[1.25]"><?php echo !empty($section_2['s2_title']) ? $section_2['s2_title'] : ''; ?></h3>
                        <div class="content-main flex flex-col md:flex-row gap-0 md:gap-4">
                            <div class="content-left md:w-1/2 w-full">
                                <div class="format-content">
                                    <?php echo !empty($section_2['s2_content1']) ? $section_2['s2_content1'] : ''; ?>
                                </div>
                            </div>
                            <div class="content-right md:w-1/2 w-full">
                                <div class="format-content">
                                    <?php echo !empty($section_2['s2_content2']) ? $section_2['s2_content2'] : ''; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-right lg:w-2/4 w-full flex items-stretch">
                    <div class="image flex-1"> <a class="img-ratio " href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_2['s2_image']) ? $section_2['s2_image']['url'] : '' ?>" alt="" /></a></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php if (!empty($section_3)) : ?>
    <section class="project-4 bg-Primary-1">
        <div class="container-fluid">
            <div class="wrap flex gap-6 items-center section-40">
                <div class="number-title text-2xl font-bold text-Neutral-White"><?php echo !empty($section_3['s3_part']) ? $section_3['s3_part'] : ''; ?></div>
                <div class="line flex-1 bg-linear-line h-[1px]"></div>
                <h2 class="title-48 !text-Neutral-White"><?php echo !empty($section_3['s3_namepart']) ? $section_3['s3_namepart'] : ''; ?></h2>
                <div class="line flex-1 bg-linear-line h-[1px]"></div>
                <div class="number-title text-2xl font-bold text-Neutral-White"><?php echo !empty($section_3['s3_part']) ? $section_3['s3_part'] : ''; ?></div>
            </div>
            <div class="project-4-box bg-Neutral-Black md:p-16 p-10 flex flex-col md:flex-row md:gap-20 gap-10">
                <div class="col-left w-full md:rem:w-[440px]">
                    <div class="format-content">
                        <?php echo !empty($section_3['s3_content1']) ? $section_3['s3_content1'] : ''; ?>
                    </div>
                </div>
                <div class="col-right md:w-[calc(100%-22.916666666666668rem-4.16667rem)] w-full">
                    <div class="image mb-base"><a class="img-ratio lg:ratio:pt-[440_1192] " href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_3['s3_image']) ? $section_3['s3_image']['url'] : '' ?>" alt="" /></a></div>
                    <div class="format-content">
                        <?php echo !empty($section_3['s3_content2']) ? $section_3['s3_content2'] : ''; ?>
                    </div>
                </div>
            </div>
            <div class="project-4-list grid xl:grid-cols-3 lg:grid-cols-2 gap-base section-40">
                
            <?php if (!empty($section_3['s3_repeater'])) : ?>
                <?php foreach ($section_3['s3_repeater'] as $item) : ?>
                <div class="item flex">
                    <div class="col-left w-2/4 md:py-12 md:px-10 p-5 bg-[#CA0008]">
                        <div class="top">
                            <h3 class="md:text-32 text-2xl text-Neutral-White font-bold uppercase tracking-[-0.64px] leading-[1.25]"><?php echo !empty($item['s3_rep_title']) ? $item['s3_rep_title'] : ''; ?></h3>
                        </div>
                        <div class="bottom">
                            <div class="desc text-xl font-normal leading-[1.3] tracking-[-0.4px] text-Neutral-White"><?php echo !empty($item['s3_rep_content']) ? $item['s3_rep_content'] : ''; ?></div>
                        </div>
                    </div>
                    <div class="col-right w-2/4">
                        <div class="image"> <a class="img-ratio ratio:pt-[358_293]" href="#"><img src="<?php echo !empty($item['s3_repimage']) ? $item['s3_repimage']['url'] : '' ?>" alt="<?php echo !empty($item['s3_repimage']['alt']) ? $item['s3_repimage']['alt'] : ''; ?>"></a></div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>

            </div>
            <div class="project-4-intro lg:rem:w-[1192px] w-full mx-auto pb-10">
                <div class="format-content text-center text-lg text-Neutral-White font-normal tracking-[-0.36px]">
                <?php echo !empty($section_3['s3_content3']) ? $section_3['s3_content3'] : ''; ?>
                </div>
                </div>
            </div>
            <div class="image-intro"> <a class="img-ratio ratio:pt-[540_1840]" href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_3['s3_imagebottom']) ? $section_3['s3_imagebottom']['url'] : '' ?>" alt="" /></a></div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($section_4)) : ?>
    <section class="project-5 section-40 bg-Primary-1">
        <div class="container-fluid">
            <div class="project-5-main flex flex-col lg:flex-row gap-base">
                <div class="col-left lg:w-2/4 w-full">
                    <div class="image"> <a class="img-ratio" href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_4['s4_imageleft']) ? $section_4['s4_imageleft']['url'] : '' ?>" alt="" /></a></div>
                </div>
                <div class="col-right lg:w-2/4 w-full">
                    <div class="heading lg:py-10 py-0 xl:rem:mb-[166px] md:mb-10 mb-0">
                        <div class="wrap flex gap-6 items-center">
                            <div class="number-title text-2xl font-bold text-Neutral-White"><?php echo !empty($section_4['s4_part']) ? $section_4['s4_part'] : ''; ?></div>
                            <div class="line flex-1 bg-linear-line-2 h-[1px]"></div>
                        </div>
                        <h2 class="title-48 !text-Neutral-White mt-6"><?php echo !empty($section_4['s4_namepart']) ? $section_4['s4_namepart'] : ''; ?></h2>
                    </div>
                    <div class="project-overview flex mt-5 md:mt-0 flex-col md:flex-row gap-base">
                        <div class="title md:rem:w-[222px] w-full">
                            <h3 class="text-2xl font-bold text-Neutral-White leading-[1.25] tracking-[-0.48px]"><?php echo !empty($section_4['s4_overview']) ? $section_4['s4_overview'] : ''; ?></h3>
                        </div>
                        <div class="content md:w-[calc(100%-11.5625rem-2.08333rem)] w-full">
                            <div class="image mb-base"><a class="img-ratio ratio:pt-[200_640]" href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_4['s4_imageright']) ? $section_4['s4_imageright']['url'] : '' ?>" alt="" /></a></div>
                            <div class="format-content">
                            <?php echo !empty($section_4['s4_content']) ? $section_4['s4_content'] : ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="project-5-intro section-40">
                <div class="image relative"> <a class="img-ratio ratio:pt-[598_1840]" href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_4['s4_background']) ? $section_4['s4_background']['url'] : '' ?>" alt="" /></a>
                    <div class="content">
                        <?php if (!empty($section_4['s4_repeater'])) : ?>
                            <?php foreach ($section_4['s4_repeater'] as $item) : ?>
                        <div class="item">
                            <div class="top">
                                <h3><?php echo !empty($item['s4_rep_title']) ? $item['s4_rep_title'] : ''; ?></h3>
                            </div>
                            <div class="bottom">
                                <div class="format-content">
                                    <?php echo !empty($item['s4_rep_content']) ? $item['s4_rep_content'] : ''; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                       
                    </div>
                </div>
            </div>
            
            <div class="project-5-overview lg:rem:w-[1160px] mx-auto w-full">
                <div class="wrap flex flex-col-reverse lg:flex-row gap-base">
                    <div class="left lg:rem:w-[800px] w-full">
                        <div class="title text-lg font-bold text-Neutral-White mb-base">  <?php echo !empty($section_4['s4_content2']) ? $section_4['s4_content2'] : ''; ?></div>
                        <div class="format-content text-lg text-Neutral-White font-normal tracking-[-0.36px]">
                        <?php echo !empty($section_4['s4_content3']) ? $section_4['s4_content3'] : ''; ?>
                        </div>
                    </div>
                    <div class="right lg:w-[calc(100%-41.66666666666667rem-2.08333rem)] w-full">
                        <div class="image"> <a class="img-ratio lg:ratio:pt-[472_320]" href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_4['s4_image2']) ? $section_4['s4_image2']['url'] : '' ?>" alt="" /></a></div>
                    </div>
                </div>
                <div class="gallary flex rem:gap-[7px] mt-base">
                    <div class="gallary-left lg:rem:w-[444px] w-full">
                        <div class="image"> <a class="img-ratio lg:ratio:pt-[531_444]" href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_4['s4_image3']) ? $section_4['s4_image3']['url'] : '' ?>" alt="" /></a></div>
                    </div>
                    <div class="gallary-right lg:w-[calc(100%-23.125rem-0.36458333333333337rem)] w-full">
                        <div class="image"> <a class="img-ratio lg:ratio:pt-[531_706]" href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_4['s4_image4']) ? $section_4['s4_image4']['url'] : '' ?>" alt="" /></a></div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($section_5)) : ?>
    <section class="project-6 section-40 bg-Primary-1">
        <div class="container-fluid">
            <div class="project-6-main flex flex-col gap-10 xl:gap-0 xl:flex-row">
                <div class="image-left xl:rem:w-[470px] w-full"><a class="img-ratio xl:ratio:pt-[770_470]" href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_5['s5_imageleft']) ? $section_5['s5_imageleft']['url'] : '' ?>" alt="" /></a></div>
                <div class="content flex-1 bg-Primary-2 lg:py-10 lg:px-16 p-8">
                    <div class="wrap flex gap-6 items-center">
                        <div class="number-title text-2xl font-bold text-Neutral-White"><?php echo !empty($section_5['s5_part']) ? $section_5['s5_part'] : ''; ?></div>
                        <div class="line flex-1 bg-linear-line-2 h-[1px]"></div>
                    </div>
                    <h2 class="title-48 !text-Neutral-White mb-base"><?php echo !empty($section_5['s5_namepart']) ? $section_5['s5_namepart'] : ''; ?></h2>
                    <div class="format-content text-lg font-normal text-Neutral-White">
                        <?php echo !empty($section_5['s5_content']) ? $section_5['s5_content'] : ''; ?>
                    </div>
                </div>
                <div class="image-right xl:rem:w-[470px] w-full"><a class="img-ratio xl:ratio:pt-[770_470]" href="#"><img class="lozad undefined" data-src="<?php echo !empty($section_5['s5_imageright']) ? $section_5['s5_imageright']['url'] : '' ?>" alt="" /></a></div>
            </div>
            <div class="project-6-overview lg:rem:w-[1160px] w-full mx-auto lg:pt-20 pt-10">
                <div class="format-content text-lg text-Neutral-White font-normal text-center">
                   <?php echo !empty($section_5['s5_content2']) ? $section_5['s5_content2'] : ''; ?>
                </div>
            </div>
            <div class="project-6-list section-py">
                <h2 class="text-32 text-Neutral-White text-center font-bold uppercase tracking-[-0.64px]"><?php echo !empty($section_5['s5_namepart2']) ? $section_5['s5_namepart2'] : ''; ?></h2>
                <div class="wrapper grid xl:grid-cols-5 lg:grid-cols-3 md:grid-cols-2 gap-base mt-6">
                <?php if (!empty($section_5['s5_repeater'])) : ?>
                    <?php foreach ($section_5['s5_repeater'] as $item) : ?>
                    <div class="item">
                        <div class="image"> <a class="img-ratio" href="#"> <img class="lozad undefined" data-src="<?php echo !empty($item['s5_repimage']) ? $item['s5_repimage']['url'] : '' ?>" alt="<?php echo !empty($item['s5_repimage']['alt']) ? $item['s5_repimage']['alt'] : ''; ?>" /></a></div>
                        <div class="content rem:mt-[33px] text-Neutral-White">
                            <h3 class="text-xl font-bold  mb-4"><a href="#"> <?php echo !empty($item['s5_rep_title']) ? $item['s5_rep_title'] : ''; ?></a></h3>
                            <div class="desc text-lg font-normal"> <?php echo !empty($item['s5_rep_content']) ? $item['s5_rep_content'] : ''; ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                   
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="project-7">
    <?php get_template_part('template-parts/contact-service'); ?>
</section>


<?php get_footer(); ?>