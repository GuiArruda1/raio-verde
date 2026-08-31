<?php
/**
 * The template for displaying portfolio archives
 */

get_header();
?>

<main id="primary" class="site-main portfolio-archive-main">

	<!-- Filter Menu -->
	<div class="portfolio-filter-container">
		<ul class="portfolio-filter">
			<li><a href="#" class="filter-link active" data-filter="all">all</a></li>
			<?php
			$categories = get_terms( array(
				'taxonomy'   => 'portfolio_category',
				'hide_empty' => false, // Set to false to see categories even if no posts are assigned yet
			) );

			if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
				foreach ( $categories as $category ) {
					echo '<li><a href="#" class="filter-link" data-filter="' . esc_attr( $category->slug ) . '">' . esc_html( $category->name ) . '</a></li>';
				}
			}
			?>
		</ul>
	</div>

	<!-- Portfolio Grid -->
	<section class="portfolio-archive-section">
		<div class="portfolio-archive-gallery">
			<?php if ( have_posts() ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();
					
					// Get post terms for filtering
					$post_terms = get_the_terms( get_the_ID(), 'portfolio_category' );
					$term_slugs = array();
					if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
						foreach ( $post_terms as $term ) {
							$term_slugs[] = $term->slug;
						}
					}
					$terms_string = implode( ' ', $term_slugs );
					
					$img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					// Fallback if no featured image is set
					if ( ! $img_url ) {
						$img_url = 'https://picsum.photos/seed/' . get_the_ID() . '/800/800';
					}
					?>
					<a href="<?php the_permalink(); ?>" class="portfolio-item action-link-trigger" data-categories="<?php echo esc_attr( $terms_string ); ?>">
						<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>">
						<div class="portfolio-overlay">
							<span class="action-link portfolio-action">
								<span class="icon"><svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4551 10L20.5 6.875L17.4551 3.75M20.5 6.875H2.9359C2.28986 6.875 1.67028 6.61161 1.21346 6.14277C0.756638 5.67393 0.5 5.03804 0.5 4.375V0" stroke="currentColor" stroke-linejoin="round"/></svg></span>
								<span class="text-wrapper" data-text="<?php echo esc_attr( get_the_title() ); ?>">
									<span class="text-original"><?php the_title(); ?></span>
								</span>
							</span>
						</div>
						<div class="portfolio-meta-mobile">
							<strong class="portfolio-title-mobile"><?php the_title(); ?></strong>
							<span class="portfolio-categories-mobile">
								<?php
								if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
									$names = array();
									foreach ( $post_terms as $term ) {
										$names[] = $term->name;
									}
									echo esc_html( implode( ', ', $names ) );
								}
								?>
							</span>
						</div>
					</a>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<!-- Pagination and Load More for Mobile -->
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
			<div class="portfolio-pagination" style="display: none;">
				<?php next_posts_link( esc_html__( 'Load More', 'raio-verde' ) ); ?>
			</div>
			
			<div class="portfolio-load-more-container">
				<button id="mobile-load-more-btn" class="action-link mobile-load-more-btn">
					<span class="icon"><svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4551 10L20.5 6.875L17.4551 3.75M20.5 6.875H2.9359C2.28986 6.875 1.67028 6.61161 1.21346 6.14277C0.756638 5.67393 0.5 5.03804 0.5 4.375V0" stroke="currentColor" stroke-linejoin="round"/></svg></span>
					<span class="text-wrapper" data-text="<?php esc_attr_e( 'load more', 'raio-verde' ); ?>">
						<span class="text-original"><?php esc_html_e( 'load more', 'raio-verde' ); ?></span>
					</span>
				</button>
			</div>
		<?php endif; ?>

	</section>

	<!-- CTA Section -->
	<?php
	// Set default CTA texts matching the mockup
	$cta_hl1 = 'Do you want to';
	$cta_hl2 = 'work with us?';
	$cta_l1_text = 'know more';
	$cta_l1_url = '#';
	$cta_l2_text = 'get in touch';
	$cta_l2_url = '#';
	?>
	<section class="services-cta-section cta-archive-only">
		<div class="services-cta-wrapper cta-archive-wrapper">
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
		</div>
	</section>

</main><!-- #main -->

<?php
get_footer();
