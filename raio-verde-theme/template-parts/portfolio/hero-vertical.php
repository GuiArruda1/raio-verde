<?php
/**
 * Template part for displaying the Vertical 6-Image Grid Hero in single-portfolio
 */

$vert_img_1 = get_field('portfolio_vert_img_1');
$vert_img_2 = get_field('portfolio_vert_img_2');
$vert_img_3 = get_field('portfolio_vert_img_3');
$vert_img_4 = get_field('portfolio_vert_img_4');
$vert_img_5 = get_field('portfolio_vert_img_5');
$vert_img_6 = get_field('portfolio_vert_img_6');
?>

<section class="portfolio-hero-vertical-grid">
	<?php if ( $vert_img_1 ) : ?><div class="vert-img vert-img-1" style="background-image:url('<?php echo esc_url($vert_img_1); ?>')"></div><?php endif; ?>
	<?php if ( $vert_img_2 ) : ?><div class="vert-img vert-img-2" style="background-image:url('<?php echo esc_url($vert_img_2); ?>')"></div><?php endif; ?>
	<?php if ( $vert_img_3 ) : ?><div class="vert-img vert-img-3" style="background-image:url('<?php echo esc_url($vert_img_3); ?>')"></div><?php endif; ?>
	<?php if ( $vert_img_4 ) : ?><div class="vert-img vert-img-4" style="background-image:url('<?php echo esc_url($vert_img_4); ?>')"></div><?php endif; ?>
	<?php if ( $vert_img_5 ) : ?><div class="vert-img vert-img-5" style="background-image:url('<?php echo esc_url($vert_img_5); ?>')"></div><?php endif; ?>
	<?php if ( $vert_img_6 ) : ?><div class="vert-img vert-img-6" style="background-image:url('<?php echo esc_url($vert_img_6); ?>')"></div><?php endif; ?>
</section>
