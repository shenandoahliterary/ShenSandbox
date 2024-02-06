<?php
/**
 * ShenAleph Theme Customizer
 *
 * @package ShenAleph
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shenAleph_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'shenAleph_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'shenAleph_customize_partial_blogdescription',
		) );
	}
//
// Add your new Section, Setting, and Control here
$wp_customize->add_section('mytheme_new_section_name', array(
	'title'      => __('Volume and Issue', 'mytheme'),
	'priority'   => 30,
));

$wp_customize->add_setting('volume_issue_text', array(
	'default'   => 'Volume xx, Number x · Fall xxxx',
	'transport' => 'refresh',
));

$wp_customize->add_control(new WP_Customize_Control(
	$wp_customize,
	'custom_volume_issue_text',
	array(
		'label'      => __('Volume Issue Text', 'mytheme'),
		'section'    => 'mytheme_new_section_name',
		'settings'   => 'volume_issue_text',
		'type'       => 'text'
	)
));

//
}
add_action( 'customize_register', 'shenAleph_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function shenAleph_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function shenAleph_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function shenAleph_customize_preview_js() {
	wp_enqueue_script( 'shenAleph', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'shenAleph_customize_preview_js' );
