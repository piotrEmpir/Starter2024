<?php get_header(); ?>

	<div class="is-layout-constrained">

		<div class="block-article-grid alignwide">
			<?php if ( have_posts() ) : ?>
				<div class="wrap">
				<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID();?>" class="article-list-item ">
							<?php
							if(has_post_thumbnail()){ ?>
								<figure class="thumbnail">
									<a href=""><?php the_post_thumbnail(); ?></a>
								</figure>
							<?php } ?>
							<h3>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="excerpt"><?php the_excerpt(); ?></div>
							<a href="<?php the_permalink(); ?>" class="more">Read more</a>
						</article>
				<?php endwhile; ?>
				</div>
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
			<?php endif; ?>
		</div>

	</div>

<?php get_footer(); ?>