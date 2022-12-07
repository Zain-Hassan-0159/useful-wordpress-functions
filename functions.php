<?php

// Note: Action hook for creating the customizer options in wordpress (Start)

add_action('customize_register', 'reguster_function_for_customizer');
function reguster_function_for_customizer($wp_customize)
{
	// All the Customize Options you create goes here
	// Move Homepage Settings section underneath the "Site Identity" section
	$wp_customize->get_section('title_tagline')->priority = 1;
	$wp_customize->get_section('static_front_page')->priority = 2;
	$wp_customize->get_section('static_front_page')->title = __('Home page preferences', 'text-domain');
	// Theme Options Panel
	$wp_customize->add_panel(
		'hassan_theme_options',
		array(
			//'priority'         => 100,
			'title'            => __('Blogs Archive Options', 'text-domain'),
			'description'      => __('Theme Modifications like color scheme, theme texts and layout preferences can be done here', 'text-domain'),
		)
	);
	// Text Options Section
	$wp_customize->add_section(
		'hassan_text_options',
		array(
			'title'         => __('Banner Options', 'text-domain'),
			'priority'      => 1,
			'panel'         => 'hassan_theme_options'
		)
	);
	// Setting for text area
	$wp_customize->add_setting(
		'hassan_Banner_text',
		array(
			'default'           => __('All rights reserved ', 'text-domain'),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		)
	);

	// Control for text area
	$wp_customize->add_control(
		'hassan_Banner_text',
		array(
			'type'        => 'textarea',
			'priority'    => 10,
			'section'     => 'hassan_text_options',
			'label'       => 'Blogs section descriptions',
			'description' => 'Text put here will be outputted in the footer',
		)
	);

	// Setting for media image
	$wp_customize->add_setting('image_control_one', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
	));

	// Control for media image
	$wp_customize->add_control(
		new WP_Customize_Image_Control($wp_customize, 'image_control_one', array(
			'label' => __('Archive Blog Banner Image', 'text-domain'),
			'section' => 'hassan_text_options',
			'settings' => 'image_control_one',
		))
	);
}

// Note: Action hook for creating the customizer options in wordpress (End