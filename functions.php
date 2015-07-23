<?php

include_once( 'includes/customizer/customizer.php' ); // Include CAHNRS customizer functionality.

/**
 * Set up a theme hook for the site header.
 */
function cahnrswp_site_header() {
	do_action( 'cahnrswp_site_header' );
}

add_action( 'wp_enqueue_scripts', 'extension_wp_enqueue_scripts', 21 );
/**
 * Enqueue scripts and styles required for front end pageviews.
 */
function extension_wp_enqueue_scripts() {
	wp_dequeue_style( 'spine-theme-extra' );
	wp_enqueue_script( 'extension-js', get_stylesheet_directory_uri() . '/js/extension.js', array( 'jquery' ) );
}

add_action( 'cahnrswp_site_header', 'cahnrswp_default_header', 1 );
/**
 * Add the default header via hook.
 */
function cahnrswp_default_header() {
	get_template_part( 'parts/default-header' );
}

add_filter( 'mce_buttons_2', 'cahnrswp_add_tinymce_table_plugin' );
/**
 * Add Table controls to tinyMCE editor.
 */
function cahnrswp_add_tinymce_table_plugin( $buttons ) {
   array_push( $buttons, 'table' );
   return $buttons;
}

add_filter( 'mce_external_plugins', 'cahnrswp_register_tinymce_table_plugin' );
/**
 * Register the tinyMCE Table plugin.
 */
function cahnrswp_register_tinymce_table_plugin( $plugin_array ) {
   $plugin_array['table'] = get_stylesheet_directory_uri() . '/tinymce/table-plugin.min.js';
   return $plugin_array;
}

add_filter( 'body_class', 'cahnrswp_custom_body_class' );
/**
 * Body classes.
 */
function cahnrswp_custom_body_class( $classes ) {
	if ( get_post_meta( get_the_ID(), 'body_class', true ) ) {
		$classes[] = esc_attr( get_post_meta( get_the_ID(), 'body_class', true ) );
	}
	if ( is_customize_preview() ) {
		$classes[] = 'customizer-preview';
	}
	$classes[] = 'spine-' . esc_attr( spine_get_option( 'spine_color' ) );
	return $classes;
}

add_filter( 'theme_page_templates', 'remove_spine_page_templates' );
/**
 * Remove most of the Spine page templates.
 */
function remove_spine_page_templates( $templates ) {
	unset( $templates['templates/blank.php'] );
	unset( $templates['templates/halves.php'] );
	unset( $templates['templates/margin-left.php'] );
	unset( $templates['templates/margin-right.php'] );
	unset( $templates['templates/section-label.php'] );
	unset( $templates['templates/side-left.php'] );
	//unset( $templates['templates/side-right.php'] );
	unset( $templates['templates/single.php'] );
	return $templates;
}