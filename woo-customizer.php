<?php
/*
Plugin Name: Canvas Extension - WooCommerce Customizer
Plugin URI: http://www.pootlepress.com
Description: A Canvas Extension for customizing WooCommerce. Options can be found in WP Customizer (Appearance > Customize) under 'WooCommerce' section.
Version: 1.0.0
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

//CX API
require 'pp-cx/class-pp-cx-init.php';
new PP_Canvas_Extensions_Init(
	array(
		'key'          => 'woocommerce-customizer',
		'label'        => 'WooCommerce Customizer',
		'url'          => 'http://www.pootlepress.com/shop/woocommerce-customizer-woothemes-canvas/',
		'description'  => "Get complete control over your WooCommerce shop in Canvas. Better layout your Shop page, show/hide lots of options on the Shop and Product pages and create a distraction free shopping experience in 1 click!",
		'img'          => 'http://www.pootlepress.com/wp-content/uploads/2015/02/wc-cust-icon-300x174.png',
		'installed'    => true,
		'settings_url' => admin_url( 'customize.php?autofocus[panel]=woo_custom_woocommerce' ),
	),
	__FILE__
);
