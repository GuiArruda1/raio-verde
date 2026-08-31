<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'raio-verde' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link">
				<?php 
				$dark_logo_id = get_theme_mod( 'raio_verde_dark_logo' );
				$dark_logo = wp_get_attachment_image_src( $dark_logo_id, 'full' );
				?>
				
				<?php if ( has_custom_logo() ) : ?>
					<?php 
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
					?>
					<img src="<?php echo esc_url( $logo[0] ); ?>" class="custom-logo light-logo" alt="<?php bloginfo('name'); ?>">
				<?php else : ?>
					<span class="logo-text light-logo"><span class="logo-line">RAIO</span>VERDE</span>
				<?php endif; ?>

				<?php if ( $dark_logo ) : ?>
					<img src="<?php echo esc_url( $dark_logo[0] ); ?>" class="custom-logo dark-logo" alt="<?php bloginfo('name'); ?>">
				<?php else : ?>
					<span class="logo-text dark-logo"><span class="logo-line">RAIO</span>VERDE</span>
				<?php endif; ?>
			</a>
		</div>

		<?php if ( is_singular( 'portfolio' ) ) : ?>
			<div class="header-project-title">
				<?php echo esc_html( get_the_title() ); ?>
			</div>
		<?php endif; ?>

		<nav id="site-navigation" class="main-navigation">
			<div class="mobile-menu-inner">
				<?php
				if ( has_nav_menu( 'menu-mobile' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'menu-mobile',
							'menu_class'     => 'mobile-primary-list',
							'container'      => false,
							'fallback_cb'    => false,
						)
					);
				} else {
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_class'     => 'mobile-primary-list',
							'container'      => false,
							'fallback_cb'    => false,
						)
					);
				}
				?>
				
				<?php
				if ( has_nav_menu( 'menu-2' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_class'     => 'mobile-secondary-list',
							'container'      => false,
							'fallback_cb'    => false,
						)
					);
				}
				?>
			</div>
		</nav><!-- #site-navigation -->

		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<span class="line line-1"></span>
			<span class="line line-2"></span>
			<span class="line line-3"></span>
		</button>

		<div class="desktop-side-menu">
			<nav class="side-menu-nav">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_class'     => 'side-menu-list',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
				<div class="side-menu-separator"></div>
				<?php
				if ( has_nav_menu( 'menu-2' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_class'     => 'side-menu-secondary-list',
							'container'      => false,
							'fallback_cb'    => false,
						)
					);
				}
				?>
			</nav>
		</div>
	</header><!-- #masthead -->
