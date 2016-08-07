<?php 

add_action( 'wp_ajax_customiser_template', 'customiser_template' );
add_action( 'wp_ajax_nopriv_customiser_template', 'customiser_template' );
function customiser_template() {
	$part = $_GET["part"];
	if(empty($_GET["part"])){
		http_response_code(400);
		wp_die();
	}
	
	if((@include "customiser/templates/$part.html") === false){
		http_response_code(501);
	}
	wp_die();
}


add_action( 'wp_ajax_get_option', 'get_theme_option' );
add_action( 'wp_ajax_nopriv_get_option', 'get_theme_option' );
function get_theme_option(){
	if(empty($_GET["option"])){
		http_response_code(400);
		wp_die();
	}
	$option = $_GET["option"];
	
	if($option === "background"){
		$option = "colour";
	}
	if($option === "font_layout"){
		http_response_code(204);
		wp_die();
	}
	if($option === "border"){
		$option = "colour";
	}
	
	
	$options = get_option("cardiffapp_" . $option);
	if($options === false){
		http_response_code(501);
		wp_die();
	}
	
	foreach ($options as $name => &$default) {
		$default = get_theme_mod( $option . '_' . $name, $default);
	}
	
	echo json_encode($options);
	wp_die();
}

add_action( 'customize_register', 'mytheme_customize_register' );
function mytheme_customize_register( $wp_customize ){

	/*
	 * Fonts
	 */
	$wp_customize->add_section( 'cardiffapp_fonts' , array(
		'title'      => __( 'Fonts', 'cardiffapp' ),
		'priority'   => 48,
	));
	
	$fonts = array(
		"1" => "'Yellowtail', cursive",
		"2" => "'Montserrat', sans-serif",
		"3" => "'Roboto', sans-serif",
		"4" => "'Trebuchet MS', Helvetica, sans-serif",
		"5" => "Verdana, Geneva, sans-serif"
	);
	update_option("cardiffapp_font", $fonts);
	foreach ($fonts as $name => $default) {
		$wp_customize->add_setting('font_' . $name, array(
			'default'     => $default,
			'transport'   => 'postMessage',
		));
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'font_' . $name, array(
			'label'        => __( 'Font ' . $name, 'cardiffapp' ),
			'section'    => 'cardiffapp_fonts',
			'settings'   => 'font_' . $name,
		)));
	}
	
	/*
	 * Colours
	 */
	$wp_customize->add_section( 'cardiffapp_colours' , array(
		'title'      => __( 'Theme Colours', 'cardiffapp' ),
		'priority'   => 49,
	));
	
	$theme_colours = array(
		"1" => "#06aed5",
		"2" => "#086788",
		"3" => "#f0c808",
		"4" => "#fff1d0",
		"5" => "#dd1c1a",
		"6" => "#ffffff",
		"7" => "#000000"
	);
	update_option("cardiffapp_colour", $theme_colours);
	foreach ($theme_colours as $name => $default) {
		
		$wp_customize->add_setting('colour_' . $name, array(
			'default'     => $default,
			'transport'   => 'postMessage',
		));
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_' . $name, array(
			'label'        => __( 'Theme colour ' . $name, 'cardiffapp' ),
			'section'    => 'cardiffapp_colours',
			'settings'   => 'colour_' . $name,
		)));
	}
	
	/*
	 * Import Fonts
	 */
	$wp_customize->add_section( 'cardiffapp_custom_fonts' , array(
		'title'      => __( 'Load Custom fonts', 'cardiffapp' ),
		'priority'   => 50,
	));
	
	$font_imports = array(
		"1" => "@import url(https://fonts.googleapis.com/css?family=Yellowtail);", 
		"2" => "@import url(https://fonts.googleapis.com/css?family=Montserrat);", 
		"3" => "@import url(https://fonts.googleapis.com/css?family=Roboto)", 
		"4" => "", 
		"5" => ""
	);
	update_option("cardiffapp_custom_fonts", $font_imports);
	foreach ($font_imports as $name => $default) {
		
		$wp_customize->add_setting('font_import_' . $name, array(
			'default'     => $default,
			'transport'   => 'refresh',
		));
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'font_import_' . $name, array(
			'label'        => __( 'font import ' . $name, 'cardiffapp' ),
			'section'    => 'cardiffapp_custom_fonts',
			'settings'   => 'font_import_' . $name,
		)));
	}
}

add_action( 'customize_preview_init', 'cardiffapp_customizer_live_preview' );
function cardiffapp_customizer_live_preview(){
	
	wp_enqueue_script( 'handlebars', get_template_directory_uri().'/js/handlebars/handlebars.js', array('jquery'), "4.0.5", true );
	//wp_enqueue_script( 'handlebars-runtime', get_template_directory_uri().'/js/handlebars/handlebars-runtime.js', array('jquery'), "4.0.5", true );
	
	wp_enqueue_script( 'cardiffapp-cusomizer-settings', get_template_directory_uri().'/customiser/customiser-settings.js', array('jquery'), "0.1", true );
	wp_enqueue_script( 'cardiffapp-cusomizer-theme', get_template_directory_uri().'/customiser/customiser-theme.js', array('jquery'), "0.1", true );
	
	wp_enqueue_style('cardiffapp-cusomizer-style', get_template_directory_uri().'/customiser/customiser.css');
}


?>