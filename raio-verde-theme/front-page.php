<?php
/**
 * The template for displaying the front page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 */

get_header();
?>

<main id="primary" class="site-main">

	<!-- Hero Section -->
	<?php 
	// Fetch ACF Fields
	$hero_image = rv_get_field('hero_background_image');
	$hero_video = rv_get_field('hero_background_video');

	$hero_primary = rv_get_field('hero_headline_primary');
	$hero_secondary = rv_get_field('hero_headline_secondary');
	
	// Fallbacks
	if (!$hero_primary && !$hero_secondary) {
		$hero_primary = 'bespoke';
		$hero_secondary = 'photo & video';
	}
	
	// Style for background image (only if no video is provided)
	$hero_style = '';
	if ($hero_image && !$hero_video) {
		$hero_style = 'style="background-image: url(' . esc_url($hero_image) . ');"';
	}
	?>
	<section class="hero-section" <?php echo $hero_style; ?>>
		<?php if ($hero_video): ?>
			<video class="hero-bg-video" src="<?php echo esc_url($hero_video); ?>" autoplay loop muted playsinline></video>
		<?php endif; ?>
		<div class="hero-content">
			<h1 class="hero-title">
				<?php if($hero_primary) echo esc_html($hero_primary) . ' '; ?>
				<?php if($hero_secondary) echo '<em>' . esc_html($hero_secondary) . '</em>'; ?>
			</h1>
		</div>
	</section>

	<!-- Statement Section -->
	<?php 
	$statement_primary = rv_get_field('statement_primary') ?: 'we create the atmosphere';
	$statement_secondary = rv_get_field('statement_secondary') ?: 'that your project demands';
	$statement_link_text = rv_get_field('statement_link_text') ?: 'how we do it?';
	$statement_link_url = rv_get_field('statement_link_url') ?: '#';
	?>
	<section class="statement-section bg-dark">
		<div class="statement-wrapper">
			<h2 class="statement-title">
				<span class="statement-primary"><?php echo esc_html($statement_primary); ?></span>
				<span class="statement-secondary-container">
					<em class="statement-secondary"><?php echo esc_html($statement_secondary); ?></em>
					<?php if($statement_link_text): ?>
						<a href="<?php echo esc_url($statement_link_url); ?>" class="action-link statement-action-link">
							<span class="icon"><svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4551 10L20.5 6.875L17.4551 3.75M20.5 6.875H2.9359C2.28986 6.875 1.67028 6.61161 1.21346 6.14277C0.756638 5.67393 0.5 5.03804 0.5 4.375V0" stroke="currentColor" stroke-linejoin="round"/></svg></span>
							<span class="text-wrapper" data-text="<?php echo esc_attr($statement_link_text); ?>">
								<span class="text-original"><?php echo esc_html($statement_link_text); ?></span>
							</span>
						</a>
					<?php endif; ?>
				</span>
			</h2>
		</div>
	</section>

	<!-- Portfolio Section -->
	<section class="portfolio-section" id="portfolio">
		<div class="portfolio-gallery">
			<?php 
			// Fetch curated relationship items from the ACF field
			$curated_portfolios = rv_get_field('front_portfolio_gallery');

			if ( $curated_portfolios ) :
				// Strictly limit to 10 items to guarantee the grid layout never breaks
				$curated_portfolios = array_slice($curated_portfolios, 0, 10);
				
				global $post;
				foreach ( $curated_portfolios as $post ) : 
					setup_postdata( $post );
					$img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
					// Fallback if no featured image is set
					if (!$img_url) $img_url = 'https://picsum.photos/seed/' . get_the_ID() . '/1200/800';
					?>
					<!-- TEMP FIX FOR LAUNCH: Disable links but keep hover -->
					<a href="#" onclick="event.preventDefault(); return false;" style="cursor: default;" class="portfolio-item action-link-trigger">
						<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>">
						<div class="portfolio-overlay">
							<span class="action-link portfolio-action">
								<span class="icon"><svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4551 10L20.5 6.875L17.4551 3.75M20.5 6.875H2.9359C2.28986 6.875 1.67028 6.61161 1.21346 6.14277C0.756638 5.67393 0.5 5.03804 0.5 4.375V0" stroke="currentColor" stroke-linejoin="round"/></svg></span>
								<span class="text-wrapper" data-text="<?php echo esc_attr(get_the_title()); ?>">
									<span class="text-original"><?php the_title(); ?></span>
								</span>
							</span>
						</div>
					</a>
					<?php
				endforeach;
				wp_reset_postdata();
			endif;
			?>
		</div>
		
		<?php if ( $curated_portfolios && count($curated_portfolios) > 4 ) : ?>
		<div class="home-portfolio-load-more">
			<button id="home-mobile-load-more" class="action-link mobile-load-more-btn">
				<span class="icon"><svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4551 10L20.5 6.875L17.4551 3.75M20.5 6.875H2.9359C2.28986 6.875 1.67028 6.61161 1.21346 6.14277C0.756638 5.67393 0.5 5.03804 0.5 4.375V0" stroke="currentColor" stroke-linejoin="round"/></svg></span>
				<span class="text-wrapper" data-text="<?php esc_attr_e( 'load more', 'raio-verde' ); ?>">
					<span class="text-original"><?php esc_html_e( 'load more', 'raio-verde' ); ?></span>
				</span>
			</button>
		</div>
		<?php endif; ?>
	</section>



	<!-- Services & CTA Section -->
	<?php
	$cta_hl1 = rv_get_field('cta_headline_1') ?: 'Do you want to';
	$cta_hl2 = rv_get_field('cta_headline_2') ?: 'work with us?';
	$cta_l1_text = rv_get_field('cta_link_1_text') ?: 'view our portfolio';
	$cta_l1_url = rv_get_field('cta_link_1_url') ?: '#portfolio';
	$cta_l2_text = rv_get_field('cta_link_2_text') ?: 'get in touch';
	$cta_l2_url = rv_get_field('cta_link_2_url') ?: '#';
	$service_1_title = rv_get_field('service_1_title');
	$service_1_desc  = rv_get_field('service_1_description');
	$service_2_title = rv_get_field('service_2_title');
	$service_2_desc  = rv_get_field('service_2_description');
	$service_3_title = rv_get_field('service_3_title');
	$service_3_desc  = rv_get_field('service_3_description');
	
	// Create an array of services that actually have content
	$services = [];
	if ($service_1_title || $service_1_desc) $services[] = ['title' => $service_1_title, 'desc' => $service_1_desc];
	if ($service_2_title || $service_2_desc) $services[] = ['title' => $service_2_title, 'desc' => $service_2_desc];
	if ($service_3_title || $service_3_desc) $services[] = ['title' => $service_3_title, 'desc' => $service_3_desc];
	?>
	<section class="services-cta-section" id="services">
		<div class="services-cta-wrapper">
			
			<?php 
			get_template_part( 'template-parts/content', 'cta', array(
				'headline_1'  => $cta_hl1,
				'headline_2'  => $cta_hl2,
				'link_1_text' => $cta_l1_text,
				'link_1_url'  => $cta_l1_url,
				'link_2_text' => $cta_l2_text,
				'link_2_url'  => $cta_l2_url,
			) ); 
			?>

			<div class="cta-services-grid">
				<?php 
				if( !empty($services) ) : 
					foreach( $services as $service ) : 
						?>
						<div class="service-block">
							<h3 class="service-title"><?php echo esc_html($service['title']); ?></h3>
							<p class="service-desc"><?php echo nl2br(esc_html($service['desc'])); ?></p>
						</div>
						<?php 
					endforeach; 
				else : 
					// Fallbacks
					$defaults = ['PHOTOGRAPHY', 'VIDEO', 'ASSISTANCE'];
					$desc = "Sed egestas sapien aliquam ornare viverra, et justo et sed integer ipsum amet ultrices nulla. Lorem ipsum dolor sit amet consectetur, amet consequat aliquet odio mollis non scelerisque.";
					foreach($defaults as $title) :
						?>
						<div class="service-block">
							<h3 class="service-title"><?php echo esc_html($title); ?></h3>
							<p class="service-desc"><?php echo esc_html($desc); ?></p>
						</div>
						<?php
					endforeach;
				endif; 
				?>
			</div>
		</div>
	</section>

	<!-- About Us Section -->
	<?php
	$about_title = rv_get_field('about_title') ?: 'Us';
	$about_text = rv_get_field('about_text') ?: 'Lorem ipsum dolor sit amet consectetur, et lobortis senectus leo quam. Leo nibh elementum egestas lorem non amet bibendum augue, aliquet viverra sed feugiat semper eleifend sagittis sit. Ornare est dictum arcu sapien consectetur non, sit pharetra scelerisque fusce urna purus vestibulum nisi.';
	$about_link_text = rv_get_field('about_link_text') ?: 'learn more';
	$about_link_url = rv_get_field('about_link_url') ?: '#';
	$about_image = rv_get_field('about_image') ?: get_template_directory_uri() . '/assets/images/about-us-fallback.png';
	?>
	<section class="about-us-section" id="about">
		<div class="about-us-wrapper">
			
			<div class="about-us-text">
				<h2 class="about-title"><?php echo str_replace('Us', 'U<span class="serif-italic">s</span>', esc_html($about_title)); ?></h2>
				<p class="about-desc"><?php echo nl2br(esc_html($about_text)); ?></p>
				
				<?php if($about_link_text): ?>
					<a href="<?php echo esc_url($about_link_url); ?>" class="action-link about-link">
						<span class="icon"><svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4551 10L20.5 6.875L17.4551 3.75M20.5 6.875H2.9359C2.28986 6.875 1.67028 6.61161 1.21346 6.14277C0.756638 5.67393 0.5 5.03804 0.5 4.375V0" stroke="currentColor" stroke-linejoin="round"/></svg></span>
						<span class="text-wrapper" data-text="<?php echo esc_attr($about_link_text); ?>">
							<span class="text-original"><?php echo esc_html($about_link_text); ?></span>
						</span>
					</a>
				<?php endif; ?>
			</div>

			<div class="about-us-image">
				<img src="<?php echo esc_url($about_image); ?>" alt="<?php echo esc_attr($about_title); ?>">
			</div>

		</div>
	</section>

</main><!-- #main -->

<?php
get_footer();
