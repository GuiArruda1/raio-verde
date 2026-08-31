<?php
/**
 * Template part for displaying the Middle Stacked Videos in single-portfolio (Video Showcase layout)
 */

$mid_1_thumb = get_field('portfolio_video_mid_1_thumb');
$mid_1_url   = get_field('portfolio_video_mid_1_url');

$mid_2_thumb = get_field('portfolio_video_mid_2_thumb');
$mid_2_url   = get_field('portfolio_video_mid_2_url');

if ( ($mid_1_thumb && $mid_1_url) || ($mid_2_thumb && $mid_2_url) ) :
?>
<section class="portfolio-middle-stacked-videos">
	<?php if ( $mid_1_thumb && $mid_1_url ) : ?>
	<div class="video-stacked-item">
		<div class="video-thumbnail-wrapper js-open-video-modal" data-video-url="<?php echo esc_attr($mid_1_url); ?>" style="background-image:url('<?php echo esc_url($mid_1_thumb); ?>')">
			<button class="play-button" aria-label="<?php esc_attr_e('Play Video 1', 'raio-verde'); ?>">
				<svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8 5V19L19 12L8 5Z" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" fill="rgba(255,255,255,0.2)"/>
				</svg>
			</button>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( $mid_2_thumb && $mid_2_url ) : ?>
	<div class="video-stacked-item">
		<div class="video-thumbnail-wrapper js-open-video-modal" data-video-url="<?php echo esc_attr($mid_2_url); ?>" style="background-image:url('<?php echo esc_url($mid_2_thumb); ?>')">
			<button class="play-button" aria-label="<?php esc_attr_e('Play Video 2', 'raio-verde'); ?>">
				<svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8 5V19L19 12L8 5Z" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" fill="rgba(255,255,255,0.2)"/>
				</svg>
			</button>
		</div>
	</div>
	<?php endif; ?>
</section>
<?php endif; ?>
