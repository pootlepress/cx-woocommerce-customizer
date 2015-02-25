<?php
require_once 'classes.php';

//Variables
  $settings_prefix = 'woo_custom_';
  $initial_num_sects = 0;
  $woo_custom_style='';
  $woo_custom_js = '';

  
//Functions
  if(!function_exists( 'woo_custom_create_section' )){
  	/**
  	 * Creates a section for WooCommerce Customizer Plugin in woo_custom_woocommerce panel
  	 * @uses $wp_customize->add_section
  	 * @param string $id ID of section
  	 * @param string $name name for section
  	 * @param string $description for section
  	 * @param object $wp_customize to put section in
  	 */
  	function woo_custom_create_section($id = '', $name = '', $description = '', $wp_customize){
		GLOBAL $settings_prefix;
		GLOBAL $initial_num_sects;
		$initial_num_sects++;
		$wp_customize->add_section( $id, array(
		    'priority'       => 10+$initial_num_sects,
		    'capability'     => 'edit_theme_options',
		    'title'          => $name,
//		    'description'    => $description,
		    'panel'  => $settings_prefix.'woocommerce',
		) );
  	}
  }
/*USELESS FUNCTION BELOW*/
  if(!function_exists( 'woo_custom_create_color_setting' )){
	/**
	 * Creates color settings input
	 * @uses $wp_customize->add_setting
	 * @uses $wp_customize->add_control
	 * @param number $button
	 * @param string $title
	 * @param string $default
	 * @param string $section
	 */
	function woo_custom_create_color_setting($title, $default, $section, $wp_customize, $priority_for_controls){
		//Vars for easy application
		$Title = $title;
		$title = strtolower($title);
		GLOBAL $settings_prefix;
		$setting_name = $settings_prefix.'_'.str_replace(array(' ', '/'), '_', $title);
		//Adding Setting
		$wp_customize->add_setting(
				$setting_name ,
				array(
						'default'     => $default,
				)
		);
		//Adding control
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_name,
				array(
					'label'		=> __( $Title, '' ),
					'section'	=> $section,
					'settings'	=> $setting_name,
					'priority'	=> $priority_for_controls
				)
			)
		);

	}
  }
  /*USELESS FUNCTION ABOVE*/
  
  if(!function_exists( 'woo_custom_create_new_setting' )){
	/**
	 * Creates setting input
	 * @uses $wp_customize->add_setting
	 * @uses $wp_customize->add_control
	 * @param string $button
	 * @param string $type text, checkbox, radio*, select*, dropdown-pages, textarea(WP4)
	 * @param string $title
	 * @param string $default
	 * @param string $section
	 * @param string $wp_customize
	 * @param array $choices
	 */
	function woo_custom_create_new_setting($type, $title, $default, $section, $wp_customize, $priority_for_controls, $choices=null){
		$Title = $title;
		$title = strtolower($title);
		GLOBAL $settings_prefix;
		$setting_name = '_'.str_replace(array(' ', '/'), '_', $title);
		//Array of Arguments for settings
		$args = array(
				'label'         => __( $Title ),
				'section'       => $settings_prefix . $section,
				'settings'      => $settings_prefix . $section . $setting_name,
				'type'          => $type,
				'priority'		=> $priority_for_controls
		);
		//If choice available update Arguments for settings
		if (isset($choices)){
			$args = array(
		        'label'         => __( $Title ),
		        'section'       => $settings_prefix . $section,
		        'settings'      => $settings_prefix . $section . $setting_name,
		        'type'          => $type,
		        'choices'       => $choices,
				'priority'		=> $priority_for_controls
			);
		}
		//Adding Setting
		$wp_customize->add_setting(
				$settings_prefix . $section . $setting_name ,
				array(
						'default'     => $default,
	//					'transport'   => 'postMessage'
				)
		);
		//Adding control
		$wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        $settings_prefix . $section . $setting_name,
		    	$args
		    )
		);
	  }
	}
	/**
	 * Retrieves settings from customizer
	 * @uses get_theme_mod
	 * @param string $name
	 * @param string $section
	 * @param string $default
	 * @return string, number or bool from setting value
	 */
	function woo_custom_get_theme_mod($title = '', $section = '', $default){
	  if(isset($default)){
		$title = strtolower($title);
		GLOBAL $settings_prefix;
		$setting_name = '_'.str_replace(array(' ', '/'), '_', $title);
	  	

		return get_theme_mod( $settings_prefix . $section . $setting_name , $default);
	  }else {
	  	return false;
	  }
	}
?>