<?php
/**
 * Block template file: testimonials.php
 *
 * Testimonials Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'testimonials-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-testimonials';
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
	<?php if ( have_rows( 'testimonials' ) ) : ?>
		<?php while ( have_rows( 'testimonials' ) ) : the_row(); ?>
			<?php the_sub_field( 'description' ); ?>
			<?php the_sub_field( 'who' ); ?>
			<?php $image = get_sub_field( 'image' ); ?>
			<?php if ( $image ) : ?>
				<figure class="thumb"><img src="<?php echo esc_url( $image['sizes']['medium'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" width="<?php echo esc_html( $image['sizes']['medium-width'] ); ?>" height="<?php echo esc_html( $image['sizes']['medium-height'] ); ?>" srcset="<?php echo wp_get_attachment_image_srcset( $image['ID'], 'large' ); ?>" loading="lazy"  /></figure>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php if(is_admin()) echo '<p>Please go to edit mode to add content</p>'; ?>
	<?php endif; ?>
</div>