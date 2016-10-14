<?php
/*
Plugin Name: Canvas Extension - WooCommerce Customizer
Plugin URI: http://www.pootlepress.com
Description: A Canvas Extension for customizing WooCommerce. Options can be found in WP Customizer (Appearance > Customize) under 'WooCommerce' section.
Version: 1.0.1
Author: PootlePress
Author URI: http://www.pootlepress.com
License: GPL version 3 or later - http://www.gnu.org/licenses/gpl-3.0.html
*/
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

if (is_woocommerce_activated()){}

	require_once('inc/functions.php');
	require_once('inc/actions.php');
	function woo_custom_wp_admin_scripts() {
		wp_enqueue_script(
		'woo_custom-customizer-menu-script',
		plugins_url(). '/woo-customizer/js/customizr-menu.js',
		array( 'jquery'),
		'0.3.1',
		true
		);
		wp_enqueue_style('woo_custom-customizer-menu-script', plugins_url(). '/cx-button-customizer/css/customizr-menu.css');
	}
	add_action( 'admin_enqueue_scripts', 'woo_custom_wp_admin_scripts' );

require_once('inc/class-pootlepress-updater.php');
