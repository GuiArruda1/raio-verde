<?php
$post_id = 41; // "Made by Sea Demauro"

$fields = [
    'portfolio_top_img_1' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=1200',
    'portfolio_top_img_2' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?w=800',
    'portfolio_top_img_3' => 'https://images.unsplash.com/photo-1499892477393-f675706cbe6e?w=800',
    'portfolio_top_img_4' => 'https://images.unsplash.com/photo-1506012787146-f92b2d7d6d96?w=1200',
    
    'portfolio_subtitle_1' => 'Florence',
    'portfolio_subtitle_2' => 'projects',
    'portfolio_description' => 'This is a beautifully crafted example of the new portfolio layout. We use a variety of asymmetric grids, high-quality imagery, and sophisticated typography to elevate the visual experience.',
    
    'portfolio_meta_1_label' => 'Art Direction',
    'portfolio_meta_1_value' => 'Jane Doe',
    'portfolio_meta_2_label' => 'Set Design',
    'portfolio_meta_2_value' => 'John Smith',
    'portfolio_meta_3_label' => 'Photography',
    'portfolio_meta_3_value' => 'Alice Wonderland',
    'portfolio_meta_4_label' => 'Styling',
    'portfolio_meta_4_value' => 'Bob Builder',
    'portfolio_meta_5_label' => 'Client',
    'portfolio_meta_5_value' => 'Acme Corp',
    'portfolio_meta_6_label' => 'Date',
    'portfolio_meta_6_value' => 'August 2026',
    
    'portfolio_mid_img_1' => 'https://images.unsplash.com/photo-1501602758156-fb91b9201a4e?w=800',
    'portfolio_mid_img_2' => 'https://images.unsplash.com/photo-1547826039-bfc35e0f1ea8?w=800',
    'portfolio_mid_img_3' => 'https://images.unsplash.com/photo-1520698852331-591b656209dc?w=800',
    
    'portfolio_video_thumbnail' => 'https://images.unsplash.com/photo-1478720568477-152d9b164e26?w=1600',
    'portfolio_video_url' => 'https://vimeo.com/76979871',
    
    'portfolio_bts_title_1' => 'Behind',
    'portfolio_bts_title_2' => 'the Scenes',
    'portfolio_bts_description' => 'A glimpse into our creative process, showing how we brought this vision to life through rigorous testing and exploration.',
    'portfolio_bts_img_1' => 'https://images.unsplash.com/photo-1525909002-1b05e0c869d8?w=800',
    'portfolio_bts_img_2' => 'https://images.unsplash.com/photo-1550684848-fac1c5b4e853?w=800',
    'portfolio_bts_img_3' => 'https://images.unsplash.com/photo-1510936111840-65e151ad71bb?w=800',
    'portfolio_bts_img_4' => 'https://images.unsplash.com/photo-1498334906313-6e099a1bd87b?w=800',
];

foreach ($fields as $key => $value) {
    update_field($key, $value, $post_id);
}
echo "Updated post $post_id with dummy content.\n";
