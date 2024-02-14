<?php get_header(); ?>
aa
	<div class="is-layout-constrained">

		<div class="block-article-grid alignwide">
			<?php if ( have_posts() ) : ?>
				<div class="wrap">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'partials/listing-article' ); ?>
				<?php endwhile; ?>
				</div>
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
			<?php endif; ?>
		</div>

	</div>

<?php get_footer(); ?>