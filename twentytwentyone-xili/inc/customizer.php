<?php
/**
 * Twenty Twenty-One xili Customizer functionality
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Twenty-One 1.2
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function twentytwentyone_xili_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'texts_section' , array(
					'title'       => __( 'Other texts section', 'twentytwentyone' ),
					'priority'    => 421
	));

	$wp_customize->add_setting(
		'copyright',
		array(
			'sanitize_callback' => 'twentytwentyone_xili_sanitize_text',
			'default'           => __( 'My company', 'twentytwentyone' ),
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( 'copyright', array(
				'label'    => __( 'Your copyright (footer)', 'twentytwentyone' ),
				'section'  => 'texts_section',
				'settings' => 'copyright',
				'priority'    => 1,
		) );

}
add_action( 'customize_register', 'twentytwentyone_xili_customize_register', 20 ); // after parent .


function twentytwentyone_xili_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since 1.2.0
 */
function twentytwentyone_xili_customize_preview_js() {
	wp_enqueue_script( 'twentytwentyone-xili-customize-preview', get_stylesheet_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20170824', true );

}
add_action( 'customize_preview_init', 'twentytwentyone_xili_customize_preview_js', 12 );
