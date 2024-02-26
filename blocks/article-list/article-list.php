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
	<?php the_field( 'type' ); ?>
	<?php the_field( 'number' ); ?>
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