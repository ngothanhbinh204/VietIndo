<?php

global $post;

$position = get_field('position', $post->ID);

$position_title = get_field('position_title', $post->ID);

$degree_required = get_field('degree_required', $post->ID);

$salary = get_field('salary', $post->ID);

$amount = get_field('amount', $post->ID);

$address = get_field('address', $post->ID);

$sex = get_field('sex', $post->ID);

$deadlineapply = get_field('deadlineapply', $post->ID);

$list_required = get_field('list_required', $post->ID);

$related_postion = get_field('related_postion', $post->ID);

$file_demo_apply = get_field('file_demo_apply', 'option');

get_header();

?>



<?php get_template_part('template-parts/section', 'breadcrumb'); ?>

<section class="recruitment-detail-1 lg:py-20 py-10">

    <div class="container">

        <div class="recruitment-detail-main flex gap-10 lg:flex-row flex-col">

            <div class="col-left lg:w-8/12 w-full">

                <div class="content bg-Utility-50 md:p-8 p-4">
                    <h1 class="heading-2 font-bold text-Primary-2 pb-3 border-b border-b-neutral-200 mb-6"><?php the_title(); ?></h1>

                    <div class="recruitment-detail-tabs grid md:grid-cols-2 grid-cols-1 gap-base">

                        <div class="recruitment-detail-tab-left flex flex-col gap-5 w-full">

                            <div class="recruitment-detail-tab-item">

                                <div class="recruitment-location"><?php echo __('Vị trí ', 'canhcamtheme'); ?></div>

                                <div class="recruitment-location-position"><?php echo !(empty($position)) ? $position : ''; ?></div>

                            </div>

                            <div class="recruitment-detail-tab-item">

                                <div class="recruitment-location"><?php echo __('Chức vụ ', 'canhcamtheme'); ?></div>

                                <div class="recruitment-location-position"><?php echo !(empty($position_title)) ? $position_title : ''; ?></div>

                            </div>

                            <div class="recruitment-detail-tab-item">

                                <div class="recruitment-location"><?php echo __('Yêu cầu bằng cấp', 'canhcamtheme'); ?></div>

                                <div class="recruitment-location-position"><?php echo !(empty($degree_required)) ? $degree_required : ''; ?></div>

                            </div>

                            <div class="recruitment-detail-tab-item border-none">

                                <div class="recruitment-location"><?php echo __('Mức lương', 'canhcamtheme'); ?></div>

                                <div class="recruitment-location-position"><?php echo !(empty($salary)) ? $salary : ''; ?></div>

                            </div>

                        </div>

                        <div class="recruitment-detail-tab-right w-2/4 flex flex-col gap-5 max-lg:w-full">

                            <div class="recruitment-detail-tab-item">

                                <div class="recruitment-location"><?php echo __('Số lượng ứng tuyển', 'canhcamtheme'); ?></div>

                                <div class="recruitment-location-position"><?php echo !(empty($amount)) ? $amount : ''; ?></div>

                            </div>

                            <div class="recruitment-detail-tab-item">

                                <div class="recruitment-location"><?php echo __('Địa điểm làm việc', 'canhcamtheme'); ?></div>

                                <div class="recruitment-location-position"><?php echo !(empty($address)) ? $address : ''; ?></div>

                            </div>

                            <div class="recruitment-detail-tab-item">

                                <div class="recruitment-location"><?php echo __('Giới tính', 'canhcamtheme'); ?></div>

                                <div class="recruitment-location-position">

                                    <?php

                                    if ($sex == 'other') {

                                        echo 'Không yêu cầu';

                                    } elseif ($sex == 'male') {

                                        echo 'Nam';

                                    } elseif ($sex == 'female') {

                                        echo 'Nữ';

                                    } else {

                                        echo '';

                                    }

                                    ?>

                                </div>

                            </div>

                            <div class="recruitment-detail-tab-item border-none">

                                <div class="recruitment-location"><?php echo __('Hạn nộp hồ sơ', 'canhcamtheme'); ?></div>

                                <div class="recruitment-location-limit"><?php echo !(empty($deadlineapply)) ? $deadlineapply : ''; ?></div>

                            </div>

                        </div>

                    </div>

                </div>

                <?php if (!empty($list_required)) : ?>

                    <?php foreach ($list_required as $item) : ?>
                        <div class="wrap-content flex flex-col gap-7 mt-base">
                            <div class="content md:p-8 p-4 bg-Utility-50">
                                <h3 class="heading-4 font-normal text-Primary-2 pb-3 border-b border-b-Utility-200"><?php echo !(empty($item['title_job'])) ? $item['title_job'] : ''; ?></h3>
    
                                <div class="content-list mt-5 flex flex-col gap-3">
    
                                    <?php echo !(empty($item['content_job'])) ? $item['content_job'] : ''; ?>
    
                                </div>
    
                            </div>
                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

            <div class="col-right lg:w-4/12 w-full">

                <div class="button flex flex-col gap-3 p-6 bg-neutral-50">

                    <a href="#form-requirement" data-fancybox class="btn btn-primary blue"><span><?php echo __('Ứng tuyển', 'canhcamtheme'); ?></span><i class="fa-regular fa-plus"></i></a>
                    </a>

                    <a class="btn btn-dowload" href="<?php echo !empty($file_demo_apply) ? $file_demo_apply['url'] : '#' ?>" download ><span><?php echo __('TẢI HỒ SƠ ỨNG TUYỂN', 'canhcamtheme'); ?></span>
                        <div class="icon">
                            <i class="fa-regular fa-file-arrow-down"></i>
                        </div>
                    </a>
                </div>

                <div class="box-info mt-10 max-lg:border max-lg:border-neutral-300 border border-Neutral-100">

                    <h2 class="box-info-heading lg:px-3 lg:py-4 p-3 bg-Primary-1 text-white font-bold text-2xl"><?php echo __('Vị trí tuyển dụng khác', 'canhcamtheme'); ?></h2>


                    <?php

                    $args = array(

                        'post_type' => 'recruitment',

                        'posts_per_page' => 4,

                        'post__not_in'   => array(get_the_ID()),

						'post_status' => 'publish',

                        'orderby' => 'date',

                        'order' => 'DESC',

                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

                        <div class="box-info-item">

                            <h3><?php the_title(); ?></h3>

                            <div class="box-info-date"> <i class="fa-regular fa-calendar-star"></i><span class="title"><?php echo __('Hạn nộp hồ sơ', 'canhcamtheme'); ?> </span><span class="date"><?php echo get_the_date('d.m.Y'); ?></span></div>

                        </div>

                    <?php endwhile;

                    endif;

                    wp_reset_postdata(); ?>



                </div>

            </div>

        </div>

    </div>

</section>

<div id="form-requirement" style="display: none;" data-fancybox-modal>

<div class="popup-content w-full relative z-50">
        <h3 class="title-job text-5xl text-Neutral-Black font-light mb-10"><?php echo get_the_title(); ?></h3>
        <?php $job_title = get_the_title(); 
        echo do_shortcode('[contact-form-7 id="0c097f2" title="Form Ứng tuyển" html_id="form-requirement" job-title="' . esc_attr($job_title) . '"]'); ?>
    </div>

</div>



<?php

get_footer();

?>