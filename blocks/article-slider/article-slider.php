<?php
/**
 * Block template file: article-slider.php
 *
 * Article Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'article-slider-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$rand_num = rand(0,1000);

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-article-slider';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">


        <?php
		$post_num = get_field( 'number' );
		$args = array(
			'posts_per_page' => $post_num ,
			'post_type' => 'post'
		);

		if(get_field( 'type' ) == 'selected' && get_field( 'posts' ) ){
			$args['post__in'] = get_field( 'posts' );
		}

		if(get_field( 'type' ) == 'category' && get_field( 'categories' ) ){
			$args['category__in'] = get_field( 'categories' );
		}
		$query = new WP_Query( $args );
		?>
        <?php if( $query->have_posts() ) : ?>
			<div id="article_slider<?=$rand_num;?>" class="splide" aria-label="Article slider">
    			<div class="splide__track">
            		<ul class="splide__list">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<li class="splide__slide">
                            <?php get_template_part( 'partials/listing-article' ); ?>
						</li>
					<?php endwhile; ?>
					</ul>
            	</div>
            </div>
		<?php else : ?>
            <?php if(is_admin()) echo '<p>Please go to edit mode to add content</p>'; ?>
        <?php endif; ?>

        <?php wp_reset_query(); ?>







    <?php $more = get_field( 'more' ); ?>
    <?php if ( $more ) : ?>
		<div class="wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-layout-2 wp-block-buttons-is-layout-flex">
			<div class="wp-block-button">
				<a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $more['url'] ); ?>"
			target="<?php echo esc_attr( $more['target'] ); ?>"><?php echo esc_html( $more['title'] ); ?></a>
			</div>
		</div>
    <?php endif; ?>

</div>

<script>
  document.addEventListener( 'DOMContentLoaded', function() {
    var splide = new Splide( '#article_slider<?=$rand_num;?>',{
        arrows: true,
        pagination: true,
        //autoWidth: true,
        focus    : 0,
        type   : 'loop',
        perPage: 3,
        gap: 20,
        width: '100%',
        breakpoints: {
            400: {
                perPage: 1,
            },
            600: {
                perPage: 2,
            },
            760: {
                perPage: 2,
            },
            990: {
                perPage: 3,
            },
            1240: {
                perPage: 3,
            },
            1600: {
                perPage: 3,
            }
        }

    } );
    splide.mount();
  } );
</script>