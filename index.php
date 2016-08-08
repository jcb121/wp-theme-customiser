<?php get_header(); ?>

<div id="page" class="site-width">	
	<?php get_template_part( 'fragments/sidebars/left') ?>
	<div  id="page_content_container">
		
		<?php get_template_part('fragments/page_widgets/header'); ?>
		
		<div  id="page_content">
			<?php
			if(is_front_page()):
				get_template_part( 'pages/home/home', 'home' );
			elseif(is_home()): 
				get_template_part( 'pages/blog/blog', 'blog' );
			else: 
				get_template_part( 'pages/default/default', 'default' );
			endif; ?>
		</div>
		
		<?php get_template_part('fragments/page_widgets/footer'); ?>
			
	</div>
	<?php get_template_part( 'fragments/sidebars/right') ?>
</div>

<?php get_footer(); ?>