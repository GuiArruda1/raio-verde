<?php
/**
 * Template part for displaying the Middle Horizontal Grid & Video in single-portfolio
 */

$mid_img_1 = get_field('portfolio_mid_img_1');
$mid_img_2 = get_field('portfolio_mid_img_2');

$vid_thumb = get_field('portfolio_video_thumbnail');
$vid_url   = get_field('portfolio_video_url');
?>

<!-- Middle Horizontal 2-Image Grid -->
<?php if ( $mid_img_1 || $mid_img_2 ) : ?>
<section class="portfolio-mid-horizontal-grid">
	<?php if ( $mid_img_1 ) : ?><div class="mid-horiz-img" style="background-image:url('<?php echo esc_url($mid_img_1); ?>')"></div><?php endif; ?>
	<?php if ( $mid_img_2 ) : ?><div class="mid-horiz-img" style="background-image:url('<?php echo esc_url($mid_img_2); ?>')"></div><?php endif; ?>
</section>
<?php endif; ?>

<!-- Video Section -->
<?php if ( $vid_thumb && $vid_url ) : ?>
<section class="portfolio-video-section">
	<div class="video-thumbnail-wrapper js-open-video-modal" data-video-url="<?php echo esc_attr($vid_url); ?>" style="background-image:url('<?php echo esc_url($vid_thumb); ?>')">
		<button class="play-button" aria-label="<?php esc_attr_e('Play Video', 'raio-verde'); ?>">
			<svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8 5V19L19 12L8 5Z" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" fill="rgba(255,255,255,0.2)"/>
			</svg>
		</button>
	</div>
</section>
<?php endif; ?>
