<?php
if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('blocksy-child-style', get_stylesheet_uri());
});

function load_custom_wp_admin_style(){
	wp_register_style( 'custom_wp_admin_css', get_bloginfo('stylesheet_directory') . '/style.css', false, '1.0.0' );
	wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

add_filter( 'gform_ppcp_disable_funding', function( $disabled_funding ) {
	$disabled_funding[] = 'credit'; // PayPal Credit (US, UK).
	$disabled_funding[] = 'paylater'; // Pay Later (US, UK), Pay in 4 (AU), 4X PayPal (France), Später Bezahlen (Germany).
	return $disabled_funding;
} );

add_filter( 'gform_required_legend', function( $legend, $form ) {
	if ( $form['id'] == 1 ) {
		return '<span class="gfield_required gfield_required_asterisk">*</span> indicates required fields';
	}
}, 10, 2 );