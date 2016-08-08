<div id="site-header" class="header">
	
	<header id="site-identity" class="site-width">
		<h1 class="site_title">
			<a	rel="home" 
				href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php bloginfo( 'name' ); ?>
			</a>
		</h1>
		<p class="site_description">
			<a	rel="home"
				href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php echo get_bloginfo( 'description', 'display' );?>
			</a>
		</p>
	</header>

	<nav id="primary-menu" class="navigation site-width">
		
		<button class="show-side-menu-right">
			<span class="dashicons dashicons-menu"></span>
		</button>
		
		<div id="side_bar_right">
			
			<div class="menu-toolbar">
				<button class="hide-side-menu-right">
					<span class="dashicons dashicons-no-alt"></span>
				</button>
			</div>
			
			<?php wp_nav_menu(array(
				"menu"=>"primary",
			)); ?>
			
		</div>
		
	</nav>
</div>

<div id="header_widgets" class="site-width">
	
	<?php if(is_active_sidebar('header_widgets_1')): ?>
		<div id="header_widgets_1" class="widget_area">
			<?php dynamic_sidebar('header_widgets_1'); ?>
		</div>
	<?php endif; ?>
	
	<?php if(is_active_sidebar('header_widgets_2')): ?>
		<div id="header_widgets_2" class="widget_area">
			<?php dynamic_sidebar('header_widgets_2'); ?>
		</div>
	<?php endif;?>
	
	<?php if(is_active_sidebar('header_widgets_3')): ?>
		<div id="header_widgets_3" class="widget_area">
			<?php dynamic_sidebar('header_widgets_3'); ?>
		</div>
	<?php endif;?>
	
	<?php if(is_active_sidebar('header_widgets_4')): ?>
		<div id="header_widgets_4" class="widget_area">
			<?php dynamic_sidebar('header_widgets_4'); ?>
		</div>
	<?php endif;?>
	
	
	
	

</div>