<?php
/**
 * The template for displaying portfolio archives
 */

get_header();
?>

<?php
$current_term_slug = '';
if ( is_tax( 'portfolio_category' ) ) {
	$queried_obj = get_queried_object();
	if ( $queried_obj && ! is_wp_error( $queried_obj ) ) {
		$current_term_slug = $queried_obj->slug;
	}
}
?>

<main id="primary" class="site-main portfolio-archive-main">

	<!-- Filter Menu (Child categories only) -->
	<div class="portfolio-filter-container" data-initial-term="<?php echo esc_attr( $current_term_slug ); ?>">
		<?php
		// Fetch All Categories and filter out top-level parents to get only children
		$all_categories = get_terms( array(
			'taxonomy'   => 'portfolio_category',
			'hide_empty' => false,
		) );
		$child_categories = array();
		if ( ! empty( $all_categories ) && ! is_wp_error( $all_categories ) ) {
			foreach ( $all_categories as $cat ) {
				if ( $cat->parent != 0 ) {
					$child_categories[] = $cat;
				}
			}
		}
		?>

		<ul class="portfolio-filter portfolio-filter-children">
			<li><a href="#" class="filter-link filter-child active" data-filter="all">all</a></li>
			<?php
			if ( ! empty( $child_categories ) ) {
				foreach ( $child_categories as $child ) {
					$parent_term = get_term( $child->parent, 'portfolio_category' );
					$parent_slug = ( $parent_term && ! is_wp_error( $parent_term ) ) ? $parent_term->slug : '';
					echo '<li><a href="#" class="filter-link filter-child" data-filter="' . esc_attr( $child->slug ) . '" data-parent-slug="' . esc_attr( $parent_slug ) . '">' . esc_html( $child->name ) . '</a></li>';
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
					
					// Get post terms for filtering (including parent term slugs)
					$post_terms = get_the_terms( get_the_ID(), 'portfolio_category' );
					$term_slugs = array();
					if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
						foreach ( $post_terms as $term ) {
							$term_slugs[] = $term->slug;
							if ( $term->parent ) {
								$parent_term = get_term( $term->parent, 'portfolio_category' );
								if ( $parent_term && ! is_wp_error( $parent_term ) ) {
									$term_slugs[] = $parent_term->slug;
								}
							}
						}
					}
					$term_slugs = array_unique( $term_slugs );
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

		<!-- Infinite Scroll Sentinel & Loader -->
		<div id="portfolio-infinite-sentinel" class="portfolio-infinite-sentinel <?php echo ($wp_query->max_num_pages <= 1) ? 'is-hidden' : ''; ?>" data-max-pages="<?php echo esc_attr( $wp_query->max_num_pages ); ?>">
			<div class="infinite-loader-dots">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>

		<!-- Hidden Pagination Container for Infinite Scroll -->
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
			<div class="portfolio-pagination" style="display: none;">
				<?php next_posts_link( esc_html__( 'Load More', 'raio-verde' ) ); ?>
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
