<?php
add_action('acf/init', function () {
	if (function_exists('acf_add_local_field_group')):

		acf_add_local_field_group(array(
			'key' => 'group_hero_section',
			'title' => 'Hero Section',
			'fields' => array(
				array(
					'key' => 'field_hero_headline_primary',
					'label' => 'Headline (Primary)',
					'name' => 'hero_headline_primary',
					'type' => 'text',
					'instructions' => 'The first part of the title (e.g. "bespoke"). Uses the sans-serif font.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'default_value' => 'bespoke',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_hero_headline_secondary',
					'label' => 'Headline (Secondary)',
					'name' => 'hero_headline_secondary',
					'type' => 'text',
					'instructions' => 'The second part of the title (e.g. "photo & video"). Uses the serif italic font.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'default_value' => 'photo & video',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_hero_background_image',
					'label' => 'Background Image',
					'name' => 'hero_background_image',
					'type' => 'image',
					'instructions' => 'The large background image for the top of the site.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',
					'preview_size' => 'medium',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
				array(
					'key' => 'field_hero_background_video',
					'label' => 'Background Video (Optional)',
					'name' => 'hero_background_video',
					'type' => 'file',
					'instructions' => 'Upload a short, silent looping video (mp4 format) to use as the background instead of an image. Note: For mobile optimization, this should ideally be under 5MB.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',
					'library' => 'all',
					'min_size' => '',
					'max_size' => '20', // Limit to 20MB
					'mime_types' => 'mp4, webm',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'page_type',
						'operator' => '==',
						'value' => 'front_page',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));

		acf_add_local_field_group(array(
			'key' => 'group_statement_section',
			'title' => 'Statement Section',
			'fields' => array(
				array(
					'key' => 'field_statement_primary',
					'label' => 'Primary Text',
					'name' => 'statement_primary',
					'type' => 'text',
					'default_value' => 'we create the atmosphere',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_statement_secondary',
					'label' => 'Secondary Text (Italic)',
					'name' => 'statement_secondary',
					'type' => 'text',
					'default_value' => 'that your project demands',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_statement_link_text',
					'label' => 'Link Text',
					'name' => 'statement_link_text',
					'type' => 'text',
					'default_value' => 'how we do it?',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_statement_link_url',
					'label' => 'Link URL',
					'name' => 'statement_link_url',
					'type' => 'url',
					'default_value' => '#',
					'wrapper' => array('width' => '50'),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'page_type',
						'operator' => '==',
						'value' => 'front_page',
					),
				),
			),
		));
		acf_add_local_field_group(array(
			'key' => 'group_front_portfolio',
			'title' => 'Home Page Gallery',
			'fields' => array(
				array(
					'key' => 'field_front_portfolio_gallery',
					'label' => 'Curated Portfolio Gallery',
					'name' => 'front_portfolio_gallery',
					'type' => 'relationship',
					'instructions' => 'Select exactly 10 portfolio items and drag them to order them. The 5th and 10th items will automatically span the full width of the grid.',
					'post_type' => array('portfolio'),
					'filters' => array('search'),
					'max' => 10, // Enforce strict limit in back-office
					'return_format' => 'object', // Returns WP_Post objects
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'page_type',
						'operator' => '==',
						'value' => 'front_page',
					),
				),
			),
		));

		acf_add_local_field_group(array(
			'key' => 'group_services_cta_section',
			'title' => 'Services & CTA Section',
			'fields' => array(
				array(
					'key' => 'field_cta_headline_1',
					'label' => 'Headline 1 (Left)',
					'name' => 'cta_headline_1',
					'type' => 'text',
					'default_value' => 'Do you want to',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_cta_link_1_text',
					'label' => 'Link 1 Text (Right)',
					'name' => 'cta_link_1_text',
					'type' => 'text',
					'default_value' => 'view our portfolio',
					'wrapper' => array('width' => '25'),
				),
				array(
					'key' => 'field_cta_link_1_url',
					'label' => 'Link 1 URL',
					'name' => 'cta_link_1_url',
					'type' => 'text',
					'default_value' => '',
					'wrapper' => array('width' => '25'),
				),
				array(
					'key' => 'field_cta_headline_2',
					'label' => 'Headline 2 (Right)',
					'name' => 'cta_headline_2',
					'type' => 'text',
					'default_value' => 'work with us?',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_cta_link_2_text',
					'label' => 'Link 2 Text (Left)',
					'name' => 'cta_link_2_text',
					'type' => 'text',
					'default_value' => 'get in touch',
					'wrapper' => array('width' => '25'),
				),
				array(
					'key' => 'field_cta_link_2_url',
					'label' => 'Link 2 URL',
					'name' => 'cta_link_2_url',
					'type' => 'url',
					'default_value' => '#',
					'wrapper' => array('width' => '25'),
				),
				array(
					'key' => 'field_service_1_title',
					'label' => 'Service 1 Title',
					'name' => 'service_1_title',
					'type' => 'text',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_service_1_description',
					'label' => 'Service 1 Description',
					'name' => 'service_1_description',
					'type' => 'textarea',
					'rows' => 3,
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_service_2_title',
					'label' => 'Service 2 Title',
					'name' => 'service_2_title',
					'type' => 'text',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_service_2_description',
					'label' => 'Service 2 Description',
					'name' => 'service_2_description',
					'type' => 'textarea',
					'rows' => 3,
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_service_3_title',
					'label' => 'Service 3 Title',
					'name' => 'service_3_title',
					'type' => 'text',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_service_3_description',
					'label' => 'Service 3 Description',
					'name' => 'service_3_description',
					'type' => 'textarea',
					'rows' => 3,
					'wrapper' => array('width' => '50'),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'page_type',
						'operator' => '==',
						'value' => 'front_page',
					),
				),
			),
		));

		acf_add_local_field_group(array(
			'key' => 'group_about_us_section',
			'title' => 'About Us Section',
			'fields' => array(
				array(
					'key' => 'field_about_title',
					'label' => 'Section Title',
					'name' => 'about_title',
					'type' => 'text',
					'default_value' => 'Us',
					'wrapper' => array('width' => '100'),
				),
				array(
					'key' => 'field_about_text',
					'label' => 'About Text',
					'name' => 'about_text',
					'type' => 'textarea',
					'rows' => 5,
					'default_value' => 'Lorem ipsum dolor sit amet consectetur, et lobortis senectus leo quam. Leo nibh elementum egestas lorem non amet bibendum augue, aliquet viverra sed feugiat semper eleifend sagittis sit. Ornare est dictum arcu sapien consectetur non, sit pharetra scelerisque fusce urna purus vestibulum nisi.',
					'wrapper' => array('width' => '100'),
				),
				array(
					'key' => 'field_about_link_text',
					'label' => 'Link Text',
					'name' => 'about_link_text',
					'type' => 'text',
					'default_value' => 'learn more',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_about_link_url',
					'label' => 'Link URL',
					'name' => 'about_link_url',
					'type' => 'text',
					'default_value' => '',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_about_image',
					'label' => 'About Image',
					'name' => 'about_image',
					'type' => 'image',
					'return_format' => 'url',
					'preview_size' => 'medium',
					'wrapper' => array('width' => '100'),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'page_type',
						'operator' => '==',
						'value' => 'front_page',
					),
				),
			),
		));

		acf_add_local_field_group(array(
			'key' => 'group_about_page',
			'title' => 'About Page Content',
			'fields' => array(
				// Hero
				array(
					'key' => 'field_about_hero_tab',
					'label' => 'Hero Section',
					'type' => 'tab',
				),
				array(
					'key' => 'field_about_hero_title_line_1',
					'label' => 'Title Line 1',
					'name' => 'about_hero_title_line_1',
					'type' => 'text',
					'default_value' => 'WE\'RE',
				),
				array(
					'key' => 'field_about_hero_title_line_2',
					'label' => 'Title Line 2',
					'name' => 'about_hero_title_line_2',
					'type' => 'text',
					'default_value' => 'RAIOVERDE',
				),
				array(
					'key' => 'field_about_hero_description',
					'label' => 'Description',
					'name' => 'about_hero_description',
					'type' => 'textarea',
					'default_value' => "We believe everything has its proper value in time.\n\nFor us, contextuality is key. For that reason we work in close partnership with all clients to ensure our photography matches your needs.\n\nOur focus is to capture the essence of a project, the true atmosphere of a building, or the design of a space. We approach all commissions with the same philosophy and dedication.",
				),
				array(
					'key' => 'field_about_hero_image',
					'label' => 'Hero Portrait Image',
					'name' => 'about_hero_image',
					'type' => 'image',
					'return_format' => 'url',
				),
				// What
				array(
					'key' => 'field_about_what_tab',
					'label' => 'What Section',
					'type' => 'tab',
				),
				array(
					'key' => 'field_about_what_subtitle',
					'label' => 'Subtitle',
					'name' => 'about_what_subtitle',
					'type' => 'text',
					'default_value' => 'What?',
				),
				array(
					'key' => 'field_about_what_title',
					'label' => 'Title',
					'name' => 'about_what_title',
					'type' => 'text',
					'default_value' => 'Bespoke Photography & Video',
				),
				array(
					'key' => 'field_about_what_description',
					'label' => 'Description',
					'name' => 'about_what_description',
					'type' => 'textarea',
					'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
				),
				// Separator
				array(
					'key' => 'field_about_separator_tab',
					'label' => 'Separator Section',
					'type' => 'tab',
				),
				array(
					'key' => 'field_about_separator_image',
					'label' => 'Separator Image (Full Bleed)',
					'name' => 'about_separator_image',
					'type' => 'image',
					'return_format' => 'url',
				),
				// How
				array(
					'key' => 'field_about_how_tab',
					'label' => 'How Section',
					'type' => 'tab',
				),
				array(
					'key' => 'field_about_how_subtitle',
					'label' => 'Subtitle',
					'name' => 'about_how_subtitle',
					'type' => 'text',
					'default_value' => 'How?',
				),
				array(
					'key' => 'field_about_how_title',
					'label' => 'Title',
					'name' => 'about_how_title',
					'type' => 'text',
					'default_value' => 'It works',
				),
				array(
					'key' => 'field_about_how_description',
					'label' => 'Description',
					'name' => 'about_how_description',
					'type' => 'textarea',
					'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
				),
				// Projects
				array(
					'key' => 'field_about_projects_tab',
					'label' => 'Projects Section',
					'type' => 'tab',
				),
				array(
					'key' => 'field_about_projects_image',
					'label' => 'Projects Image',
					'name' => 'about_projects_image',
					'type' => 'image',
					'return_format' => 'url',
				),
				array(
					'key' => 'field_about_projects_title_line_1',
					'label' => 'Title Line 1',
					'name' => 'about_projects_title_line_1',
					'type' => 'text',
					'default_value' => 'Projects',
				),
				array(
					'key' => 'field_about_projects_title_line_2',
					'label' => 'Title Line 2',
					'name' => 'about_projects_title_line_2',
					'type' => 'text',
					'default_value' => 'All are Unique',
				),
				array(
					'key' => 'field_about_projects_description',
					'label' => 'Description',
					'name' => 'about_projects_description',
					'type' => 'textarea',
					'default_value' => "We work closely with clients to understand their needs and expectations, developing a visual narrative that reflects the essence and identity of each project.\n\nOur portfolio showcases a selection of projects across architecture, interior design, and lifestyle photography.\n\nEach project represents a unique collaboration, combining our technical expertise with the client's creative vision to produce images that inspire and engage.",
				),
				// Bond
				array(
					'key' => 'field_about_bond_tab',
					'label' => 'The Bond Section',
					'type' => 'tab',
				),
				array(
					'key' => 'field_about_bond_title_line_1',
					'label' => 'Title Line 1',
					'name' => 'about_bond_title_line_1',
					'type' => 'text',
					'default_value' => 'The bond',
				),
				array(
					'key' => 'field_about_bond_title_line_2',
					'label' => 'Title Line 2',
					'name' => 'about_bond_title_line_2',
					'type' => 'text',
					'default_value' => 'creativity & tecnicity',
				),
				array(
					'key' => 'field_about_bond_description',
					'label' => 'Description',
					'name' => 'about_bond_description',
					'type' => 'textarea',
					'default_value' => "We combine technical precision with creative vision to produce images that are both visually striking and technically flawless. Our approach is collaborative and detailed, ensuring every aspect of the project is captured with care.\n\nFrom initial concept to final post-production, we work to maintain the highest standards of quality and service, delivering images that exceed expectations.",
				),
				// CTA
				array(
					'key' => 'field_about_cta_tab',
					'label' => 'CTA Section',
					'type' => 'tab',
				),
				array(
					'key' => 'field_about_cta_headline_1',
					'label' => 'Headline 1',
					'name' => 'about_cta_headline_1',
					'type' => 'text',
					'default_value' => 'Do you want to',
				),
				array(
					'key' => 'field_about_cta_headline_2',
					'label' => 'Headline 2',
					'name' => 'about_cta_headline_2',
					'type' => 'text',
					'default_value' => 'work with us?',
				),
				array(
					'key' => 'field_about_cta_link_1_text',
					'label' => 'Link 1 Text',
					'name' => 'about_cta_link_1_text',
					'type' => 'text',
					'default_value' => 'view our portfolio',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_about_cta_link_1_url',
					'label' => 'Link 1 URL',
					'name' => 'about_cta_link_1_url',
					'type' => 'text',
					'default_value' => '',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_about_cta_link_2_text',
					'label' => 'Link 2 Text',
					'name' => 'about_cta_link_2_text',
					'type' => 'text',
					'default_value' => 'get in touch',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_about_cta_link_2_url',
					'label' => 'Link 2 URL',
					'name' => 'about_cta_link_2_url',
					'type' => 'text',
					'default_value' => '',
					'wrapper' => array('width' => '50'),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'page_template',
						'operator' => '==',
						'value' => 'template-about.php',
					),
				),
			),
		));

		acf_add_local_field_group(array(
			'key' => 'group_contact_page',
			'title' => 'Contact Page Content',
			'fields' => array(
				// Main content
				array(
					'key' => 'field_contact_content_tab',
					'label' => 'Content',
					'type' => 'tab',
				),
				array(
					'key' => 'field_contact_title_line_1',
					'label' => 'Title Line 1',
					'name' => 'contact_title_line_1',
					'type' => 'text',
					'default_value' => 'Do you want to',
				),
				array(
					'key' => 'field_contact_title_line_2',
					'label' => 'Title Line 2',
					'name' => 'contact_title_line_2',
					'type' => 'text',
					'default_value' => 'work with us?',
				),
				array(
					'key' => 'field_contact_description',
					'label' => 'Description Paragraph',
					'name' => 'contact_description',
					'type' => 'textarea',
					'default_value' => 'Ornare dictum arcus sapien consectetur non, sit pharetra ut scelerisque fusces urna purus vestibulum nisi lorem ipsum.',
				),
				// Contact details
				array(
					'key' => 'field_contact_details_tab',
					'label' => 'Contact Info & Links',
					'type' => 'tab',
				),
				array(
					'key' => 'field_contact_email',
					'label' => 'Email Address',
					'name' => 'contact_email',
					'type' => 'text',
					'default_value' => 'hello@raioverde.pt',
					'wrapper' => array('width' => '33'),
				),
				array(
					'key' => 'field_contact_phone',
					'label' => 'Phone Number',
					'name' => 'contact_phone',
					'type' => 'text',
					'default_value' => '(+351) 931 784 271',
					'wrapper' => array('width' => '33'),
				),
				array(
					'key' => 'field_contact_phone_2',
					'label' => 'Phone 2 (Optional)',
					'name' => 'contact_phone_2',
					'type' => 'text',
					'default_value' => '',
					'wrapper' => array('width' => '33'),
				),
				array(
					'key' => 'field_contact_instagram_label',
					'label' => 'Instagram Label',
					'name' => 'contact_instagram_label',
					'type' => 'text',
					'default_value' => 'instagram',
					'wrapper' => array('width' => '16'),
				),
				array(
					'key' => 'field_contact_instagram_url',
					'label' => 'Instagram Link URL',
					'name' => 'contact_instagram_url',
					'type' => 'text',
					'default_value' => '',
					'wrapper' => array('width' => '17'),
				),
				// Form Settings & Visuals
				array(
					'key' => 'field_contact_settings_tab',
					'label' => 'Media & Notifications',
					'type' => 'tab',
				),
				array(
					'key' => 'field_contact_image',
					'label' => 'Tall Panel Image',
					'name' => 'contact_image',
					'type' => 'image',
					'return_format' => 'url',
					'instructions' => 'The large vertical image displayed on the right-hand panel of the contact screen.',
				),
				array(
					'key' => 'field_contact_notification_email',
					'label' => 'Notification Recipient Email',
					'name' => 'contact_notification_email',
					'type' => 'email',
					'instructions' => 'Form entries will be mailed to this address. If left blank, submissions will go to the WordPress administrator email.',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'page_template',
						'operator' => '==',
						'value' => 'template-contact.php',
					),
				),
			),
		));

		acf_add_local_field_group(array(
			'key' => 'group_footer_settings',
			'title' => 'Global Footer Settings',
			'fields' => array(
				// Big Links
				array(
					'key' => 'field_footer_big_links_tab',
					'label' => 'Footer Big Links',
					'type' => 'tab',
				),
				array(
					'key' => 'field_footer_link_1_text',
					'label' => 'Link 1 Text',
					'name' => 'footer_link_1_text',
					'type' => 'text',
					'default_value' => 'portfolio',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_footer_link_1_url',
					'label' => 'Link 1 URL',
					'name' => 'footer_link_1_url',
					'type' => 'url',
					'default_value' => '/portfolio/',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_footer_link_2_text',
					'label' => 'Link 2 Text',
					'name' => 'footer_link_2_text',
					'type' => 'text',
					'default_value' => 'about',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_footer_link_2_url',
					'label' => 'Link 2 URL',
					'name' => 'footer_link_2_url',
					'type' => 'url',
					'default_value' => '/about/',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_footer_link_3_text',
					'label' => 'Link 3 Text',
					'name' => 'footer_link_3_text',
					'type' => 'text',
					'default_value' => 'contact',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_footer_link_3_url',
					'label' => 'Link 3 URL',
					'name' => 'footer_link_3_url',
					'type' => 'url',
					'default_value' => '/contact/',
					'wrapper' => array('width' => '50'),
				),
				// Contact details
				array(
					'key' => 'field_footer_contact_tab',
					'label' => 'Contact Info',
					'type' => 'tab',
				),
				array(
					'key' => 'field_footer_email',
					'label' => 'Footer Email',
					'name' => 'footer_email',
					'type' => 'text',
					'default_value' => 'hello@raioverde.pt',
					'wrapper' => array('width' => '33'),
				),
				array(
					'key' => 'field_footer_instagram_url',
					'label' => 'Footer Instagram URL',
					'name' => 'footer_instagram_url',
					'type' => 'text',
					'default_value' => '#',
					'wrapper' => array('width' => '33'),
				),
				array(
					'key' => 'field_footer_location_text',
					'label' => 'Footer Location Text',
					'name' => 'footer_location_text',
					'type' => 'text',
					'default_value' => 'Porto, Portugal, Anywhere',
					'wrapper' => array('width' => '34'),
				),
				array(
					'key' => 'field_footer_location_url',
					'label' => 'Footer Location URL (Google Maps)',
					'name' => 'footer_location_url',
					'type' => 'text',
					'default_value' => '#',
					'instructions' => 'Clicking the location text in the footer will open this link in a new tab.',
				),
				// Institutional info
				array(
					'key' => 'field_footer_institutional_tab',
					'label' => 'Institutional / PRR Support',
					'type' => 'tab',
				),
				array(
					'key' => 'field_footer_institutional_text',
					'label' => 'Institutional text',
					'name' => 'footer_institutional_text',
					'type' => 'textarea',
					'rows' => 3,
					'default_value' => 'A Duarte Costa & Liliana Mendes, Lda é apoiada pelo Plano de Recuperação e Resiliência (PRR), ao abrigo do programa Coaching 4.0, inserido na Componente 16 — Empresas 4.0',
				),
				array(
					'key' => 'field_footer_institutional_logo',
					'label' => 'Institutional Logo (PRR/EU)',
					'name' => 'footer_institutional_logo',
					'type' => 'image',
					'return_format' => 'url',
					'instructions' => 'Upload the PRR/EU logo image to display on the bottom right. If empty, the default image from the theme folder will be displayed.',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'page_type',
						'operator' => '==',
						'value' => 'front_page',
					),
				),
			),
		));

		acf_add_local_field_group(array(
			'key' => 'group_portfolio_single',
			'title' => 'Portfolio Template Fields',
			'fields' => array(
				// Global Layout Style Selector (appears above tabs)
				array(
					'key' => 'field_portfolio_layout_type',
					'label' => 'Portfolio Layout Style',
					'name' => 'portfolio_layout_type',
					'type' => 'select',
					'instructions' => 'Choose the visual grid / template style for this portfolio project.',
					'choices' => array(
						'standard' => 'Standard (Asymmetric Collage)',
						'video' => 'Video Showcase',
						'vertical' => 'Vertical Gallery (3x2 Grid)',
						'horizontal' => 'Horizontal Gallery (2x2 Grid)',
					),
					'default_value' => 'standard',
					'return_format' => 'value',
					'wrapper' => array('width' => '100'),
				),

				// Tab 1: Top Hero
				array(
					'key' => 'field_portfolio_top_grid_tab',
					'label' => 'Top Hero',
					'type' => 'tab',
				),
				// Top Images (For Standard / Horizontal)
				array(
					'key' => 'field_portfolio_top_img_1',
					'label' => 'Image 1 (Row 1, spans 2 cols / Top-Left)',
					'name' => 'portfolio_top_img_1',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'standard',
							),
						),
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'horizontal',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_top_img_2',
					'label' => 'Image 2 (Row 1, spans 1 col / Top-Right)',
					'name' => 'portfolio_top_img_2',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'standard',
							),
						),
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'horizontal',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_top_img_3',
					'label' => 'Image 3 (Row 2, spans 1 col / Bottom-Left)',
					'name' => 'portfolio_top_img_3',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'standard',
							),
						),
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'horizontal',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_top_img_4',
					'label' => 'Image 4 (Row 2, spans 2 cols / Bottom-Right)',
					'name' => 'portfolio_top_img_4',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'standard',
							),
						),
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'horizontal',
							),
						),
					),
				),

				// Vertical Gallery 6 Images (For Vertical Layout)
				array(
					'key' => 'field_portfolio_vert_img_1',
					'label' => 'Vertical Image 1 (Row 1, Col 1)',
					'name' => 'portfolio_vert_img_1',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '33'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'vertical',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_vert_img_2',
					'label' => 'Vertical Image 2 (Row 1, Col 2)',
					'name' => 'portfolio_vert_img_2',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '33'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'vertical',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_vert_img_3',
					'label' => 'Vertical Image 3 (Row 1, Col 3)',
					'name' => 'portfolio_vert_img_3',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '33'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'vertical',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_vert_img_4',
					'label' => 'Vertical Image 4 (Row 2, Col 1)',
					'name' => 'portfolio_vert_img_4',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '33'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'vertical',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_vert_img_5',
					'label' => 'Vertical Image 5 (Row 2, Col 2)',
					'name' => 'portfolio_vert_img_5',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '33'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'vertical',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_vert_img_6',
					'label' => 'Vertical Image 6 (Row 2, Col 3)',
					'name' => 'portfolio_vert_img_6',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '33'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'vertical',
							),
						),
					),
				),
				// Top Hero Video (For Video Showcase layout)
				array(
					'key' => 'field_portfolio_hero_vid_thumb',
					'label' => 'Hero Video Thumbnail',
					'name' => 'portfolio_hero_video_thumbnail',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'video',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_hero_vid_url',
					'label' => 'Hero Video URL (YouTube / Vimeo / Direct)',
					'name' => 'portfolio_hero_video_url',
					'type' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'video',
							),
						),
					),
				),

				// Tab 2: Info & Metadata
				array(
					'key' => 'field_portfolio_info_tab',
					'label' => 'Project Info',
					'type' => 'tab',
				),
				array(
					'key' => 'field_portfolio_subtitle_1',
					'label' => 'Subtitle (Regular)',
					'name' => 'portfolio_subtitle_1',
					'type' => 'text',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_portfolio_subtitle_2',
					'label' => 'Subtitle (Italic)',
					'name' => 'portfolio_subtitle_2',
					'type' => 'text',
					'wrapper' => array('width' => '50'),
				),
				array(
					'key' => 'field_portfolio_description',
					'label' => 'Description',
					'name' => 'portfolio_description',
					'type' => 'textarea',
				),
				// Metadata Pairs (Static 6 pairs)
				array('key' => 'field_portfolio_credit_1_role', 'label' => 'Role 1', 'name' => 'portfolio_credit_1_role', 'type' => 'text', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_credit_1_name', 'label' => 'Name 1', 'name' => 'portfolio_credit_1_name', 'type' => 'text', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_credit_2_role', 'label' => 'Role 2', 'name' => 'portfolio_credit_2_role', 'type' => 'text', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_credit_2_name', 'label' => 'Name 2', 'name' => 'portfolio_credit_2_name', 'type' => 'text', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_credit_3_role', 'label' => 'Role 3', 'name' => 'portfolio_credit_3_role', 'type' => 'text', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_credit_3_name', 'label' => 'Name 3', 'name' => 'portfolio_credit_3_name', 'type' => 'text', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_credit_4_role', 'label' => 'Role 4', 'name' => 'portfolio_credit_4_role', 'type' => 'text', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_credit_4_name', 'label' => 'Name 4', 'name' => 'portfolio_credit_4_name', 'type' => 'text', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_credit_5_role', 'label' => 'Role 5', 'name' => 'portfolio_credit_5_role', 'type' => 'text', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_credit_5_name', 'label' => 'Name 5', 'name' => 'portfolio_credit_5_name', 'type' => 'text', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_credit_6_role', 'label' => 'Role 6', 'name' => 'portfolio_credit_6_role', 'type' => 'text', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_credit_6_name', 'label' => 'Name 6', 'name' => 'portfolio_credit_6_name', 'type' => 'text', 'wrapper' => array('width' => '25')),

				// Tab 3: Middle Grid & Video
				array(
					'key' => 'field_portfolio_mid_tab',
					'label' => 'Middle Grid & Video',
					'type' => 'tab',
				),
				// Standard Images + Video
				array(
					'key' => 'field_portfolio_mid_img_1',
					'label' => 'Mid Image 1',
					'name' => 'portfolio_mid_img_1',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '33'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '!=',
								'value' => 'video',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_mid_img_2',
					'label' => 'Mid Image 2',
					'name' => 'portfolio_mid_img_2',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '33'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '!=',
								'value' => 'video',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_mid_img_3',
					'label' => 'Mid Image 3',
					'name' => 'portfolio_mid_img_3',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '33'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'standard',
							),
						),
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'vertical',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_vid_thumb',
					'label' => 'Video Thumbnail',
					'name' => 'portfolio_video_thumbnail',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '!=',
								'value' => 'video',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_vid_url',
					'label' => 'Video Embed URL',
					'name' => 'portfolio_video_url',
					'type' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '!=',
								'value' => 'video',
							),
						),
					),
				),

				// Video Showcase Middle Stacked Videos
				array(
					'key' => 'field_portfolio_video_mid_1_thumb',
					'label' => 'Middle Video 1 Thumbnail',
					'name' => 'portfolio_video_mid_1_thumb',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'video',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_video_mid_1_url',
					'label' => 'Middle Video 1 URL',
					'name' => 'portfolio_video_mid_1_url',
					'type' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'video',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_video_mid_2_thumb',
					'label' => 'Middle Video 2 Thumbnail',
					'name' => 'portfolio_video_mid_2_thumb',
					'type' => 'image',
					'return_format' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'video',
							),
						),
					),
				),
				array(
					'key' => 'field_portfolio_video_mid_2_url',
					'label' => 'Middle Video 2 URL',
					'name' => 'portfolio_video_mid_2_url',
					'type' => 'url',
					'wrapper' => array('width' => '50'),
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_portfolio_layout_type',
								'operator' => '==',
								'value' => 'video',
							),
						),
					),
				),

				// Tab 4: Behind the Scenes
				array(
					'key' => 'field_portfolio_bts_tab',
					'label' => 'Behind the Scenes',
					'type' => 'tab',
				),
				array('key' => 'field_portfolio_bts_title_1', 'label' => 'BTS Title (Regular)', 'name' => 'portfolio_bts_title_1', 'type' => 'text', 'wrapper' => array('width' => '50')),
				array('key' => 'field_portfolio_bts_title_2', 'label' => 'BTS Title (Italic)', 'name' => 'portfolio_bts_title_2', 'type' => 'text', 'wrapper' => array('width' => '50')),
				array('key' => 'field_portfolio_bts_desc', 'label' => 'BTS Description', 'name' => 'portfolio_bts_description', 'type' => 'textarea'),
				array('key' => 'field_portfolio_bts_img_1', 'label' => 'BTS Image 1', 'name' => 'portfolio_bts_img_1', 'type' => 'image', 'return_format' => 'url', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_bts_img_2', 'label' => 'BTS Image 2', 'name' => 'portfolio_bts_img_2', 'type' => 'image', 'return_format' => 'url', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_bts_img_3', 'label' => 'BTS Image 3', 'name' => 'portfolio_bts_img_3', 'type' => 'image', 'return_format' => 'url', 'wrapper' => array('width' => '25')),
				array('key' => 'field_portfolio_bts_img_4', 'label' => 'BTS Image 4', 'name' => 'portfolio_bts_img_4', 'type' => 'image', 'return_format' => 'url', 'wrapper' => array('width' => '25')),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'portfolio',
					),
				),
			),
		));

	endif;
});

