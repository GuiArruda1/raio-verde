<?php
/**
 * Helper script to create / populate a dummy Portfolio item with the Horizontal Images Gallery (2x2 Grid) layout.
 * 
 * You can execute this by opening it directly in your browser:
 * e.g., http://localhost/raio-verde/wp-content/themes/raio-verde-theme/populate-dummy-horizontal.php
 * or http://raio-verde.local/wp-content/themes/raio-verde-theme/populate-dummy-horizontal.php
 */

header('Content-Type: text/plain; charset=utf-8');

echo "=========================================================\n";
echo "   RAIO VERDE - POPULATE HORIZONTAL GALLERY DUMMY ITEM   \n";
echo "=========================================================\n\n";

// 1. Locate and load wp-load.php dynamically
$wp_load_path = '';
$dir = dirname(__FILE__);

while ($dir && $dir !== '/' && $dir !== '\\') {
    if (file_exists($dir . '/wp-load.php')) {
        $wp_load_path = $dir . '/wp-load.php';
        break;
    }
    $parent = dirname($dir);
    if ($parent === $dir) break;
    $dir = $parent;
}

if (!empty($wp_load_path)) {
    echo "Found wp-load.php at: " . realpath($wp_load_path) . "\n";
    require_once($wp_load_path);
    echo "WordPress loaded successfully!\n\n";
} else {
    die("ERROR: Could not locate wp-load.php automatically.\nPlease access this script via your local web browser URL.\n");
}

// 2. Create or Find Portfolio Post
$post_title = 'Florence (Horizontal Gallery)';
$existing_post = get_page_by_title( $post_title, OBJECT, 'portfolio' );

if ( $existing_post ) {
    $post_id = $existing_post->ID;
    echo "Found existing portfolio post (ID: {$post_id})\n";
} else {
    $post_id = wp_insert_post( [
        'post_title'   => $post_title,
        'post_type'    => 'portfolio',
        'post_status'  => 'publish',
        'post_content' => '',
    ] );
    echo "Created new portfolio post (ID: {$post_id})\n";
}

if ( ! $post_id || is_wp_error( $post_id ) ) {
    die("ERROR: Failed to create or retrieve post.\n");
}

// 3. Populate ACF Fields for Horizontal Layout (2x2 Grid)
$horizontal_dummy_fields = [
    'portfolio_layout_type'       => 'horizontal',
    
    // Top Hero (4 Horizontal Images in 2x2 Grid)
    'portfolio_top_img_1'         => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=1200',
    'portfolio_top_img_2'         => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?w=1200',
    'portfolio_top_img_3'         => 'https://images.unsplash.com/photo-1499892477393-f675706cbe6e?w=1200',
    'portfolio_top_img_4'         => 'https://images.unsplash.com/photo-1506012787146-f92b2d7d6d96?w=1200',
    
    // Project Info
    'portfolio_subtitle_1'        => 'Um Subtítulo',
    'portfolio_subtitle_2'        => 'de exemplo',
    'portfolio_description'       => 'Este é um projeto em formato horizontal images gallery com grelha 2x2 panorâmica, módulo intermediário de duas colunas largas e integração com vídeo.',
    
    // Credits
    'portfolio_credit_1_role'     => 'Art Direction',
    'portfolio_credit_1_name'     => 'Jane Doe',
    'portfolio_credit_2_role'     => 'Set Design',
    'portfolio_credit_2_name'     => 'John Smith',
    'portfolio_credit_3_role'     => 'Photography',
    'portfolio_credit_3_name'     => 'Alice Wonderland',
    'portfolio_credit_4_role'     => 'Styling',
    'portfolio_credit_4_name'     => 'Bob Builder',
    'portfolio_credit_5_role'     => 'Client',
    'portfolio_credit_5_name'     => 'Florence Studio',
    'portfolio_credit_6_role'     => 'Date',
    'portfolio_credit_6_name'     => 'August 2026',
    
    // Middle 2 Images + Video
    'portfolio_mid_img_1'         => 'https://images.unsplash.com/photo-1501602758156-fb91b9201a4e?w=1200',
    'portfolio_mid_img_2'         => 'https://images.unsplash.com/photo-1547826039-bfc35e0f1ea8?w=1200',
    'portfolio_video_thumbnail'   => 'https://images.unsplash.com/photo-1478720568477-152d9b164e26?w=1600',
    'portfolio_video_url'         => 'https://vimeo.com/76979871',
    
    // Behind the Scenes
    'portfolio_bts_title_1'       => 'Behind',
    'portfolio_bts_title_2'       => 'the Scenes',
    'portfolio_bts_description'   => 'A glimpse into our creative process, showing how we brought this vision to life through rigorous testing and exploration.',
    'portfolio_bts_img_1'         => 'https://images.unsplash.com/photo-1525909002-1b05e0c869d8?w=800',
    'portfolio_bts_img_2'         => 'https://images.unsplash.com/photo-1550684848-fac1c5b4e853?w=800',
    'portfolio_bts_img_3'         => 'https://images.unsplash.com/photo-1510936111840-65e151ad71bb?w=800',
    'portfolio_bts_img_4'         => 'https://images.unsplash.com/photo-1498334906313-6e099a1bd87b?w=800',
];

foreach ( $horizontal_dummy_fields as $key => $value ) {
    if ( function_exists( 'update_field' ) ) {
        update_field( $key, $value, $post_id );
    } else {
        update_post_meta( $post_id, $key, $value );
    }
}

echo "✓ Successfully set all ACF fields for Horizontal Gallery on Post ID: {$post_id}\n";
echo "✓ Post URL: " . get_permalink( $post_id ) . "\n\n";
echo "DONE!\n";
