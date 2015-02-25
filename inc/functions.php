<?php
require_once("variables.php");

function woo_custom_register_theme_customizer( $wp_customize ) {
	GLOBAL $settings_prefix;
  //Adding Panel	
		$wp_customize->add_panel( 'woo_custom_woocommerce', array(
		    'priority'       => 10,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '',
		    'title'          => 'WooCommerce',
		    'description'    => 'Customize WooCommerce',
		) );
	
  //Creating Sections
	woo_custom_create_section($settings_prefix.'sp', 'Shop Page', 'Customize the Shop Page', $wp_customize);
	woo_custom_create_section($settings_prefix.'pp', 'Product Page', 'Customize the Product Page', $wp_customize);
	woo_custom_create_section($settings_prefix.'crp', 'Cart Page', 'Customize the Checkout Page', $wp_customize);
	woo_custom_create_section($settings_prefix.'cp', 'Checkout Page', 'Customize the Checkout Page', $wp_customize);
	
  //Creating settings and controls
	function woo_custom_create_numbers_array($num){
	  $output = array();
	  for ($i=1, $output;$i<($num+1);$i++){
		$output[$i] = $i;
	  }
	  return $output;
	}
	
	//For Shop Page
	woo_custom_create_new_setting('select', 'Product columns', 4, 'sp', $wp_customize, 10, woo_custom_create_numbers_array(4));
	woo_custom_create_new_setting('select', 'Products per page', 12, 'sp', $wp_customize, 20, woo_custom_create_numbers_array(24));
	woo_custom_create_new_setting('checkbox', 'Display product image', true, 'sp', $wp_customize, 30);
	woo_custom_create_new_setting('checkbox', 'Display product title', true, 'sp', $wp_customize, 40);
	woo_custom_create_new_setting('checkbox', 'Display rating', true, 'sp', $wp_customize, 50);
	woo_custom_create_new_setting('checkbox', 'Display price', true, 'sp', $wp_customize, 60);
	woo_custom_create_new_setting('checkbox', 'Display add to cart button', true, 'sp', $wp_customize, 70);
	
	//For Product Page
	woo_custom_create_new_setting('checkbox', 'Display product title', true, 'pp', $wp_customize, 1);
	woo_custom_create_new_setting('checkbox', 'Display product image', true, 'pp', $wp_customize, 2);
	woo_custom_create_new_setting('checkbox', 'Display gallery images', true, 'pp', $wp_customize, 3);
	woo_custom_create_new_setting('checkbox', 'Display product ratings', true, 'pp', $wp_customize, 4);
	woo_custom_create_new_setting('checkbox', 'Display product description tab', true, 'pp', $wp_customize, 5);
	woo_custom_create_new_setting('checkbox', 'Display reviews tab', true, 'pp', $wp_customize, 6);
	woo_custom_create_new_setting('checkbox', 'Display upsell products', true, 'pp', $wp_customize, 7);
	woo_custom_create_new_setting('checkbox', 'Display related products', true, 'pp', $wp_customize, 8);

	//For Cart Page
	woo_custom_create_new_setting('checkbox', 'Display coupon field', true, 'crp', $wp_customize, 1);
	woo_custom_create_new_setting('checkbox', 'Display upsell products', true, 'crp', $wp_customize, 2);

	//For Checkout Page
	woo_custom_create_new_setting('checkbox', 'Display coupon field', true, 'cp', $wp_customize, 1);
	woo_custom_create_new_setting('checkbox', 'Distraction free checkout', false, 'cp', $wp_customize, 2);

} // end woo_customregister_theme_customizer
add_action( 'customize_register', 'woo_custom_register_theme_customizer' );
