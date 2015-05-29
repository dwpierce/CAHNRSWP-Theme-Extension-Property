<?php

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
	//wp_enqueue_script( 'extension-js', get_stylesheet_directory_uri() . '/js/extension.js', array( 'jquery' ), '' );
}

add_filter( 'spine_option_defaults', 'extension_spine_option_defaults' );
/**
 * Reset some defaults for the options set in the customizer for the Spine theme.
 */
function extension_spine_option_defaults( $defaults ) {
	$defaults['campus_location'] = 'extension';
	$defaults['bleed'] = false;
	$defaults['articletitle_show'] = false;
	$defaults['articletitle_header'] = true;
	return $defaults;
}

add_action( 'cahnrswp_site_header', 'cahnrswp_default_header', 1 );
/**
 * Add the default header.
 *
 * Yep, this is verging close to spaghetti. But it opens up some possibilities
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

