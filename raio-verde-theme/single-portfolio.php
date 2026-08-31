<?php
/**
 * The template for displaying all single portfolio posts
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();
		
		// Layout Type
		$layout_type = get_field('portfolio_layout_type') ?: 'standard';
		
		// Fetch ACF Fields
		// Top Grid
		$top_img_1 = get_field('portfolio_top_img_1');
		$top_img_2 = get_field('portfolio_top_img_2');
		$top_img_3 = get_field('portfolio_top_img_3');
		$top_img_4 = get_field('portfolio_top_img_4');
		
		// Info
		$sub_1 = get_field('portfolio_subtitle_1');
		$sub_2 = get_field('portfolio_subtitle_2');
		$desc  = get_field('portfolio_description');
		
		// Middle Grid
		$mid_img_1 = get_field('portfolio_mid_img_1');
		$mid_img_2 = get_field('portfolio_mid_img_2');
		$mid_img_3 = get_field('portfolio_mid_img_3');
		
		// Video
		$vid_thumb = get_field('portfolio_video_thumbnail');
		$vid_url   = get_field('portfolio_video_url');
		
		// BTS
		$bts_t1 = get_field('portfolio_bts_title_1');
		$bts_t2 = get_field('portfolio_bts_title_2');
		$bts_desc = get_field('portfolio_bts_description');
		$bts_img_1 = get_field('portfolio_bts_img_1');
		$bts_img_2 = get_field('portfolio_bts_img_2');
		$bts_img_3 = get_field('portfolio_bts_img_3');
		$bts_img_4 = get_field('portfolio_bts_img_4');
		$has_bts   = ( $bts_t1 || $bts_t2 || $bts_desc || $bts_img_1 || $bts_img_2 || $bts_img_3 || $bts_img_4 );
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('single-portfolio layout-' . esc_attr($layout_type)); ?>>

			<!-- 1. Top Hero Section -->
			<?php if ( $layout_type === 'video' ) : ?>
				<?php get_template_part( 'template-parts/portfolio/hero', 'video' ); ?>
			<?php elseif ( $layout_type === 'vertical' ) : ?>
				<?php get_template_part( 'template-parts/portfolio/hero', 'vertical' ); ?>
			<?php elseif ( $layout_type === 'horizontal' ) : ?>
				<?php get_template_part( 'template-parts/portfolio/hero', 'horizontal' ); ?>
			<?php else : ?>
				<section class="portfolio-top-grid">
					<?php if($top_img_1): ?><div class="top-img top-img-1" style="background-image:url('<?php echo esc_url($top_img_1); ?>')"></div><?php endif; ?>
					<?php if($top_img_2): ?><div class="top-img top-img-2" style="background-image:url('<?php echo esc_url($top_img_2); ?>')"></div><?php endif; ?>
					<?php if($top_img_3): ?><div class="top-img top-img-3" style="background-image:url('<?php echo esc_url($top_img_3); ?>')"></div><?php endif; ?>
					<?php if($top_img_4): ?><div class="top-img top-img-4" style="background-image:url('<?php echo esc_url($top_img_4); ?>')"></div><?php endif; ?>
				</section>
			<?php endif; ?>

			<!-- 2. Project Info -->
			<section class="portfolio-info-section">
				<div class="portfolio-info-wrapper">
					<div class="portfolio-info-text">
						<?php if($sub_1 || $sub_2): ?>
							<h2 class="portfolio-subtitle">
								<?php if($sub_1): ?><span class="subtitle-regular"><?php echo esc_html($sub_1); ?></span><?php endif; ?>
								<?php if($sub_1 && $sub_2): ?><br><?php endif; ?>
								<?php if($sub_2): ?><span class="subtitle-italic"><?php echo esc_html($sub_2); ?></span><?php endif; ?>
							</h2>
						<?php endif; ?>
						
						<?php if($desc): ?>
							<div class="portfolio-description">
								<?php echo wpautop(wp_kses_post($desc)); ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="portfolio-info-meta">
						<div class="meta-grid">
							<?php for($i=1; $i<=6; $i++): 
								$role = get_field('portfolio_credit_'.$i.'_role');
								$name = get_field('portfolio_credit_'.$i.'_name');
								if($role || $name):
							?>
								<div class="meta-item">
									<strong class="meta-label"><?php echo esc_html($role); ?></strong>
									<span class="meta-value"><?php echo esc_html($name); ?></span>
								</div>
							<?php 
								endif;
							endfor; 
							?>
						</div>
					</div>
				</div>
			</section>

			<!-- 3. Middle Section -->
			<?php if ( $layout_type === 'video' ) : ?>
				<?php get_template_part( 'template-parts/portfolio/middle', 'video' ); ?>
			<?php elseif ( $layout_type === 'horizontal' ) : ?>
				<?php get_template_part( 'template-parts/portfolio/middle', 'horizontal' ); ?>
			<?php else : ?>
				<!-- 3. Middle Image Grid -->
				<section class="portfolio-mid-grid">
					<?php if($mid_img_1): ?><div class="mid-img" style="background-image:url('<?php echo esc_url($mid_img_1); ?>')"></div><?php endif; ?>
					<?php if($mid_img_2): ?><div class="mid-img" style="background-image:url('<?php echo esc_url($mid_img_2); ?>')"></div><?php endif; ?>
					<?php if($mid_img_3): ?><div class="mid-img" style="background-image:url('<?php echo esc_url($mid_img_3); ?>')"></div><?php endif; ?>
				</section>

				<!-- 4. Video Section -->
				<?php if($vid_thumb && $vid_url): ?>
				<section class="portfolio-video-section">
					<div class="video-thumbnail-wrapper js-open-video-modal" data-video-url="<?php echo esc_attr($vid_url); ?>" style="background-image:url('<?php echo esc_url($vid_thumb); ?>')">
						<button class="play-button" aria-label="Play Video">
							<svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M8 5V19L19 12L8 5Z" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" fill="rgba(255,255,255,0.2)"/>
							</svg>
						</button>
					</div>
				</section>
				<?php endif; ?>
			<?php endif; ?>

			<!-- 5. Behind the Scenes -->
			<?php if ( $has_bts ) : ?>
			<section class="portfolio-bts-section">
				<div class="portfolio-bts-wrapper">
					<?php if ( $bts_t1 || $bts_t2 || $bts_desc ) : ?>
					<div class="bts-text">
						<?php if ( $bts_t1 || $bts_t2 ) : ?>
						<h2 class="bts-title">
							<?php if ( $bts_t1 ) : ?><span class="bts-title-regular"><?php echo esc_html($bts_t1); ?></span><?php endif; ?>
							<?php if ( $bts_t1 && $bts_t2 ) : ?><br><?php endif; ?>
							<?php if ( $bts_t2 ) : ?><span class="bts-title-italic"><?php echo esc_html($bts_t2); ?></span><?php endif; ?>
						</h2>
						<?php endif; ?>
						<?php if($bts_desc): ?>
							<div class="bts-description">
								<?php echo wpautop(wp_kses_post($bts_desc)); ?>
							</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if ( $bts_img_1 || $bts_img_2 || $bts_img_3 || $bts_img_4 ) : ?>
					<div class="bts-images-grid">
						<?php if($bts_img_1): ?><div class="bts-img" style="background-image:url('<?php echo esc_url($bts_img_1); ?>')"></div><?php endif; ?>
						<?php if($bts_img_2): ?><div class="bts-img" style="background-image:url('<?php echo esc_url($bts_img_2); ?>')"></div><?php endif; ?>
						<?php if($bts_img_3): ?><div class="bts-img" style="background-image:url('<?php echo esc_url($bts_img_3); ?>')"></div><?php endif; ?>
						<?php if($bts_img_4): ?><div class="bts-img" style="background-image:url('<?php echo esc_url($bts_img_4); ?>')"></div><?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</section>
			<?php endif; ?>

		</article><!-- #post-<?php the_ID(); ?> -->
		<?php
	endwhile; // End of the loop.
	?>

	<!-- Sophisticated Video Modal -->
	<div id="video-modal" class="video-modal" aria-hidden="true">
		<div class="video-modal-backdrop js-close-video-modal"></div>
		<div class="video-modal-content">
			<button class="video-modal-close js-close-video-modal" aria-label="Close modal">
				<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
			</button>
			<div class="video-container" id="video-container">
				<!-- iframe injected here via JS -->
			</div>
		</div>
	</div>

</main><!-- #main -->

<?php
get_footer();
