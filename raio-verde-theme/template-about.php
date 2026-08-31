<?php
/**
 * Template Name: About Us
 *
 * @package Raio_Verde
 */

get_header();
?>

<main id="primary" class="site-main about-page-main">

	<!-- Section 1: Hero ("WE'RE RAIOVERDE") -->
	<?php 
	$hero_title_1 = rv_get_field('about_hero_title_line_1') ?: "WE'RE";
	$hero_title_2 = rv_get_field('about_hero_title_line_2') ?: "RAIOVERDE";
	if ( strtoupper( trim( $hero_title_1 ) ) === "WE'RE" || strtoupper( trim( $hero_title_1 ) ) === "WE’RE" ) {
		$hero_title_1 = "WE<em>’RE</em>";
	}
	$hero_desc = rv_get_field('about_hero_description') ?: "We believe everything has its proper value in time.\n\nFor us, contextuality is key. For that reason we work in close partnership with all clients to ensure our photography matches your needs.\n\nOur focus is to capture the essence of a project, the true atmosphere of a building, or the design of a space. We approach all commissions with the same philosophy and dedication.";
	$hero_img = rv_get_field('about_hero_image') ?: 'https://picsum.photos/seed/raioverde_team/800/1000';
	?>
	<section class="about-hero-section">
		<div class="about-hero-wrapper">
			<div class="about-hero-content">
				<h1 class="about-hero-title">
					<span class="title-line-1"><?php echo $hero_title_1; // Allows HTML like em/span ?></span>
					<span class="title-line-2"><?php echo esc_html($hero_title_2); ?></span>
				</h1>
				<div class="about-hero-text">
					<?php echo wpautop(esc_html($hero_desc)); ?>
				</div>
			</div>
			<div class="about-hero-media">
				<img src="<?php echo esc_url($hero_img); ?>" alt="<?php echo esc_attr($hero_title_2); ?>" class="about-hero-img">
			</div>
		</div>
	</section>

	<!-- Section 2: What ("What? Bespoke Photography & Video") -->
	<?php 
	$what_subtitle = rv_get_field('about_what_subtitle') ?: "What?";
	$what_title = rv_get_field('about_what_title') ?: "Bespoke Photography & Video";
	$what_desc = rv_get_field('about_what_description') ?: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
	?>
	<section class="about-what-section">
		<div class="about-what-wrapper">
			<div class="about-what-content">
				<span class="about-what-subtitle"><?php echo esc_html($what_subtitle); ?></span>
				<h2 class="about-what-title serif-italic"><?php echo esc_html($what_title); ?></h2>
				<p class="about-what-text"><?php echo esc_html($what_desc); ?></p>
			</div>
		</div>
	</section>

	<!-- Section 3: Separator (Full Bleed Image) -->
	<?php 
	$sep_img = rv_get_field('about_separator_image') ?: 'https://picsum.photos/seed/raioverde_sep/1920/1080';
	?>
	<section class="about-separator-section">
		<div class="about-separator-wrapper">
			<img src="<?php echo esc_url($sep_img); ?>" alt="Raioverde Studio Separator" class="about-separator-img">
		</div>
	</section>

	<!-- Section 4: How ("How? It works") -->
	<?php 
	$how_subtitle = rv_get_field('about_how_subtitle') ?: "How?";
	$how_title = rv_get_field('about_how_title') ?: "It works";
	$how_desc = rv_get_field('about_how_description') ?: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.";
	?>
	<section class="about-how-section">
		<div class="about-how-wrapper">
			<div class="about-how-left">
				<h2 class="about-how-heading">
					<span class="how-sub"><?php echo esc_html($how_subtitle); ?></span>
					<span class="how-title serif-italic"><?php echo esc_html($how_title); ?></span>
				</h2>
			</div>
			<div class="about-how-right">
				<div class="about-how-text">
					<?php echo wpautop(esc_html($how_desc)); ?>
				</div>
			</div>
		</div>
	</section>

	<!-- Section 5: Projects ("Projects - All are Unique") -->
	<?php 
	$projects_img = rv_get_field('about_projects_image') ?: 'https://picsum.photos/seed/raioverde_projects/800/1000';
	$projects_title_1 = rv_get_field('about_projects_title_line_1') ?: "Projects";
	$projects_title_2 = rv_get_field('about_projects_title_line_2') ?: "All are Unique";
	$projects_desc = rv_get_field('about_projects_description') ?: "We work closely with clients to understand their needs and expectations, developing a visual narrative that reflects the essence and identity of each project.\n\nOur portfolio showcases a selection of projects across architecture, interior design, and lifestyle photography.\n\nEach project represents a unique collaboration, combining our technical expertise with the client's creative vision to produce images that inspire and engage.";
	?>
	<section class="about-projects-section">
		<div class="about-projects-wrapper">
			<div class="about-projects-media">
				<img src="<?php echo esc_url($projects_img); ?>" alt="Raioverde Projects" class="about-projects-img">
			</div>
			<div class="about-projects-content">
				<h2 class="about-projects-title">
					<span class="title-line-1"><?php echo esc_html($projects_title_1); ?></span>
					<span class="title-line-2 serif-italic"><?php echo esc_html($projects_title_2); ?></span>
				</h2>
				<div class="about-projects-text">
					<?php echo wpautop(esc_html($projects_desc)); ?>
				</div>
			</div>
		</div>
	</section>

	<!-- Section 6: The Bond ("The bond creativity & tecnicity") -->
	<?php 
	$bond_title_1 = rv_get_field('about_bond_title_line_1') ?: "The bond";
	$bond_title_2 = rv_get_field('about_bond_title_line_2') ?: "creativity & tecnicity";
	$bond_desc = rv_get_field('about_bond_description') ?: "We combine technical precision with creative vision to produce images that are both visually striking and technically flawless. Our approach is collaborative and detailed, ensuring every aspect of the project is captured with care.\n\nFrom initial concept to final post-production, we work to maintain the highest standards of quality and service, delivering images that exceed expectations.";
	?>
	<section class="about-bond-section">
		<div class="about-bond-wrapper">
			<h2 class="about-bond-heading">
				<span class="bond-title-1"><?php echo esc_html($bond_title_1); ?></span>
				<span class="bond-title-2 serif-italic"><?php echo esc_html($bond_title_2); ?></span>
			</h2>
			<div class="about-bond-text">
				<?php echo wpautop(esc_html($bond_desc)); ?>
			</div>
		</div>
	</section>

	<!-- Section 7: CTA ("Do you want to work with us?") -->
	<?php 
	$cta_hl1 = rv_get_field('about_cta_headline_1') ?: "Do you want to";
	$cta_hl2 = rv_get_field('about_cta_headline_2') ?: "work with us?";
	$cta_link_1_text = rv_get_field('about_cta_link_1_text') ?: "view our portfolio";
	$cta_link_1_url = rv_get_field('about_cta_link_1_url') ?: home_url('/portfolio/');
	$cta_link_2_text = rv_get_field('about_cta_link_2_text') ?: "get in touch";
	$cta_link_2_url = rv_get_field('about_cta_link_2_url') ?: home_url('/contact/');
	?>
	<section class="services-cta-section about-cta-section">
		<div class="services-cta-wrapper about-cta-wrapper">
			<?php 
			get_template_part( 'template-parts/content', 'cta', array(
				'headline_1'  => $cta_hl1,
				'headline_2'  => $cta_hl2,
				'link_1_text' => $cta_link_1_text,
				'link_1_url'  => $cta_link_1_url,
				'link_2_text' => $cta_link_2_text,
				'link_2_url'  => $cta_link_2_url,
			) ); 
			?>
		</div>
	</section>

</main><!-- #main -->

<?php
get_footer();
