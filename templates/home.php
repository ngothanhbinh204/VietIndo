<?php
/*
 Template Name: Page - Homepage
 */

$current_page = get_the_ID();
?>

<?php get_header(); ?>

<?php if (have_rows('home_sections')) : ?>
    <?php while (have_rows('home_sections')) : the_row(); ?>
        <?php
        $layout = get_row_layout();
        if ($layout == 'home_1') {
            get_template_part('modules/home/section-1');
        } elseif ($layout == 'home_2') {
            get_template_part('modules/home/section-2');
        } elseif ($layout == 'home_3') {
            get_template_part('modules/home/section-3');
        } elseif ($layout == 'home_4') {
            get_template_part('modules/home/section-4');
        } elseif ($layout == 'home_5') {
            get_template_part('modules/home/section-5');
        } elseif ($layout == 'home_6') {
            get_template_part('modules/home/section-6');
        } elseif ($layout == 'home_7') {
            get_template_part('modules/home/section-7');
        }
        ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>