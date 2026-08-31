<?php
/**
 * Template part for displaying the Hero Video in single-portfolio
 */

$hero_vid_thumb = get_field('portfolio_hero_video_thumbnail');
$hero_vid_url   = get_field('portfolio_hero_video_url');

if ( $hero_vid_thumb && $hero_vid_url ) :
?>
<section class="portfolio-hero-video-section">
	<div class="video-thumbnail-wrapper js-open-video-modal" data-video-url="<?php echo esc_attr($hero_vid_url); ?>" style="background-image:url('<?php echo esc_url($hero_vid_thumb); ?>')">
		<button class="play-button" aria-label="<?php esc_attr_e('Play Video', 'raio-verde'); ?>">
			<svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8 5V19L19 12L8 5Z" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" fill="rgba(255,255,255,0.2)"/>
			</svg>
		</button>
	</div>
</section>
<?php endif; ?>
