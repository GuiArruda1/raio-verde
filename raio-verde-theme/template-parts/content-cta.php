<?php
/**
 * Template part for displaying the CTA (Call To Action) section.
 * 
 * Expects $args array:
 * 'headline_1'  => string
 * 'headline_2'  => string
 * 'link_1_text' => string
 * 'link_1_url'  => string
 * 'link_2_text' => string
 * 'link_2_url'  => string
 */

$cta_hl1 = $args['headline_1'] ?? 'Do you want to';
$cta_hl2 = $args['headline_2'] ?? 'work with us?';
$cta_l1_text = $args['link_1_text'] ?? 'view our portfolio';
$cta_l1_url  = $args['link_1_url'] ?? home_url('/portfolio/');
$cta_l2_text = $args['link_2_text'] ?? 'get in touch';
$cta_l2_url  = $args['link_2_url'] ?? home_url('/contact/');
?>
<div class="cta-top">
    <div class="cta-row cta-row-1">
        <h2 class="cta-headline"><?php echo esc_html($cta_hl1); ?></h2>
        <?php if($cta_l1_text): ?>
            <a href="<?php echo esc_url($cta_l1_url); ?>" class="action-link cta-link-right">
                <span class="icon"><svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4551 10L20.5 6.875L17.4551 3.75M20.5 6.875H2.9359C2.28986 6.875 1.67028 6.61161 1.21346 6.14277C0.756638 5.67393 0.5 5.03804 0.5 4.375V0" stroke="currentColor" stroke-linejoin="round"/></svg></span>
                <span class="text-wrapper" data-text="<?php echo esc_attr($cta_l1_text); ?>">
                    <span class="text-original"><?php echo esc_html($cta_l1_text); ?></span>
                </span>
            </a>
        <?php endif; ?>
    </div>

    <div class="cta-row cta-row-2">
        <?php if($cta_l2_text): ?>
            <a href="<?php echo esc_url($cta_l2_url); ?>" class="action-link cta-link-right-outside">
                <span class="icon"><svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4551 10L20.5 6.875L17.4551 3.75M20.5 6.875H2.9359C2.28986 6.875 1.67028 6.61161 1.21346 6.14277C0.756638 5.67393 0.5 5.03804 0.5 4.375V0" stroke="currentColor" stroke-linejoin="round"/></svg></span>
                <span class="text-wrapper" data-text="<?php echo esc_attr($cta_l2_text); ?>">
                    <span class="text-original"><?php echo esc_html($cta_l2_text); ?></span>
                </span>
            </a>
        <?php endif; ?>
        <h2 class="cta-headline"><?php echo esc_html($cta_hl2); ?></h2>
    </div>
</div>
