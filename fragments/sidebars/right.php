<?php
	if(is_active_sidebar('primary_sidebar_right')): ?>
		<div id="primary_sidebar_right" class="widget-area">
			<?php dynamic_sidebar('primary_sidebar_right'); ?>
		</div>
		<?php
	endif;
?>