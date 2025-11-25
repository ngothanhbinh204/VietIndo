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
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img class="lozad undefined" data-src="<?php echo get_template_directory_uri(); ?>/img/logo.svg"
                            alt="<?php bloginfo('name'); ?>" />
                    </a>
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
                        <div class="header-search"><img src="./img/icon-search.svg" alt="" /></div>
                        <div class="header-language">
                            <div class="header-language-active">
                                <ul>
                                    <li class="wpml-ls-current-language">
                                        <a href="">
                                            <div class="flag"><img src="./img/flag-VN.png" alt="" /></div>
                                            <span class="wpml-ls-native">VN</span>
                                        </a>
                                    </li>
                                    <ul>
                                        <li>
                                            <a href=""> <span>EN</span></a>
                                        </li>
                                    </ul>
                                </ul>
                            </div>
                            <div class="header-language-list">
                                <ul>
                                    <li class="wpml-ls-current-language">
                                        <a href=""> <span class="wpml-ls-native">VN</span></a>
                                    </li>
                                    <ul>
                                        <li>
                                            <a href=""> <span>EN</span></a>
                                        </li>
                                    </ul>
                                </ul>
                            </div>
                        </div>
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
                <div class="productsearchbox">
                    <input type="text" placeholder="Tìm kiếm thông tin" />
                    <button><i class="fa-light fa-magnifying-glass"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div data-scroll-container>
        <main>