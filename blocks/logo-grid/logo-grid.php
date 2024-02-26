<?php
/**
 * Block template file: logo-grid.php
 *
 * Logo Grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'logo-grid-' . $block['id'].rand(0,9999);;
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-logo-grid';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>


<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php if ( have_rows( 'logos' ) ) : ?>
		<?php while ( have_rows( 'logos' ) ) : the_row(); ?>
			<?php $image = get_sub_field( 'image' ); ?>
			<?php if ( $image ) : ?>
				<figure class="thumb"><img src="<?php echo esc_url( $image['sizes']['medium'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_html( $image['sizes']['medium-width'] ); ?>" height="<?php echo esc_html( $image['sizes']['medium-height'] ); ?>" srcset="<?php echo wp_get_attachment_image_srcset( $image['ID'], 'large' ); ?>" loading="lazy"  /></figure>
			<?php endif; ?>
			<?php $link = get_sub_field( 'link' ); ?>
			<?php if ( $link ) : ?>
				<a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php // No rows found ?>
	<?php endif; ?>
</div>