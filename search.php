<?php get_header() ?>

<div class="single-frame">
	<section class="search-page section" setbackground="/wp-content/themes/forestBay/img/TinTuc/news-bg.jpg">
		<div class="container max-w-screen-2xl">
			<h1 class="block-title text-center mb-30px"><?php _e('Tìm kiếm','canhcamtheme'); ?></h1>
			<div class="search-query"><?php _e('Kết quả tìm kiếm từ khóa:','canhcamtheme'); ?> " <span><?php echo get_search_query() ?></span> "</div>
			<div class="news-2-list grid lg:grid-cols-3 gap-base md:grid-cols-2">
				<?php
				
				while (have_posts()):
					the_post();
					
				?>
					<div class="item group">
						<div class="image">
							<a class="img-ratio ratio:pt-[280_320] lozad zoom-img" href="<?php the_permalink(); ?>">
								<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="">
							</a>
						</div>
						<div class="content pt-6 flex flex-col gap-4">
							<div class="date"><?php echo get_the_date('d/m/Y'); ?></div>
							<h3 class="text-lg font-semibold text-Neutral-950 tracking-[-0.36px] group-hover:text-Primary-1">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
</div>
<?php get_footer() ?>