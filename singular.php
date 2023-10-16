<?php get_header(); ?>

	<div class="is-layout-constrained">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
			?>
				<?php the_content(); ?>
			<?php
			endwhile;
			if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
		endif;
		?>
	</div>

<?php get_footer(); ?>