<?php
/**
 * Template part for displaying the Horizontal 2x2 Image Grid Hero in single-portfolio
 */

$top_img_1 = get_field('portfolio_top_img_1');
$top_img_2 = get_field('portfolio_top_img_2');
$top_img_3 = get_field('portfolio_top_img_3');
$top_img_4 = get_field('portfolio_top_img_4');
?>

<section class="portfolio-hero-horizontal-grid">
	<?php if ( $top_img_1 ) : ?><div class="horiz-img horiz-img-1" style="background-image:url('<?php echo esc_url($top_img_1); ?>')"></div><?php endif; ?>
	<?php if ( $top_img_2 ) : ?><div class="horiz-img horiz-img-2" style="background-image:url('<?php echo esc_url($top_img_2); ?>')"></div><?php endif; ?>
	<?php if ( $top_img_3 ) : ?><div class="horiz-img horiz-img-3" style="background-image:url('<?php echo esc_url($top_img_3); ?>')"></div><?php endif; ?>
	<?php if ( $top_img_4 ) : ?><div class="horiz-img horiz-img-4" style="background-image:url('<?php echo esc_url($top_img_4); ?>')"></div><?php endif; ?>
</section>
