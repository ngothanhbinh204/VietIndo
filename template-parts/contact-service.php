



<?php

$ct_background = get_field('ct_background', 'option');

$ct_title = get_field('ct_title', 'option');

$ct_subtitle = get_field('ct_subtitle', 'option');

$ct_content = get_field('ct_content', 'option');



$ct_phone = get_field('ct_phone', 'option');

$ct_zalo = get_field('ct_zalo', 'option');

$ct_icon_phone = get_field('ct_icon_phone', 'option');

$ct_zaloimage = get_field('ct_zaloimage', 'option');

$ct_linkzalo = get_field('ct_linkzalo', 'option');

$ct_telphone = get_field('ct_telphone', 'option');

?>



<div class="contact-section xl:rem:py-[168px] md:py-20 py-10 bg-linear-6 relative">

    <div class="contact-bg absolute left-0 bottom-[-1rem] hidden md:block">

        <div class="image xl:rem:w-[584px] lg:rem:w-[450px] w-[320px]"><a class="img-ratio ratio:pt-[636_584] lozad" href="#"><img src="<?php echo !empty($ct_background) ? $ct_background['url'] : ''; ?>" alt="<?php echo !empty($ct_background) ? $ct_background['alt'] : ''; ?>" /></a></div>

    </div>

    <div class="container">

        <div class="contact-content md:rem:max-w-[684px] flex md:ml-[23rem] ml-0  flex-col gap-7">

            <h4 class="text-2xl font-bold text-Primary-1 tracking-[-0.48px]"><?php echo !empty($ct_title) ? $ct_title : ''; ?></h4>

            <h3 class="title-48"><?php echo !empty($ct_subtitle) ? $ct_subtitle : ''; ?></h3>

            <div class="format-content text-xl font-normal text-Primary-2">

                <div><?php echo !empty($ct_content) ? $ct_content : ''; ?></div>

            </div>

            <div class="contact-button"> <a class="phone" href="<?php echo !empty($ct_telphone['url']) ? $ct_telphone['url'] : ''; ?>">

                    <div class="icon"> <?php echo !empty($ct_icon_phone) ? $ct_icon_phone : ''; ?><span><?php echo !empty($ct_phone) ? $ct_phone : ''; ?></span></div>

                </a><a class="zalo" href="<?php echo !empty($ct_linkzalo['url']) ? $ct_linkzalo['url'] : ''; ?>">

                    <div class="icon"> <img src="<?php echo !empty($ct_zaloimage) ? $ct_zaloimage['url'] : ''; ?>" alt="<?php echo !empty($ct_zaloimage) ? $ct_zaloimage['alt'] : ''; ?>" /><span><?php echo !empty($ct_zalo) ? $ct_zalo : ''; ?></span></div>

                </a></div>

        </div>

    </div>

</div>



