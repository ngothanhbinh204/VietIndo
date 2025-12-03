<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Saira:ital,wght@0,100..900;1,100..900&amp;display=swap"
        rel="stylesheet" />

    <?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) : ?>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<?php
$hd_email = get_field('hd_email', 'option');
$hd_phone = get_field('hd_phone', 'option');
?>

<body <?php body_class(get_field('add_class_body', get_the_ID())) ?>>
    <header class="header">
        <div class="container-fluid">
            <div class="header-wrapper">
                <div class="header-logo">
                    <?php 
                    if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                        the_custom_logo();
                    } else {
                        ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                    <?php
                    }
                    ?>
                </div>
                <div class="header-right">
                    <div class="header-menu">
                        <?php
						wp_nav_menu(array(
							'theme_location' => 'header-menu',
							'container' => 'ul',
							'menu_class' => 'header-nav',
						));
						?>
                    </div>
                    <div class="header-right-inner">
                        <div class="header-search">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.7951 13.7951L19.1667 19.1667M16.5 8.5C16.5 12.9183 12.9183 16.5 8.5 16.5C4.08172 16.5 0.5 12.9183 0.5 8.5C0.5 4.08172 4.08172 0.5 8.5 0.5C12.9183 0.5 16.5 4.08172 16.5 8.5Z"
                                    stroke="#292929" />
                            </svg>

                        </div>
                        <?php echo do_shortcode('[custom_wpml_switcher]'); ?>
                        <div class="header-bar"><i class="fa-solid fa-bars"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="header-search-form">
        <div
            class="close flex items-center justify-center absolute top-0 right-0 bg-white text-3xl cursor-pointer w-12.5 h-12.5">
            <i class="fa-light fa-xmark"></i>
        </div>
        <div class="container">
            <div class="wrap-form-search-product">
                <!-- <div class="productsearchbox">
                    <input type="text" placeholder="Tìm kiếm thông tin" />
                    <button><i class="fa-light fa-magnifying-glass"></i></button>

                </div> -->
                <div class="productsearchbox">

                    <form class="form-search search-custom" role="search" method="get"
                        action="<?php echo home_url('/'); ?>">
                        <input type="search" name="s" class="searchinput"
                            placeholder="<?php esc_attr_e('Tìm kiếm...', 'canhcamtheme') ?>" autocomplete="off" />

                        <button type="submit" class="searchbutton">
                            <i class="fa-light fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div data-scroll-container>
        <main>