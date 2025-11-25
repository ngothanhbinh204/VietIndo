<?php
/*
 Template Name: Page - Homepage
 */

$current_page = get_the_ID();
?>

<?php get_header(); ?>





<?php get_template_part('modules/home/section-1'); ?>
<?php get_template_part('modules/home/section-2'); ?>
<?php get_template_part('modules/home/section-3'); ?>
<?php get_template_part('modules/home/section-4'); ?>
<?php get_template_part('modules/home/section-5'); ?>
<?php get_template_part('modules/home/section-6'); ?>

<section class="home-7">
    <?php get_template_part('template-parts/contact-service'); ?>
</section>


<?php get_footer(); ?>