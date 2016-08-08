<?php 
if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
	return;
}

if ( is_singular() ): ?>

<div class="post-thumbnail">
	<?php the_post_thumbnail(); ?>
</div>

<?php else : ?>

<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
	<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
</a>

<?php endif;