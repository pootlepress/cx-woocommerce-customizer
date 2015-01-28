<?php
require_once('variables.php');


  //For Shop Page

	//Change Num of Products Per Page
	function woo_custom_loop_perpage() {
		return woo_custom_get_theme_mod('Products per page', 'sp', 12);
	}
	add_filter('loop_shop_per_page', 'woo_custom_loop_perpage', 999);

	function woo_custom_make_it_happen_shop(){
		GLOBAL $woo_custom_style;
		
		//Change Num of columns
		function woo_custom_loop_columns() {
			return woo_custom_get_theme_mod('Product columns', 'sp', 4);
		}
		add_filter('loop_shop_columns', 'woo_custom_loop_columns', 999);
		if (woo_custom_get_theme_mod('Product columns', 'sp', 4)!=4){
			GLOBAL $woo_custom_style;
			$woo_custom_style = "
			@media only screen and (min-width: 768px){
				.post-type-archive-product ul.products li.product.first{
					margin-left: ".((4 - woo_custom_get_theme_mod('Product columns', 'sp', 4))*12.8)."% !important;
				}
			}
";
		}
		
		//Remove product image
		if (false == woo_custom_get_theme_mod('Display product image', 'sp', true)){
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		}

		//Remove product title
		if (false == woo_custom_get_theme_mod('Display product title', 'sp', true)){
			$woo_custom_style = 'body.post-type-archive-product ul.products li.product h3{display:none;}';
		}

		//Remove product price
		if (false == woo_custom_get_theme_mod('Display price', 'sp', true)){
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		}

		//Remove rating
		if (false == woo_custom_get_theme_mod('Display rating', 'sp', true)){
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		}else{
			if (!has_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating')){
				add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 500 );
			}
		}

		//Remove add to cart button
		if (false == woo_custom_get_theme_mod('Display add to cart button', 'sp', true)){
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		}
	}
	add_action('wp_head', 'woo_custom_make_it_happen_shop');



  //For Product Page
	
	function woo_custom_make_it_happen_product(){
		GLOBAL $woo_custom_style;

		//Remove product title
		if (false == woo_custom_get_theme_mod('Display product title', 'pp', true)){
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		}
		
		//Remove product image
		if (false == woo_custom_get_theme_mod('Display product image', 'pp', true)){
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		}
	
		//Remove product gallery
		if (false == woo_custom_get_theme_mod('Display gallery images', 'pp', true)){
			remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
		}

		//Remove rating
		if (false == woo_custom_get_theme_mod('Display product ratings', 'pp', true)){
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		}

		add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
		function woo_remove_product_tabs( $tabs ) {
			//Remove product description tab
			if (false == woo_custom_get_theme_mod('Display product description tab', 'pp', true)){
				unset( $tabs['description'] );      	// Remove the description tab
			}
				
			//Remove reviews tab
			if (false == woo_custom_get_theme_mod('Display reviews tab', 'pp', true)){
				unset( $tabs['reviews'] ); 			// Remove the reviews tab
			}
		
			return $tabs;
		}
		
	
		//Remove upsell products
		if (false == woo_custom_get_theme_mod('Display upsell products', 'pp', true)){
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		}
				
		//Remove related products
		if (false == woo_custom_get_theme_mod('Display related products', 'pp', true)){
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}
	}
	add_action('wp_head', 'woo_custom_make_it_happen_product');



  //For Cart Page
	
	function woo_custom_make_it_happen_crt(){
		GLOBAL $woo_custom_js;
	
		//Remove coupon field
		if (false == woo_custom_get_theme_mod('Display coupon field', 'crp', true)){
			function woo_custom_hide_coupon_field( $enabled ) {if ( is_cart() ) {$enabled = false;}return $enabled;}
			add_filter( 'woocommerce_coupons_enabled', 'woo_custom_hide_coupon_field' );
		}
	
	
		//Distraction free cart
		if (false == woo_custom_get_theme_mod('Display upsell products', 'crp', true)){
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
		}
	}
	add_action('wp_head', 'woo_custom_make_it_happen_crt');



  //For Checkout Page
	
	$cp = $settings_prefix . 'cp';
	function woo_custom_make_it_happen_chkout(){
		GLOBAL $woo_custom_js;

		//Remove coupon field
		if (false == woo_custom_get_theme_mod('Display coupon field', 'cp', true)){
			remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
		}
		
		
		//Distraction free checkout
		if (true == woo_custom_get_theme_mod('Distraction free checkout', 'cp', false)){
			GLOBAL $woo_custom_js;
			if(is_checkout()){			
				$woo_custom_js = "
				var woo = jQuery('body .woocommerce');
				var wc_height = woo.css('height');
				var wc_width = woo.css('width');
				jQuery('.woocommerce-checkout *').not('.woocommerce, #wpadminbar, .woocommerce *, #wpadminbar *, #header, #header *').hide();
				woo.parents().show()
				woo.parents().css('width', '100%')
				woo.css({
					'width':wc_width,
					'margin-right':'auto',
					'margin-left':'auto',
			})
				";
			}
		}
	}
	add_action('wp_head', 'woo_custom_make_it_happen_chkout');
	
function woo_custom_customizer_css() { 
	GLOBAL $woo_custom_style;
	GLOBAL $woo_custom_js;
	?>
  <style type="text/css" id='woo-custom-stylesheet'>
	<?php echo $woo_custom_style; ?>
  </style>
  <script type="text/javascript" id='woo_custom_js'>
	jQuery(document).ready(function(){<?php echo $woo_custom_js; ?>	});
  </script><?php
}
add_action( 'wp_head', 'woo_custom_customizer_css' );

/**
 * Registers Javascript for live preview
 */
function woo_customcustomizer_live_preview() {
	wp_enqueue_script(
	'live_preview',
	get_template_directory_uri() . 'js/live-preview.js',
	array( 'jquery', 'customize-preview' ),
	'0.3.0',
	true
	);
} // end woo_customcustomizer_live_preview
add_action( 'customize_preview_init', 'woo_customcustomizer_live_preview' );