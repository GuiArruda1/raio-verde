<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Raio_Verde
 */

get_header();
?>

<main id="primary" class="site-main error-404-main">
	<section class="error-404-section">
		<div class="error-404-wrapper">
			<div class="error-404-row top-row">
				<h1 class="error-title"><?php esc_html_e( 'Oops... Error 404', 'raio-verde' ); ?></h1>
				<div class="link-wrapper home-link-wrapper">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="action-link">
						<span class="icon"><svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4551 10L20.5 6.875L17.4551 3.75M20.5 6.875H2.9359C2.28986 6.875 1.67028 6.61161 1.21346 6.14277C0.756638 5.67393 0.5 5.03804 0.5 4.375V0" stroke="currentColor" stroke-linejoin="round"/></svg></span>
						<span class="text-wrapper" data-text="<?php esc_attr_e( 'go to homepage', 'raio-verde' ); ?>">
							<span class="text-original"><?php esc_html_e( 'go to homepage', 'raio-verde' ); ?></span>
						</span>
					</a>
				</div>
			</div>
			
			<div class="error-404-row bottom-row">
				<div class="link-wrapper contact-link-wrapper">
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="action-link">
						<span class="icon"><svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4551 10L20.5 6.875L17.4551 3.75M20.5 6.875H2.9359C2.28986 6.875 1.67028 6.61161 1.21346 6.14277C0.756638 5.67393 0.5 5.03804 0.5 4.375V0" stroke="currentColor" stroke-linejoin="round"/></svg></span>
						<span class="text-wrapper" data-text="<?php esc_attr_e( 'get in touch', 'raio-verde' ); ?>">
							<span class="text-original"><?php esc_html_e( 'get in touch', 'raio-verde' ); ?></span>
						</span>
					</a>
				</div>
				<h2 class="error-subtitle"><?php esc_html_e( 'Page not found.', 'raio-verde' ); ?></h2>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
