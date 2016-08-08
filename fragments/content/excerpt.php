<?php if ( has_excerpt() || is_search() ) : ?>
<div class="excerpt">
	<?php the_excerpt(); ?>
</div>
<?php endif; ?>