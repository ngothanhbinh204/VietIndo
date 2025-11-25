<?php
if (have_rows('home_section', get_the_ID())) {
    while (have_rows('home_section', get_the_ID())) {
        the_row();
        if (get_row_layout() == 'banner_section') {
            $repeater_section_banner_desktop = get_sub_field('repeater_section_banner_desktop');
            $repeater_section_banner_mobile = get_sub_field('repeater_section_banner_mobile');
        }
    }
}
?>


<section class="home-1">
    <div class="slide relative">
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="home-1-banner relative">
                        <a class="img-ratio ratio:pt-[820_1920]" href="#">
                            <img class="lozad undefined" data-src="./img/banner.png" alt=""
                        /></a>
                        <div class="home-1-content text-white">
                            <div
                                class="sub-title heading-3 font-semibold mb-3"
                                data-aos="fade-left"
                                data-aos-delay="200"
                                data-aos-duration="1200">
                                ĐỒNG HÀNH NĂNG LƯỢNG
                            </div>
                            <h1 data-aos="fade-left" data-aos-delay="400" data-aos-duration="1200">
                                VỮNG BƯỚC TƯƠNG LAI
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="home-1-banner relative">
                        <a class="img-ratio ratio:pt-[820_1920]" href="#">
                            <img class="lozad undefined" data-src="./img/1.jpg" alt=""
                        /></a>
                        <div class="home-1-content text-white">
                            <div class="sub-title heading-3 font-semibold mb-3">ĐỒNG HÀNH NĂNG LƯỢNG</div>
                            <h1>VỮNG BƯỚC TƯƠNG LAI</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap-button-slide">
            <div class="btn btn-sw-1 btn-prev"></div>
            <div class="btn btn-sw-1 btn-next"></div>
        </div>
    </div>
</section>