<?php
/**
 * Block template file: article-list.php
 *
 * Article List Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'article-list-' . $block['id'].rand(0,9999);;
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-article-list';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<div class="wrap">
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
        <?php if( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				//post_by_id(get_the_ID());
				get_template_part( 'partials/listing-article' );
			endwhile;
		endif; ?>
        <?php wp_reset_query(); ?>
    </div>

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