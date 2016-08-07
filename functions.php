<?php
	require ("customiser.php");
	
	add_action( 'after_setup_theme', 'register_my_menu' );
	function register_my_menu() {
		register_nav_menu( 'primary', __( 'Primary Menu', 'cardiffapp' ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
	function wpdocs_theme_name_scripts() {
			
		if(is_front_page()){
			wp_enqueue_style('cardiffapp-home-style', get_template_directory_uri() . '/pages/home/home.css');
		}
		else if(is_home()){
			wp_enqueue_style('cardiffapp-blog-style', get_template_directory_uri() . '/pages/blog/blog.css');
		}
		else{
			wp_enqueue_style('cardiffapp-blog-style', get_template_directory_uri() . '/pages/default/default.css');
		}
				
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style('cardiffapp-style', get_stylesheet_uri() );
			
		wp_enqueue_script( 'parallaxjs-script', get_template_directory_uri() . '/js/parallaxjs/parallax.js', array("jquery"), '1.0.1', true );
		wp_enqueue_script( 'cardiffapp-script', get_template_directory_uri() . '/main.js', array("jquery"), '1.0.1', true );
	}
	
	add_action('wp_head', 'load_custom_css');
	function load_custom_css(){
		
		require "custom_css.php";
		
		
	}
	
	add_action( 'widgets_init', 'theme_slug_widgets_init' );
	function theme_slug_widgets_init() {
		
		$areas = array(
			"header_widgets_1" => "Header Widgets 1",
			"header_widgets_2" => "Header Widgets 2",
			"header_widgets_3" => "Header Widgets 3",
			"header_widgets_4" => "Header Widgets 4",
			
			"page_header_widgets" => "Page Header Widgets",
			"page_footer_widgets" => "Page Footer Widgets",
			
			"primary_sidebar_left" => "Main Sidebar Left",
			"primary_sidebar_right" => "Main Sidebar right",
			
			"footer_widgets_1" => "Footer Widgets 1",
			"footer_widgets_2" => "Footer Widgets 2",
			"footer_widgets_3" => "Footer Widgets 3",
			"footer_widgets_4" => "Footer Widgets 4",	
		);
		
		foreach ($areas as $id => $name) {
			register_sidebar( array(
				'name' => __( $name, 'cardiffapp' ),
				'id' => $id,
				'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'cardiffapp' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => '</h2>',
			));
		}
	}
	
	add_action('wp_head','cardiffapp_ajaxurl');
	function cardiffapp_ajaxurl() {
		?>
		<script type="text/javascript">
			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		</script>
		<?php
	}	
?>