<?php
/**
 * The Monday Theme Customizer
 *
 * @package The Monday
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function the_monday_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    
/*---------------------------------------------------------------------------------------------*/
    /**
     * Theme info
     */
     
    $wp_customize->add_section(
        'the_monday_themeinfo',
        array(
            'title' => __( 'Theme Info', 'the-monday' ),
            'priority' => 1,         
        )
    );
    
    // More Themes
    $wp_customize->add_setting(
        'the_monday_features_info', 
        array(
            'type'              => 'theme_info',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control( new The_Monday_Info_Custom_Control( 
        $wp_customize ,
        'the_monday_features_info',
            array(
              'label' => __( 'The Monday Pro Features' , 'the-monday' ),
              'section' => 'the_monday_themeinfo',
            )
        )
    );
}
add_action( 'customize_register', 'the_monday_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function the_monday_customize_preview_js() {
	wp_enqueue_script( 'the_monday_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'the_monday_customize_preview_js' );

add_action( 'customize_controls_enqueue_scripts', 'the_monday_customize_controls_register_scripts' );
function the_monday_customize_controls_register_scripts() {
    wp_enqueue_script( 'the_monday_customizer_controls', get_template_directory_uri() . '/inc/admin/js/customizer-controls.js', array('jquery'), '20160901', true );
}