<?php
/**
 * Block template file: article-grid.php
 *
 * Article Grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'article-grid-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-article-grid';
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

    $post_num = the_field( 'number' );

    $args = array(
        'numberposts' => $post_num ,
        'post_type' => 'post'
    );

    $query = new WP_Query( $args );

    ?>

    <?php if( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
        post_by_id(get_the_ID());
        endwhile;
    endif; ?>

    <?php wp_reset_query(); ?>


	<?php the_field( 'type' ); ?>

	<?php $categories = get_field( 'categories' ); ?>
	<?php if ( $categories ) : ?>
		<?php $get_terms_args = array(
			'taxonomy' => 'category',
			'hide_empty' => 0,
			'include' => $categories,
		); ?>
		<?php $terms = get_terms( $get_terms_args ); ?>
		<?php if ( $terms ) : ?>
			<?php foreach ( $terms as $term ) : ?>
				<a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>
	<?php $posts = get_field( 'posts' ); ?>
	<?php if ( $posts ) : ?>
		<?php foreach ( $posts as $post_ids ) : ?>
			<a href="<?php echo get_permalink( $post_ids ); ?>"><?php echo get_the_title( $post_ids ); ?></a>
		<?php endforeach; ?>
	<?php endif; ?>
	<?php $more = get_field( 'more' ); ?>
	<?php if ( $more ) : ?>
		<a href="<?php echo esc_url( $more['url'] ); ?>" target="<?php echo esc_attr( $more['target'] ); ?>"><?php echo esc_html( $more['title'] ); ?></a>
	<?php endif; ?>
</div>