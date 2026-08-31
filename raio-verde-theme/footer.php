<?php
$front_page_id   = get_option('page_on_front');
$footer_email    = get_field( 'footer_email', $front_page_id ) ?: 'hello@raioverde.pt';
$footer_insta    = get_field( 'footer_instagram_url', $front_page_id ) ?: '#';
$footer_location = get_field( 'footer_location_text', $front_page_id ) ?: 'Porto, Portugal, Anywhere';
$footer_loc_url  = get_field( 'footer_location_url', $front_page_id ) ?: '#';
$footer_inst_txt = get_field( 'footer_institutional_text', $front_page_id ) ?: 'A Duarte Costa &amp; Liliana Mendes, Lda é apoiada pelo Plano de Recuperação e Resiliência <br> (PRR), ao abrigo do programa Coaching 4.0, inserido na Componente 16 — Empresas 4.0';
$footer_inst_img = get_field( 'footer_institutional_logo', $front_page_id );

if ( ! empty( $footer_inst_img ) ) {
    if ( is_array( $footer_inst_img ) ) {
        $logo_url = $footer_inst_img['url'];
        $logo_alt = ! empty( $footer_inst_img['alt'] ) ? $footer_inst_img['alt'] : 'Institutional Logos';
    } elseif ( is_numeric( $footer_inst_img ) ) {
        $logo_url = wp_get_attachment_image_url( $footer_inst_img, 'full' );
        $logo_alt = get_post_meta( $footer_inst_img, '_wp_attachment_image_alt', true ) ?: 'Institutional Logos';
    } else {
        $logo_url = $footer_inst_img;
        $logo_alt = 'Institutional Logos';
    }
} else {
    $logo_url = get_template_directory_uri() . '/assets/images/prr-logos.png';
    $logo_alt = 'PRR - República Portuguesa - Financiado pela União Europeia NextGenerationEU';
}

$privacy_url = get_privacy_policy_url();
if ( ! $privacy_url ) {
    $privacy_page = get_page_by_path( 'privacy-policy' );
    $privacy_url = $privacy_page ? get_permalink( $privacy_page->ID ) : home_url( '/privacy-policy/' );
}
?>
<?php
$footer_l1_text = get_field('footer_link_1_text', $front_page_id) ?: 'portfolio';
$footer_l1_url  = get_field('footer_link_1_url', $front_page_id) ?: home_url('/portfolio/');
$footer_l2_text = get_field('footer_link_2_text', $front_page_id) ?: 'about';
$footer_l2_url  = get_field('footer_link_2_url', $front_page_id) ?: home_url('/about/');
$footer_l3_text = get_field('footer_link_3_text', $front_page_id) ?: 'contact';
$footer_l3_url  = get_field('footer_link_3_url', $front_page_id) ?: home_url('/contact/');
?>
<footer id="colophon" class="site-footer">
    <div class="footer-wrapper">
        <nav class="footer-big-links">
            <a href="<?php echo esc_url($footer_l1_url); ?>" class="footer-link"><?php echo esc_html($footer_l1_text); ?></a>
            <a href="<?php echo esc_url($footer_l2_url); ?>" class="footer-link"><?php echo esc_html($footer_l2_text); ?></a>
            <a href="<?php echo esc_url($footer_l3_url); ?>" class="footer-link"><?php echo esc_html($footer_l3_text); ?></a>
        </nav>

        <div class="footer-bottom-info">
            <div class="footer-col footer-col-email">
                <a href="mailto:<?php echo esc_attr( $footer_email ); ?>"><?php echo esc_html( $footer_email ); ?></a>
            </div>
            <div class="footer-col footer-col-social">
                <a href="<?php echo esc_url( $footer_insta ); ?>" target="_blank" rel="noopener">instagram</a>
            </div>
            <div class="footer-col footer-col-location">
                <a href="<?php echo esc_url( $footer_loc_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $footer_location ); ?></a>
            </div>
            <div class="footer-col footer-col-copyright">
                Copyright &copy; <?php echo date('Y'); ?> Raio Verde. All rights reserved &middot;
                <a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'Privacy and Cookies Policies', 'raio-verde' ); ?></a>.
            </div>
        </div>

        <div class="footer-institutional">
            <p class="footer-institutional-text"><?php echo wp_kses_post( $footer_inst_txt ); ?></p>
            <img src="<?php echo esc_url( $logo_url ); ?>"
                alt="<?php echo esc_attr( $logo_alt ); ?>"
                class="footer-institutional-logos">
        </div>
    </div><!-- .footer-wrapper -->
</footer><!-- #colophon -->
</div><!-- #page -->

<div id="rv-cookie-banner" class="rv-cookie-banner" style="display: none;">
    <div class="cookie-banner-content">
        <p>
            <?php esc_html_e('We use cookies to improve your experience. By continuing to visit this site you agree to our', 'raio-verde'); ?>
            <a href="<?php echo esc_url($privacy_url); ?>"><?php esc_html_e('Privacy & Cookies Policies', 'raio-verde'); ?></a>.
        </p>
    </div>
    <div class="cookie-banner-actions">
        <button id="cookie-accept" class="cookie-btn cookie-accept"><?php esc_html_e('Accept', 'raio-verde'); ?></button>
        <button id="cookie-reject" class="cookie-btn cookie-reject"><?php esc_html_e('Decline', 'raio-verde'); ?></button>
    </div>
</div>

<?php wp_footer(); ?>

</body>

</html>