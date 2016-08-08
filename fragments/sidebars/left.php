<?php 
	if(is_active_sidebar('primary_sidebar_left')): ?>
		<div id="primary_sidebar_left" class="widget-area">
			<?php dynamic_sidebar('primary_sidebar_left'); ?>
		</div>
		<?php
	endif;
?>